@extends('layouts.default', ['gimcana' => $gimcana])

@section('content')

<div class="container">
    <h1>Participacions</h1>
    <h2>{!! $gimcana->gimcana_nom !!}</h2>

    @if ($equips->count() > 0)

    <table>
      <thead>
        <tr>
          <th>Posició</th>
          <th>Nom Equip</th>
          <th>Adreça electrònica</th>
          <th>Punts</th>
          <th>Núm. respostes correctes</th>
          <th>Núm. respostes ordre correcte</th>
          <th>Temps (minuts)</th>
          <th>Inici</th>
          <th>Final</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($equips as $index => $equip)
        <tr>
            <td>{!! $index !!}</td>
            <td>{!! $equip->equip_nom !!}</td>
            <td>{!! $equip->equip_email !!}</td>
            <td>{!! $equip->punts !!}</td>
            <td>{!! $equip->equip_num_respostes_correctes !!}</td>
            <td>{!! $equip->equip_num_respostes_en_ordre !!}</td>
            <td>{!! $equip->temps !!}</td>
            <td>{!! $equip->equip_inici !!}</td>
            <td>{!! $equip->equip_fi !!}</td>
        </tr>
        @endforeach

      </tbody>
    </table>

    @endif

</div>

@stop
