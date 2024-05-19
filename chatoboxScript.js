document.addEventListener('DOMContentLoaded', function() {
    const sendButton = document.getElementById('send-button');
    const inputBox = document.getElementById('input-box');
    const contentBox = document.getElementById('content');
    const centeredBox = document.querySelector('.centered-box');
    
    // Retrieve user_id and recipient_id from data attributes
    const userId = centeredBox.getAttribute('data-user-id');
    const recipientId = centeredBox.getAttribute('data-recipient-id');
    
    let lastMessageId = 1000000;

    let lastMessageTimestamp = null;

    // Function to format timestamp without seconds
    function formatTimestamp(dateString) {
        const options = { hour: '2-digit', minute: '2-digit' };
        return new Date(dateString).toLocaleTimeString([], options);
    }

    // Function to format date
    function formatDate(dateString) {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString([], options);
    }

    // Function to insert a timestamp divider
    function insertTimestampDivider(timestamp) {
        const divider = document.createElement('div');
        divider.classList.add('timestamp-divider');
        divider.textContent = formatDate(timestamp);
        contentBox.appendChild(divider);
    }

    // Function to fetch messages
    function fetchMessages(initialLoad=false) {
        fetch(`fetch_messages.php?user_id=${userId}&recipient_id=${recipientId}&last_message_id=${lastMessageId}`)
            .then(response => response.json())
            .then(messages => {
                if (messages.length > 0) {
                    lastMessageId = messages[messages.length - 1].id;
                    console.log(lastMessageId);
                    messages.reverse().forEach(message => {
                        console.log(messages.message);
                        const messageTimestamp = new Date(message.created_at);
                        if (lastMessageTimestamp && (messageTimestamp - lastMessageTimestamp) > (60 * 60 * 1000)) {
                            insertTimestampDivider(message.created_at);
                        }
                        lastMessageTimestamp = messageTimestamp;
                        const messageElement = document.createElement('div');
                        messageElement.classList.add('message');
                        messageElement.classList.add(message.sender_id == userId ? 'user' : 'recipient');
                        messageElement.textContent = message.content;
                        console.log(message.content);
                        messageElement.innerHTML = `
                            <div>${message.content}</div>
                            <div class="timestamp">${formatTimestamp(message.created_at)}</div>
                        `;
                        if (initialLoad) {
                            contentBox.appendChild(messageElement);
                        } else {
                            contentBox.prepend(messageElement);
                        }
                    });
                    if (initialLoad) {
                        contentBox.scrollTop = contentBox.scrollHeight;
                    }
                }
            });
    }

    // Load initial messages
    fetchMessages(true);

    // Event listener for the send button
    sendButton.addEventListener('click', function() {
        const text = inputBox.value.trim();
        if (text !== '') {
            const currentTime = new Date();
            const timestamp = formatTimestamp(currentTime);
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', 'user');
            messageElement.innerHTML = `
            <div>${text}</div>
            <div class="timestamp">${timestamp}</div>
            `;
            messageElement.textContent = text;
            contentBox.appendChild(messageElement);
            inputBox.value = ''; // Clear the input box

            if (lastMessageTimestamp && (currentTime - lastMessageTimestamp) > (60 * 60 * 1000)) {
                insertTimestampDivider(currentTime);
            }
            lastMessageTimestamp = currentTime;

            // Store the message in the database
            fetch('store_message.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId, recipient_id: recipientId, message: text })
            });
            console.log('Stored Data');
        }
    });

    // Infinite scroll: Load more messages when scrolling up
    contentBox.addEventListener('scroll', function() {
        if (contentBox.scrollTop === 0) {
            fetchMessages();
        }
    });
});
