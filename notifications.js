document.addEventListener("DOMContentLoaded", function () {
    function checkNotifications() {
        fetch('check_notifications.php')
            .then(response => response.json())
            .then(data => {
                const notificationsDiv = document.getElementById('notifications');
                notificationsDiv.innerHTML = '';
                data.forEach(notification => {
                    const notificationElement = document.createElement('a');
                    notificationElement.className = 'dropdown-item';
                    notificationElement.href = `confirm_adoption.php?pet_id=${notification.pet_id}&notification_id=${notification.id}`;
                    notificationElement.innerHTML = notification.message;
                    notificationsDiv.appendChild(notificationElement);
                });
            });
    }

    checkNotifications();

    setInterval(checkNotifications, 5000); // Check for new notifications every 5 seconds
});
