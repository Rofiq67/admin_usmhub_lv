<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">
    
    <title>USM HUB | Room Chat </title>

    <!-- Custom CSS for Bubble Chat -->
    <style>
        .chat-container {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 400px;
            overflow-y: auto;
            background-color: #f9f9f9;
        }

        .bubble {
            padding: 10px;
            border-radius: 15px;
            margin: 5px 0;
        }

        .bubble-left {
            background-color: #e0e0e0;
            text-align: left;
            margin-left: 10px;
        }

        .bubble-right {
            background-color: #007bff;
            color: white;
            text-align: right;
            margin-right: 10px;
        }

        .clear {
            clear: both;
        }
    </style>
</head>
<body>

@extends('layouts-admin.app')

@section('contents')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Room Chat</h6>
            </div>
            <div class="card-body">
                <div class="chat-container" id="chat-list">
                    <!-- Sample chat message -->
                    <div class="bubble bubble-left"> G211200123</div>
                    <div class="clear"></div>
                </div>
                <div class="card-footer">
                    <!-- Input for sending message -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Ketik pesan di sini..." id="chat-input">
                        <button class="btn btn-primary" id="send-chat">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk mengirim chat -->
<script>
    document.getElementById("send-chat").addEventListener("click", function() {
        var chatInput = document.getElementById("chat-input").value;
        if (chatInput.trim() !== "") {
            var chatList = document.getElementById("chat-list");
            var newBubble = document.createElement("div");
            newBubble.className = "bubble bubble-right";
            newBubble.textContent = chatInput;
            chatList.appendChild(newBubble);
            // Bersihkan input setelah mengirim pesan
            document.getElementById("chat-input").value = "";
            // Otomatis scroll ke bawah
            chatList.scrollTop = chatList.scrollHeight;
        }
    });

    // Tambahkan handler untuk enter key
    document.getElementById("chat-input").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            document.getElementById("send-chat").click();
        }
    });
</script>

</body>
</html>
