@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Username</th>
                <th scope="col" class="text-center">Units</th>
                <th scope="col" class="text-center dotted-underline" title="Bets Won">BW</th>
                <th scope="col" class="text-center dotted-underline" title="Bets Lost">BL</th>
                <th scope="col" class="text-center dotted-underline d-none d-md-table-cell dotted-underline" title="Money Line Won">MLW</th>
                <th scope="col" class="text-center dotted-underline d-none d-md-table-cell dotted-underline" title="Money Line Lost">MLL</th>
                <th scope="col" class="text-center dotted-underline d-none d-md-table-cell dotted-underline" title="Spread Won">SW</th>
                <th scope="col" class="text-center dotted-underline d-none d-md-table-cell dotted-underline" title="Spread Lost">SL</th>
                <th scope="col" class="text-center d-none d-md-table-cell dotted-underline" title="Totals Won">TW</th>
                <th scope="col" class="text-center d-none d-md-table-cell dotted-underline" title="Totals Lost">TL</th>
                <th scope="col" class="text-center">Achievements</th>
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
