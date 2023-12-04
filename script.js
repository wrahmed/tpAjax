// script.js
$(document).ready(function () {
    loadMessages();

    $('#messageForm').submit(function (event) {
        event.preventDefault();

        var user = $('#nameInput').val();
        var message = $('#messageInput').val();

        $.ajax({
            type: 'POST',
            url: 'addMessage.php',
            data: {user: user, message: message},
            success: function () {
                loadMessages();
            }
        });
    });

    function loadMessages() {
        $.ajax({
            type: 'GET',
            url: 'getMessages.php',
            dataType: 'json',
            success: function (data) {
                displayMessages(data);
            },
            error: function (xhr, status, error) {
                console.error('Error loading messages:', status, error);
            }
        });
    }

    function displayMessages(messages) {
        // Clear previous messages
        $('#messageArea').empty();

        // Display new messages
        messages.forEach(function (message) {
            var messageElement = $('<div>');
            messageElement.append($('<span>').text(message.author + ':').addClass(message.authorClass));
            messageElement.append($('<span>').text(message.message));
            $('#messageArea').append(messageElement);
        });
    }
});
