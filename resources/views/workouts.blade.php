@extends('layouts.app')

@section('content')
    <div id="react-workouts" data-user='{{ json_encode(auth()->user()) }}'></div>
@endsection
