@extends('layouts.app')

@section('content')

        <div class="col-md-12">
        <div class="chat_window"><div class="top_menu">
            <div class="buttons">
                <div class="button close">

                </div>
                <div class="button minimize">

                </div>
                <div class="button maximize">

                </div>
            </div><div class="title">Chat</div>
        </div>
        <ul class="messages">

        </ul><div class="bottom_wrapper clearfix">
            <div class="message_input_wrapper">
                <input class="message_input" placeholder="Type your message here..." />
            </div><div class="send_message"><div class="icon"></div>
            <div class="text">Send</div>
        </div>
    </div>
</div>
        <div class="message_template">
            <li class="message">
                <div class="avatar">

        </div>
        <div class="text_wrapper">
            <div class="text">

            </div>
        </div>
    </li>
</div>
            <!-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div> -->
</div>
@endsection
