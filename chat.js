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

    // Function to truncate message to first 12 words
    function truncateMessage(message, wordLimit) {
        const words = message.split(' ');
        if (words.length > wordLimit) {
            return words.slice(0, wordLimit).join(' ') + '...';
        }
        return message;
    }

    // Load chat users and their latest messages
    function loadChatUsers() {
        if (loading || allLoaded) return;
        loading = true;
        console.log("Function called");

        $.ajax({
            url: 'fetch_chat_users.php',
            type: 'GET',
            data: { limit: limit, offset: offset },
            success: function(response) {
                const chatUsers = JSON.parse(response);
                const chatUsersDiv = $('#chat-users');

                if (chatUsers.length === 0 && offset === 0) {
                    chatUsersDiv.append('<p class="text-center text-muted">No chat users found.</p>');
                    allLoaded = true;
                }else if(chatUsers.length === 0){
                    allLoaded = true;
                } else {
                    chatUsers.forEach(user => {
                        console.log(chatUsers);
                        const truncatedMessage = truncateMessage(user.content, 12);
                        console.log(user.profile_image);
                        const profilePicture = user.profile_image 
                            ? 'data:image/jpeg;base64,' + user.profile_image 
                            : defaultProfilePicture;
                        const userElement = $('<a>')
                            .addClass('dropdown-item')
                            .attr('href', `chatbox.php?id=${user.user_id}`)
                            .html(`
                            <div class="d-flex align-items-center">
                                <img src="${profilePicture}" alt="${user.username}'s profile picture" class="profile-image-small">
                                <div>
                                    <strong>${user.username}</strong>
                                    <p>${truncatedMessage}</p>
                                    <small class="text-muted">${formatTimestamp(user.created_at)}</small>
                                </div>
                            </div>
                            `);

                        chatUsersDiv.append(userElement);
                    });
                    offset += chatUsers.length;
                    if (chatUsers.length < limit) {
                        allLoaded = true;
                    }
                }
                loading = false;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching chat users:', error);
                loading = false;
                allLoaded = true;
            }
        });
    }

    // Load chat users when the messages dropdown is clicked
    $('#messageDropdown').on('click', function() {
        if (offset === 0) {
            loadChatUsers();
        }
    });

    // Load more chat users when scrolling to the bottom of the dropdown
    $('.dropdown-menu').on('scroll', function() {
        const dropdownMenu = $(this);
        if (dropdownMenu.scrollTop() + dropdownMenu.innerHeight() >= dropdownMenu[0].scrollHeight) {
            loadChatUsers();
        }
    });
});
