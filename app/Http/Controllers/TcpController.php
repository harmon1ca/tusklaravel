<?php

namespace App\Http\Controllers;

use App\Proxies;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class TcpController extends Controller
{
    public function __proxyChecker($ips,$ports)
    {
        $starttime = microtime(true);
        $file      = @fsockopen ($ips, $ports, $errno, $errstr, 10);
        $stoptime  = microtime(true);
        $status    = 0;

        if (!$file) $status = -1;  // Site is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }
        return $status;
    }


    public function index()
    {
        $proxies = Proxies::all();
//        $proxies = Proxies::where('id','<', 15)->get();
        $status = array();
        foreach ($proxies as $proxy)
        {
            array_push($status,array('status'=>self::__proxyChecker($proxy->ip,$proxy->port),'id'=>$proxy->id));
        }

        return $status;
    }

    public function curlRequest()
    {
        $proxies = Proxies::all();

        $mh = curl_multi_init();
        $cArray = array();
        set_time_limit (0);
        foreach($proxies as $key => $proxy)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://google.com");
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
            curl_setopt($ch, CURLOPT_PROXY, $proxy->ip);
            curl_setopt($ch, CURLOPT_PORT, $proxy->port);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_multi_add_handle($mh, $ch);
            $cArray[$key] = $ch;
        }
        $running = null;
        do
        {
            $mrc = curl_multi_exec($mh, $running);

        }while($mrc == CURLM_CALL_MULTI_PERFORM);

        while ($running && $mrc == CURLM_OK) {
            if (curl_multi_select($mh) != -1) {
                usleep(1);
            }
            do {
                $mrc = curl_multi_exec($mh, $active);
            } while ($mrc == CURLM_CALL_MULTI_PERFORM);
        }

        foreach($cArray as $key => $ch)
        {
            $content = curl_multi_getcontent($ch);
//            print $content;
            curl_multi_remove_handle($mh, $ch);
        }

        curl_multi_close($mh);

        return $content;
    }
}
