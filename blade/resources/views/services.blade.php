@extends('layouts.landing')


@section('title', 'Services')

@section('content')

    <h1>Services</h1>
    <div class="cards">
        @component('_components.card')
            @slot('title', 'Service 1')
            @slot('content', 'lorem ipsum dolor sit amet, consectetur adip')
        @endcomponent
        @component('_components.card')
            @slot('title', 'Service 2')
            @slot('content', 'lorem ipsum dolor sit amet.')
        @endcomponent
        @component('_components.card')
            @slot('title', 'Service 3')
            @slot('content', 'lorem ipsum.')
        @endcomponent
    </div>

@endsection
