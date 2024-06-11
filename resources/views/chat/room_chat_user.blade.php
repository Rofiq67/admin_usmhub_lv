<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/ico" href="{{ asset('storage/uploads/logo_pemkab_demak32.ico') }}">
    <title>USM HUB | Room Chat</title>
    <style>
        .chat-container {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 400px;
            overflow-y: auto;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }
        .bubble {
            padding: 10px;
            border-radius: 15px;
            margin: 5px 0;
            max-width: 70%; /* Atur lebar maksimum bubble chat */
            width: fit-content; /* Buat lebar bubble chat dinamis */
            height: auto; /* Buat tinggi bubble chat dinamis */
        }

        .bubble-left {
            background-color: #D0D0D0;
            text-align: left;
            margin-left: 10px;
        }
        .bubble-right {
            background-color: #3E4095;
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
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Room Chat</h6>
                <a href="{{ route('chat.index') }}" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <ul>
                    @if(isset($pengaduan))
                        <h3>{{ $pengaduan->user->username }}</h3>
                    @endif

                    @foreach($users as $user)
                        @if(isset($pengaduan) && $user->id !== $pengaduan->user->id)
                            <h3>{{ $user->username }}</h3>
                        @endif
                    @endforeach
                </ul>

                <div class="chat-container" id="chat-box">
                    <!-- List of messages will be displayed here -->
                    @isset($room)
                        @foreach($room->chats as $chat)
                            <div class="bubble {{ $chat->user_id === auth()->id() ? 'bubble-right' : 'bubble-left' }}">
                                {{ $chat->message }}
                            </div>
                        @endforeach
                    @endisset
                </div>
                <form id="chat-form" method="POST" action="{{ route('chat.send.message') }}" enctype="multipart/form-data"> 
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="input-group mb-3">
                        <label for="file" class="input-group-text" onclick="document.getElementById('file').click()">
                            <i class="fa fa-file"></i>
                        </label>
                        <input type="file" id="file" name="file" class="form-control-file" style="display: none;">
                        <input type="text" id="message" name="message" class="form-control" placeholder="Type your message here..." required>
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadChatHistory() {
        $.ajax({
            type: 'GET',
            url: '{{ route("chat.history") }}',
            success: function (data) {
                $('#chat-box').empty();
                data.forEach(function (chat) {
                    var bubbleClass = chat.user_id === {{ auth()->id() }} ? 'bubble-right' : 'bubble-left';
                    $('#chat-box').append('<div class="bubble ' + bubbleClass + '">' + chat.message + '</div>');
                });
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    loadChatHistory();

    $('#chat-form').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#chat-box').append('<div class="bubble bubble-right">' + data.message + '</div>');
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                $('#chat-form')[0].reset();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>



</body>
</html>
