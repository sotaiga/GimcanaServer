@extends('layouts.default', ['gimcana' => $gimcana])

@section('content')

<div class="container">
  <h1>Pàgina inicial</h1>
  <h2>{!! $gimcana->gimcana_nom !!}</h2>
</div>

@stop
