@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="d-flex flex-wrap justify-content-around my-achievements">
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/mourinhista.jpg" alt="Mourinhista">
            <div class="card-body {{ $achievements->mourinhista ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Mourinhista</h5>
                <p class="card-text">Guanya una jornada sent el jugador que menys unitats hagi apostat aquella setmana (o un dels que menys)</p>
                <small>*Mínim d'apostes realitzades = 0</small><br>
                <small>**Beneficis mínims = 0</small>
            </div>
        </div>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/hat-trick.jpg" alt="Hat-Trick">
            <div class="card-body {{ $achievements->{'hat-trick'} ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Hat-Trick</h5>
                <p class="card-text">Encerta els tres tipus diferents d'aposta per a un únic partit</p>
            </div>
        </div>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/pana.jpg" alt="Pana">
            <div class="card-body {{ $achievements->pana ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Pana</h5>
                <p class="card-text">Aposta per un favorit a handicap i que la diferència final a favor del favorit estigui 14 punts o més per sobre de la línia marcada</p>
            </div>
        </div>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/underdog.jpg" alt="Underdog">
            <div class="card-body {{ $achievements->underdog ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Underdog</h5>
                <p class="card-text">Encerta que un equip guanyarà el partit a quota 2.40 o superior</p>
            </div>
        </div>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/elefantes.jpg" alt="Elefantes">
            <div class="card-body {{ $achievements->elefantes ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Elefantes</h5>
                <p class="card-text">Encerta una aposta a Over en un partit en què s'anotin 60 o més punts</p>
                <small>*La línia d'Over/Under marcada no cal que sigui superior a 60, només el total real del partit</small>
            </div>
        </div>
        <div class="card mb-3" style="width: 18rem;">
            <img class="card-img-top" src="images/fan.jpg" alt="Fan">
            <div class="card-body {{ $achievements->fan ? 'btn-success' : 'btn-danger' }}">
                <h5 class="card-title">Fan</h5>
                <p class="card-text">Encerta durant tres setmanes consecutives (byes no inclosos) si el teu equip guanyarà o perdrà el handicap</p>
            </div>
        </div>
    </div>
</div>
@endsection
