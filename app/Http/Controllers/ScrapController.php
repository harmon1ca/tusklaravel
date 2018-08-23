<?php
namespace App\Http\Controllers;
use \DOMDocument;
use \DOMXPath;
use Illuminate\Support\Facades\DB;

class ScrapController
{
    public static $settings;

    public function getCurl($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $page = curl_exec($ch);
        curl_close($ch);

        return $page;
    }

    public function XpathParse($body)
    {
        $dom = new DOMDocument;
        @$dom->loadHTML($body);

        $dom_xpath = new DOMXPath($dom);
        $data = [];
        $servers = $dom_xpath->query("//table/*[2]/tr");


        foreach ($servers as $row) {

            $td = $dom_xpath->query('td', $row);
            $ip = $td->item(0)->textContent;
            $port = $td->item(1)->textContent;
            $country = $td->item(3)->textContent;
            $anonim = ($td->item(4)->textContent == 'transparent') ? 0 : 1;
            $ssl = ($td->item(6)->textContent == 'yes') ? 1 : 0;

            /*DB::table('proxies')->insert(
                ['ip' => $ip,'port' => $port,'ssl' => $ssl,'country'=>$country,'anonim' => $anonim]
            );*/

        }

    }


}

?>