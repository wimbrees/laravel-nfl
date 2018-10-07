@extends('layouts.app')
@section('content')
<div class="container">
    <form class="form-inline" method="POST" action="/achievements">
        @csrf
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <select name="userId" class="form-control">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group ml-2">
            <label for="achievement" class="sr-only">Achievement</label>
            <select name="achievement" class="form-control">
                <option value="mourinhista">Mourinhista</option>
                <option value="hat-trick">Hat-Trick</option>
                <option value="pana">Pana</option>
                <option value="underdog">Underdog</option>
                <option value="elefantes">Elefantes</option>
                <option value="fan">Fan</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary ml-2">Save</button>
        </div>
    </form>
</div>
@endsection
