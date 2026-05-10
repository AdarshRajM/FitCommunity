@extends('layouts.app')

@section('content')
    <div id="react-report-analysis" data-user='{{ json_encode(auth()->user()) }}'></div>
@endsection
