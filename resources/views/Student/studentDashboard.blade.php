@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student dashboard iiyotin</h1>
        <p>Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>
    </div>
@endsection
s
