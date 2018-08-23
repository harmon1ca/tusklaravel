@extends('layouts.app')
@section('title', 'Proxy')
@section('content')

<h1>Proxy</h1>

<table class="table">
    <thead>
    <tr>
        <th><a href="/?ip=ip">Ip</a></th>
        {{--<th>{!! Form::select('port', $port, 'ALL'); !!}</th>--}}

        <th>
            <form action="/" method="GET">
                <label for="port">port</label>
                <select id="port" class="form-control" name="port">
                    <option value="" disabled selected style="display:none;"></option>
                    <option value="ANY">All</option>
                    @foreach ($allproxy->unique('port') as $proxy)
                        <option value="{{ $proxy->port }}">{{ $proxy->port }}</option>
                    @endforeach
                </select>
            </form>
        </th>
        <th><a href="/?ssl=ssl" >ssl</a></th>
        <th>
            <form action="/" method="GET">
                <label for="country">country</label>
                <select id="country" class="form-control" name="country">
                    <option value="" disabled selected style="display:none;"></option>
                    <option value="ANY">All</option>
                    @foreach ($allproxy->unique('country') as $proxy)
                        <option value="{{ $proxy->country }}">{{ $proxy->country }}</option>
                    @endforeach
                </select>
            </form>
        </th>
        <th><a href="/?anonim=anonim" >anonymity</a></th>
        <th><a href="/?availablity=availablity" >availablity</a></th>
        <th>
            <form action="/" method="GET">
                <label for="latency">latency</label>
                <select id="LATENCY" class="form-control" name="LATENCY">
                    <option value="" disabled selected style="display:none;"></option>
                    <option value="ANY">All</option>
                        @foreach ($allproxy->unique('LATENCY') as $proxy)
                            <option value="{{ $proxy->LATENCY }}">{{ $proxy->LATENCY }}</option>
                        @endforeach
                </select>
            </form>
        </th>
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
            <td>
                {{ $proxy->availablity }}
            </td>
            <td>
                {{ $proxy->LATENCY }}
            </td>
        </tr>
@endforeach
    </tbody>
</table>
{{ $proxies->links() }}

<script>

    var port = document.getElementById('port');
    var country = document.getElementById('country');
    var LATENCY = document.getElementById('LATENCY');
    port.onchange = function(){
        this.form.submit();
    };
    country.onchange = function(){
        this.form.submit();
    };
    LATENCY.onchange = function(){
        this.form.submit();
    };
</script>
@endsection
