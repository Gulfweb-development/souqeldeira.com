<table>
    <tr>
        <th>
            #
        </th>
        <th>
            name
        </th>
        <th>
            adv_count
        </th>
        <th>
            price
        </th>
        <th>
            active
        </th>
    </tr>
    @foreach($lists as $list)
        <tr>
            <td>
                {{ $list->id }}
            </td>
            <td>
                {{ $list->name_ar }}
            </td>
            <td>
                {{ $list->adv_count }}
            </td>
            <td>
                {{ $list->price }}
            </td>
            <td>
                <a href="{{ url('get_subscript/'.$list->id.'/payment') }}">
                    link
                </a>
            </td>
        </tr>
    @endforeach
</table>