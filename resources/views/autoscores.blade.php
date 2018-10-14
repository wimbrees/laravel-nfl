@extends('layouts.app')

@section('content')
    <div class="container">
        <button class="btn btn-primary" id="fetch-scores">Fetch scores</button>
    </div>
@endsection('content')

@section('pagescript')
    <script src="/js/scores.js" defer></script>
@endsection('pagescript')
