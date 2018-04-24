<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Game') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    img {
        width:48px;
        height:48px;
    }
    .dropdown-menu{
        width: 100%;
    }
    .con {
        width: 100%;
        height: 100%;
    }
    .bar {
        white-space: nowrap;
    }
    head, body{
        width: 100%;
        height: 100%;
    }
    .text {
        display: inline-block;
        width: 75%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid red;
        border-radius: 4px;
    }
    .ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        border: 1px solid #e7e7e7;
        background-color: #f3f3f3;
    }
    .li {
        float: left;
    }
    .li a {
        display: block;
        color: #666;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    .li a:hover:not(.active) {
        background-color: #ddd;
    }
    .li a.active {
        color: white;
        background-color: #4CAF50;
    }
    .button {
      display: inline-block;
      border-radius: 4px;
      background-color: #f4511e;
      border: none;
      color: #FFFFFF;
      text-align: center;
      font-size: 28px;
      padding: 5px;
      width: 180px;
      height: 50px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 5px;
    }
    .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }
    .button span:after {
      display: inline-block;
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }
    .button:hover span {
      display: inline-block;
      padding-right: 25px;
    }
    .button:hover span:after {
      display: inline-block;
      opacity: 1;
      right: 0;
    }
        /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 50px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
    .right{
        float: right;
    }
    .button2 {
        border-radius: 3px;
        height: 55px;
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 12px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 20px;
        margin: 8px 0px;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <a class="navbar-brand" href="{{ route('login') }}">
                {{ ('Budding Share Market Investor') }}
            </a>
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                </div>
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @else
                    <li class="nav-item dropdown">
                        <div class="bar">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <div class="con">
                                        <a class="dropdown-item" href="/programmingProject1/public/resetpassword">
                                            {{ __('Reset Password') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </div>
                            </div>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
    <ul class = "ul">
      <li class="li" onclick="popdown()"><a>New Trading Account</a></li>
      <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <div class="right"><span class="close">&times;</span></div>
            <h2>Create a new trading account:</h2>
            <form action="{{ action('TradingAccountController@createTradingAccount') }}" method="post">
            <input type="text" class="text" id="nname" name="nname"
              placeholder="Enter a nickname for the new trading account" required>
            <button type="button" id="check1" class="button2" onclick="check()">Check</button>
            <button class="button" id="proceed1" style="vertical-align:middle;display:none;" type="submit"><span>Proceed </span></button>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
            <div id="response"></div>
            </form>
            <script>
            function check(){
                if((document.getElementById('nname').value) != ""){
                    $('#response').html(`

                    `)
                    document.getElementById("proceed1").style.display="block";
                    @foreach ($lists3 as $list)
                        //console.log("{{$list->nickname}}");
                            var exists = "{{$list->nickname}}";
                            if((document.getElementById('nname').value) == (exists)){
                                $('#response').html(`
                                    <h5><font color="red">Error: Nickname already exists in database. Please enter a new nickname.</font></h5>
                                `)
                                document.getElementById("proceed1").style.display="none";
                            }
                    @endforeach
                }else{
                    $('#response').html(`
                        <h5><font color="red">Error: Invalid nickname. Please enter a new nickname.</font></h5>
                    `)
                }
            }
            </script>
          </div>
      </div>
      <li class="li"><a href="#news">Transaction History</a></li>
      <li class="li"><a href="#contact">My Stock Performance</a></li>
      <li class="li"><a href="#about">Search for Stock</a></li>
      <li class="li"><a href="/programmingProject1/public/transfer">Transfer Funds</a></li>
      <li class="li"><a href="/programmingProject1/public/nickname">Change Nickname</a></li>
    </ul>
    <script>
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        function popdown(){
            modal.style.display = "block";
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
