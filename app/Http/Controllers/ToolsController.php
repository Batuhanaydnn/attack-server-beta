<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolsController extends Controller
{
    public function nmap(Request $request){
        $error = "Error Occured";
        $ip_addr = $request->input('ip');
        $advance = $request->input('advance');


        $tldList = [
            'com',
            'net',
            'com.tr',
            'xyz',
            // You can add the allowed tld list below.
        ];

        if(preg_match('/^[0-9\.\s-]+$/', $ip_addr)){
            //
            $command = "nmap ".escapeshellarg($advance)." " .escapeshellarg($ip_addr);
            $result = shell_exec($command);
            echo "<pre>{$result}</pre>";

        }
        elseif(preg_match('/\.(?:' . implode('|', $tldList) . ')$/', $ip_addr)){
            $command = "nmap " .escapeshellarg($advance)." ".escapeshellarg($ip_addr);
            $result = shell_exec($command);
            echo "<pre>{$result}</pre>";
        }
        else{
            return $error;
        }
    }

}
