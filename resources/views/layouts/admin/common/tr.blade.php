@if (count($ths) > 0)
    <tr>
        @foreach ($ths as $th)
            <th>{{ $th }}</th>
        @endforeach
    </tr>
@endif