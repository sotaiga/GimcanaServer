<ul>
    <li>
        <a href="{!! route('start') !!}">Pàgina inicial</a>
    </li>
    <li>
        <a href="{!! route('get_pin', ['gimcana_id' => $gimcana->gimcana_id]) !!}">Obtenir PIN</a>
    </li>
    <li>
        <a href="{!! route('standings', ['gimcana_id' => $gimcana->gimcana_id]) !!}">Participants</a>
    </li>
</ul>
