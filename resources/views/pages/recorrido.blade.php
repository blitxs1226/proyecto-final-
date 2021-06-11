{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col text-center">
            <a href="javascript: history.go(-1)" class="btn btn-info ">
                @if ($id == 1)
                    Ingresar nodos
                @else
                    Regresar
                @endif
            </a>
        </div>
    </div>
    <br>
    <div class="card ">
        <div class="card-header text-center">{{ $nodo->Nombre }}</div>
        <div class="card-body text-center">
            {{ $nodo->Valor }}
        </div>
    </div>
    <br>
    <div class="row">
        {{-- forreach bootnes --}}
        @foreach ($nodo->raices as $idirigo)
            <div class="col text-center">
                <a href="{{ route('reco', ['id' => $idirigo->Dirigido]) }}"
                    class="btn btn-info btn-block">{{ $idirigo->rDirigido->Nombre }}</a>
            </div>
        @endforeach
    </div>

@endsection
