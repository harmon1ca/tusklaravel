<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProxyResource;
use App\Proxies;
use Symfony\Component\HttpFoundation\Request;

class ProxyController extends Controller
{
    public function index()
    {
        return ProxyResource::collection(Proxies::all());
    }

    public function store(Request $request)
    {
        $book = Proxies::create([
            'ip' => $request->ip,
            'port' => $request->port,
            'ssl' => $request->ssl,
            'country' => $request->country,
            'anonymity' => $request->anonymity
        ]);

        return new ProxiesResource($book);
    }

    public function show(Proxies $proxy)
    {
        return new ProxyResource($proxy);
    }

    public function update(Request $request, Proxies $proxy)
    {
        $proxy->update($request->only(['ip','port','ssl','country']));
        return new ProxyResource($proxy);
    }

    public function destroy(Proxies $proxy)
    {
        $proxy->delete();
        return response()->json(null, 202);
    }
}