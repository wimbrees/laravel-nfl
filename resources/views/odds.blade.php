@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/odds">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Week</label>
                    <select name="week" class="form-control">
                        @for ($i = 1; $i < 25; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <label>Starts</label>
                    <select name="starts" class="form-control">
                        <option value="18">18</option>
                        <option value="19">19</option>
                    </select>
                </div>
            </div>
            @for ($i = 0; $i < 14; $i++)
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label>Away</label>
                        <select name="games[{{ $i }}][away_id]" class="form-control">
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                          <label>Home</label>
                          <select name="games[{{ $i }}][home_id]" class="form-control">
                              @foreach ($teams as $team)
                                  <option value="{{ $team->id }}">{{ $team->name }}</option>
                              @endforeach
                          </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-1">
                          <label>Away Odds</label>
                          <input name="games[{{ $i }}][ml_away]" type="number" step="0.01" class="form-control">
                    </div>
                    <div class="form-group col-md-1">
                          <label>Home Odds</label>
                          <input name="games[{{ $i }}][ml_home]" type="number" step="0.01" class="form-control">
                    </div>
                    <div class="form-group col-md-1">
                          <label>Home Line</label>
                          <input name="games[{{ $i }}][spread_home]" type="number" step="0.5" class="form-control">
                    </div>
                    <div class="form-group col-md-1">
                          <label>Total</label>
                          <input name="games[{{ $i }}][total]" min="10" type="number" step="0.5" class="form-control">
                    </div>
                </div>
                <hr>
            @endfor
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
