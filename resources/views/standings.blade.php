@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Units</th>
                <th scope="col" class="text-center">BW</th>
                <th scope="col" class="text-center">BL</th>
                <th scope="col" class="text-center d-none d-md-table-cell">MLW</th>
                <th scope="col" class="text-center d-none d-md-table-cell">MLL</th>
                <th scope="col" class="text-center d-none d-md-table-cell">SW</th>
                <th scope="col" class="text-center d-none d-md-table-cell">SL</th>
                <th scope="col" class="text-center d-none d-md-table-cell">TW</th>
                <th scope="col" class="text-center d-none d-md-table-cell">TL</th>
                <th scope="col" class="text-center">Achievements (+5)</th>
                <th scope="col" class="text-center">Fan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stats as $userStats)
            <tr>
                <th scope="row" class="text-center">{{ $loop->index + 1 }}</th>
                <th class="text-center">{{ $userStats['username'] }}</th>
                <th class="text-center">{{ $userStats['units'] }}</th>
                <td class="text-center">{{ $userStats['bets_won'] }}</td>
                <td class="text-center">{{ $userStats['bets_lost'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['money_line_won'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['money_line_lost'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['spread_won'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['spread_lost'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['over_under_won'] }}</td>
                <td class="text-center d-none d-md-table-cell">{{ $userStats['over_under_lost'] }}</td>
                <td class="text-center">{{ $userStats['achievements'] }}</td>
                <td class="text-center">{{ $userStats['fan'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
