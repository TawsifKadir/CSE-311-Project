$(document).ready(function() {
    let offset = 0;
    const limit = 5;
    let loading = false;
    let allLoaded = false;
    const defaultProfilePicture = 'images/placeholder.jpg'; 

    // Function to format timestamps
    function formatTimestamp(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleString([], { hour: '2-digit', minute: '2-digit' });
    }

    // Load notifications
    function loadNotifications() {
        if (loading || allLoaded) return;
        loading = true;
        console.log("Notification called");
        $.ajax({
            url: 'check_notifications.php',
            type: 'GET',
            data: { limit: limit, offset: offset },
            success: function(response) {
                const notifications = JSON.parse(response);
                const notificationsDiv = $('#notifications');
                console.log(notifications);
                if (notifications.length === 0 && offset === 0) {
                    notificationsDiv.append('<p class="text-center text-muted">No notifications found.</p>');
                    allLoaded = true;
                }else if (notifications.length === 0) {
                    allLoaded = true; 
                } else {
                    notifications.forEach(notification => {
                        const profilePicture = notification.profile_image 
                            ? 'data:image/jpeg;base64,' + notification.profile_image 
                            : defaultProfilePicture;
                        const notificationElement = $('<a>')
                            .addClass('dropdown-item')
                            .attr('href', `confirm_adoption.php?notification_id=${notification.notification_id}&pet_id=${notification.pet_id}`)
                            .html(`
                                <div class="d-flex align-items-center">
                                    <img src="${profilePicture}" alt="${notification.username}'s profile picture" class="profile-image-small">
                                    <div>
                                        <p>${notification.message}</p>
                                        <small class="text-muted">${formatTimestamp(notification.created_at)}</small>
                                    </div>
                                </div>
                            `);

                        notificationsDiv.append(notificationElement);
                    });
                    offset += notifications.length;
                }
                loading = false;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching notifications:', error);
                loading = false;
            }
        });
    }

    // Load notifications when the notifications dropdown is clicked
    $('#notificationsDropdown').on('click', function() {
        if (offset === 0) {
            loadNotifications();
        }
    });

    // Load more notifications when scrolling to the bottom of the dropdown
    $('.dropdown-menu').on('scroll', function() {
        const dropdownMenu = $(this);
        if (dropdownMenu.scrollTop() + dropdownMenu.innerHeight() >= dropdownMenu[0].scrollHeight) {
            loadNotifications();
        }
    });
});