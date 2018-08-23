
<h1>Proxy</h1>

<table class="table">
    <thead>
    <tr>
        <th>Ip</th>
        <th>port</th>
        <th>ssl</th>
        <th>country</th>
        <th>anonymity</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($proxies as $proxy)
        <tr>
            <td>
                {{ $proxy->ip }}
            </td>
            <td>
                {{ $proxy->port }}
            </td>
            <td>
                {{ $proxy->ssl }}
            </td>
            <td>
                {{ $proxy->country }}
            </td>
            <td>
                {{ $proxy->anonim }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
