<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel websocket</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                   <h1> Laravel websocket </h1>
                   <div id="notification"></div>

                </div>

                <!-- <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div> -->
            </div>
        </div>
    </body>
    <script>
            window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>
    <script src="//{{ Request::getHost() }}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js"></script>
    <script src="{{ url('/js/laravel-echo-setup.js') }}" type="text/javascript"></script>
    
    <script type="text/javascript">
        var i = 0;
        window.Echo.channel('user-channel')
         .listen('.UserEvent', (data) => {
            i++;
            $("#notification").append('<div class="alert alert-success">'+i+'.'+data.title+'</div>');
        });
        Echo.channel('test')
            .listen('TestEvent', e => {
                showNotification(e.title);
            });

            function showNotification(msg) {
                if (!("Notification" in window)) {
                    alert("This browser does not support desktop notification");
                }
                else if (Notification.permission === "granted") {
                    // If it's okay let's create a notification
                    var notification = new Notification(msg);
                }
                else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                        // If the user accepts, let's create a notification
                        if (permission === "granted") {
                            var notification = new Notification(msg);
                        }
                    });
                }
            }
    </script>
    <!-- <script>
       window.laravel_echo_port='{{env("LARAVEL_ECHO_PORT")}}';
    </script>
            <script src="http://{{Request::getHost()}}:{{env('LARAVEL_ECHO_PORT')}}/socket.io/socket.io.js" type="text/javascript"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script>
        Echo.channel('test')
            .listen('TestEvent', e => {
                console.log(e)
            });
    </script> -->
    <!-- <script src="{{url('js/app.js')}}" type="text/javascript"></script>
    <script type="text/javascript">

var socket = io(`{{Request::getHost()}}:{{env('LARAVEL_ECHO_PORT')}}`);
console.log(socket);
socket.on(`user-channel:.App\\Events\\UserEvent`, function (data) {
    console.log(data);
});

socket.on('user-channel:.UserEvent', (data) => {
    console.log(data);
});

window.Echo.join('user-channel');
      var i=0;
      console.log(Echo.channel('user-channel'));
       window.Echo.channel('user-channel')
        .listen('.UserEvent', (data) => {
            i++;
            console.log(data);
            $("#notification").append('<div class="alert alert-success">'+i+'.'+data.title+'</div>')
        });
    </script>

    <script>
        Echo.channel('test_name')
            .listen('TestEvent', e => {
                console.log(e)
            })
    </script> -->
</html>
