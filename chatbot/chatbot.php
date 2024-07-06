<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Chatbot</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      display: flex;
      flex-direction: column;
      height: 100vh;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    #chat-log {
      flex-grow: 1;
      overflow-y: auto;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 10px;
      background-color: #fff;
    }

    .chat-bubble {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 10px;
    }

    .user-bubble {
      background-color: #DCF8C6;
    }

    .bot-bubble {
      background-color: #F5F5F5;
    }

    .message {
      display: inline-block;
      margin: 5px 0;
    }

    .timestamp {
      font-size: 12px;
      color: #888;
    }

    #user-input-container {
      display: flex;
      margin-top: 10px;
    }

    #user-input {
      flex-grow: 1;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    #send-button {
      margin-left: 10px;
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    #go-back-button {
      margin-left: 10px;
      padding: 5px 10px;
      background-color: #FF0000;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <div id="chat-log"></div>
    <div id="user-input-container">
      <input type="text" id="user-input" placeholder="Type your message...">
      <button id="send-button">Send</button>
      <button id="go-back-button">Go Back</button>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // Function to append a message to the chat log
      function appendMessage(message, sender) {
        var chatLog = $("#chat-log");
        var senderClass = sender === "user" ? "user-bubble" : "bot-bubble";
        var timestamp = new Date().toLocaleTimeString();

        var messageHtml = "<div class='chat-bubble " + senderClass + "'>" +
                          "<span class='message'>" + message + "</span>" +
                          "<span class='timestamp'>" + timestamp + "</span>" +
                          "</div>";
        chatLog.append(messageHtml);
        chatLog.scrollTop(chatLog.prop("scrollHeight"));
      }

      // Function to handle user input
      function handleUserInput() {
        var userInput = $("#user-input").val();
        appendMessage(userInput, "user");

        // Send user input to the server and receive a response
        $.ajax({
          url: "bot.php", // The PHP file to handle the chatbot logic
          method: "POST",
          data: { message: userInput },
          success: function(response) {
            appendMessage(response, "bot");
          },
          error: function() {
            appendMessage("An error occurred. Please try again.", "bot");
          }
        });

        // Clear the user input field
        $("#user-input").val("");
      }

      // Handle Send button click event
      $("#send-button").click(function() {
        handleUserInput();
      });

      // Handle Enter key press event
      $("#user-input").keypress(function(event) {
        if (event.which === 13) {
          event.preventDefault();
          handleUserInput();
        }
      });

      // Handle Go Back button click event
     $("#go-back-button").click(function() {
    window.history.back();
});

      // Bot introduction
      $(document).ready(function() {
        $.ajax({
          url: "bot.php", // The PHP file to handle the chatbot logic
          method: "POST",
          data: { message: "intro" },
          success: function(response) {
            appendMessage(response, "bot");
          },
          error: function() {
            appendMessage("An error occurred. Please try again.", "bot");
          }
        });
      });
    });
  </script>
</body>
</html>
