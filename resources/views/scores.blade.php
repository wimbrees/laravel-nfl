@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/scores">
            @csrf
            @foreach ($games as $game)
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Away</label>
                        <input class="form-control" disabled type="name" value="{{ $game->away->name }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label>Score</label>
                        <input name="games[{{ $game->id }}][away_score]" class="form-control" type="number" min="0" max="100" step="1">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Home</label>
                        <input class="form-control" disabled type="name" value="{{ $game->home->name }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label>Score</label>
                        <input name="games[{{ $game->id }}][home_score]" class="form-control" type="number" min="0" max="100" step="1">
                    </div>
                </div>
                <hr>
            @endforeach
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection('content')
