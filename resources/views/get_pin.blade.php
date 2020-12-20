@extends('layouts.default', ['gimcana' => $gimcana])

@section('content')

<div class="container">
    <h1>Obtenir el pin del desbloqueig</h1>
    <h2>{!! $gimcana->gimcana_nom !!}</h2>

    <form method="POST" action="{!! route('do_get_pin') !!}" >
        {!! csrf_field() !!}
        <input name="gimcana_id" type="hidden" value="{!! $gimcana->gimcana_id !!}" />

        <div>
            <label for="gimcana_patro">Patró</label>
            <input name="gimcana_patro" type="text" value="{!! $gimcana->gimcana_patro !!}" readonly required />
        </div>
        <br/>
        <div>
            <label for="data">Data</label>
            <input name="data" type="date" value="{!! $data !!}" required />
        </div>
        <br/>
        <input type="submit" />
    </form>
    <br/>
    @if (isset($pin))
    <h3>PIN: {!! $pin !!}</h3>
    @endif
</div>

@stop
