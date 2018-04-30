@extends('layouts.app2')
<style>
.container{
    width: 100%;
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
.button2 {
    background-color: #f44336;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
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
.dropdown {
    position: relative;
    display: inline-block;
}
.dropdown-content2 {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 380px;
    min-height: 110px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    white-space: nowrap;
}
.dropdown:hover .dropdown-content2{
    display: block;
}

input[type=text] {
    display: inline-block;
    width: 75%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid red;
    border-radius: 4px;
}
.img2 {
  width:22px;
  height:22px;
}
.buttonOption {
  display: inline-block;
  padding: 15px 25px;
  font-size: 24px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.buttonOption:hover {background-color: #3e8e41}

.buttonOption:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.con2 {
        width: 100%;
        height: 100vh;
}
#table-scroll {
  height:160px;
  overflow:auto;
  margin-top:20px;
}
#search-text-input{
    border-top:thin solid  #e5e5e5;
    border-right:thin solid #e5e5e5;
    border-bottom:0;
    border-left:thin solid  #e5e5e5;
    box-shadow:0px 1px 1px 1px #e5e5e5;
    height:40px;
    margin:.8em 0 0 0em;
    outline:0;
    padding:.4em 0 .4em .6em;
    width:450px;
}
.search{
    height: 35px;
    width: 35px;
}
.bar {
    white-space: nowrap;
}
</style>
@section('content')
<div class="container">
    <div class="row justify-content-left">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">My Trading Accounts</h5>
          <table class="table table-striped table-sm">
              <thead>
                  <tr>
                    <th>Nickname</th>
                    <th>Account Balance (AUD)</th>
                    <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($lists2 as $list)
                  <tr>
                    <td>{{$list->nickname}}</td>
                    <td>{{$list->balance}}</td>
                    <td>
                      <div class="dropdown">
                        <img class="img2" src="https://cdn3.iconfinder.com/data/icons/gray-toolbar-4/512/dustbin-512.png">
                        <div class="dropdown-content2">
                          <h5><b>Confirm deleting this trading account?</b></h5>
                          <button onclick="myFunction({{$list->nickname}})" class="button2">Delete</button>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
    function myFunction(String name){
        var user =
    }
    </script>

    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Stock List</h5>
            <div class="bar">
                <!--<form method="post">-->
                <input type='text' placeholder='Search...' id='search-text-input' name='search-text-input'>
                <img class="search" src='https://cdn1.iconfinder.com/data/icons/hawcons/32/698627-icon-111-search-512.png'>
                <div id="searchOutput"></div>
                <!--</form>-->
            </div>
            <script>
                $(document).ready(function(){
                    $(".search").click(function(){
                        if((document.getElementById('search-text-input').value) != ""){
                            $('#searchOutput').html(`

                            `)
                            @foreach ($lists as $list)
                                //console.log("{{$list->nickname}}");
                                    var code = "{{$list->code}}";
                                    var name = "{{$list->name}}";
                                    if( ((document.getElementById('search-text-input').value).toUpperCase() == (code).toUpperCase()) || ((name).toUpperCase().includes((document.getElementById('search-text-input').value).toUpperCase()) == true) ){
                                        $('#searchOutput').html(`
                                            <br>
                                            <b>Match Results:</b>
                                            <br>
                                            <p>Code: {{$list->code}} &nbsp; Name: {{$list->name}}</p>
                                        `)
                                    }
                            @endforeach
                        }else{
                            $('#searchOutput').html(`
                                <p><font color="red">Error: Invalid value. Please enter a stock code / name.</font></p>
                            `)
                        }
                    });
                });
            </script>
            <div id="table-scroll">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>Code</th>
                      <th>Name</th>
                      <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($lists as $list)
                  <tr>
                    <td>{{$list->code}}</td>
                    <td>{{$list->name}}</td>
                    <td>
                      <a href='/home/{{ $list->code }}'>${{$list->value}}
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

    <div class="col-sm-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">
          Trading Account Management
          </h5>
          <ul class="list-group list-group-flush">
            <div class="dropdown">
              <span><li class="list-group-item">New Trading Account</li></span>
                <div class="dropdown-content">
                    <h5><b>New account nickname : </b></h5>
                    <form action="{{ action('TradingAccountController@createTradingAccount') }}" method="post">
                    <input type="text" id="nname" name="nname"
                      placeholder="Enter a nickname for the new trading account" required>
                    <button class="button" style="vertical-align:middle" type="submit"><span>Proceed </span></button>
                    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                    </form>
                </div>
            </div>
            <li class="list-group-item">Transaction History</li>
            <li class="list-group-item">My Stock Performance</li>
            <li class="list-group-item"><a href="/search">Search for Stock</a></li>
              <li class="list-group-item"><a href="home/leaderboard">Leaderboard</a></li>
            <li class="list-group-item"><a href="/programmingProject1/public/transfer">Transfer Funds</a></li>
            <li class="list-group-item"><a href="/programmingProject1/public/nickname">Change Nickname</a></li>
            <li class="list-group-item">Delete Account</li>
          </ul>
        </div>
      </div>
    </div>

  </div>
</div>
<script>
    function myFunction() {
      confirm("Are you sure you want to delete?");
    }
</script>
@endsection
