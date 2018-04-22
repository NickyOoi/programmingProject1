<!doctype html>
<html lang="en">
@extends('layouts.app')

@section('content')
<body>
  <div class="container">
    <div class="row justify-content-center">
      <main >

      <div >
          <h1>Stock Details for: {{ $list->code }} - {{ $list->name }} </h1>
        <p>You currently owned # amount in this stock</p>
      </div>

<form method="POST" action="/buy">
  @csrf

      <div class="form-group">
          <label for="name">nickname</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
      </div>

      <div class="form-group">
          <label for="code">Stock code</label>
          <input type="text" class="form-control" id="code" name="code" value="{{ $list->code }}">
      </div>

      <div class="form-group">
        <label for="name">Unit to buy:</label>
        <input type="number" class="form-control" id="amount" name="amount">
      </div>

      <button class="btn btn-primary" type="submit">Buy</button>

</form>

    </main>
</div>
</div>
</body>
</html>
@endsection