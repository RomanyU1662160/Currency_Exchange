@extends('layouts.app')

@section('content')
@if(isset($result))
Result = {{$result}}
@endif

<form action="{{route('getForm')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="amount"> Amount </label>
        <input type="number" class="form-control" placeholder="amount" name="amount" id="amount" value=10>
    </div>
    <div class="form-group">
        <label for="base"> From </label>
        <input type="text" class="form-control" placeholder="from" name="from" id="from" value="USD">
    </div>
    <div class="form-group">
        <label for="target"> To </label>
        <input type="text" class="form-control" placeholder="to" name="to" id="to" value="EUR">
    </div>
    <div class="alert">
        <button class="btn btn-info float-right" type="submit"> Calculate</button>
    </div>
</form>
@endsection
