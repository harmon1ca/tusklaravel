<?php
namespace App\Http\Controllers;

use App\Http\Controllers\ScrapController as Scrap;
use App\Proxies;
use \DOMDocument;
use \DOMXPath;

use Illuminate\Pagination\Paginator;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ProxyListController extends Controller
{
    public function showProxy()
    {
        $proxies = new Proxies();

        if(request()->has('ip')){
            $proxies = $proxies->orderBy(request('ip'),'asc');
        }

        if(request()->has('ssl')){
            $proxies = $proxies->orderBy(request('ssl'),'asc');
        }
        if(request()->has('port')){
            if(request('port') == 'ANY')
                $proxies = $proxies->where('id','>',0);
            else
                $proxies = $proxies->where('port','=',request('port'));
        }

        if(request()->has('country')){
            if(request('country') == 'ANY')
                $proxies = $proxies->where('id','>',0);
            else
                $proxies = $proxies->where('country','=',request('country'));
        }

        if(request()->has('LATENCY')){
            if(request('LATENCY') == 'ANY')
                $proxies = $proxies->where('id','>',0);
            else
                $proxies = $proxies->where('LATENCY','=',request('LATENCY'));
        }

        if(request()->has('anonim')){
            $proxies = $proxies->orderBy(request('anonim'),'desc');
        }

        if(request()->has('availablity')){
            $proxies = $proxies->orderBy(request('availablity'),'desc');
        }

        $proxies = $proxies->paginate(15)->appends([
            'ip' => request('ip'),
            'port' => request('port'),
            'ssl' => request('ssl'),
            'anonim' => request('anonim'),
            'LATENCY' => request('LATENCY'),
            'country' => request('country'),
            'availablity' => request('availablity')
        ]);

        $allproxy = Proxies::all();

        return view('proxy', ['proxies' => $proxies,'allproxy' => $allproxy]);
    }

    public function filterProxy($order)
    {

        $proxies = DB::table('proxies')->orderBy($order, 'asc')->get();
        return view('table',['proxies' => $proxies->data]);
    }


    public function insertProxy()
    {
        $scrap = new Scrap();
        $body = $scrap->getCurl('https://free-proxy-list.net/');
        $scrap->XpathParse($body);

    }


}