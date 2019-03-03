<?php
/**
 * Created by PhpStorm.
 * User: oksan
 * Date: 28.02.2019
 * Time: 18:58
 */

namespace App\Http\Controllers;

use App\SuperjobAPI;

define("CLIENT_ID",  env("CLIENT_ID", 0000));
define("CLIENT_SECRET", env("CLIENT_SECRET", ""));

class SuperJobController extends Controller
{
    public function findForm(){
        $resumes = $this->resumes('','','','','','','','',14);
        return view('stats/form', compact('resumes'));
    }

    public function getTowns(){
        $towns = $this->towns(request()->keyword);
        return $towns;
    }

    public function towns($keyword){
            $API = new SuperjobAPI();
            $API->setSecretKey(CLIENT_SECRET);
            $redirect_uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}?access=1#oauth";

            $towns = $API->towns(array(
                    'keyword' => $keyword));

        return $towns;
    }

    public function findJson(){
        return  $this->resumes(request()->experience_from, request()->experience_to,
            request()->age_from,request()->age_to,
            request()->payment_from,
            request()->payment_to,
            request()->type_of_work,
            request()->keyword,
            request()->town);
    }

    public function resumes($experience_from, $experience_to,
                              $age_from, $age_to,
                              $payment_from, $payment_to,
                              $type_of_work,
                              $keyword,
                              $town){
            $API = new SuperjobAPI();
            $API->setSecretKey(CLIENT_SECRET);
            $redirect_uri = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['SCRIPT_NAME']}?access=1#oauth";
            $resumes = $API->resumes(array('experience_from' => $experience_from,'experience_to' => $experience_to,
                    'age_from' => $age_from,'age_to' => $age_to,
                    'payment_from'=>$payment_from, 'payment_to'=>$payment_to,
                    'type_of_work'=>$type_of_work,
                    'keyword' => $keyword,
                    't' => [$town],
                    'page'=>0,
                    'count' => 100));
            return $resumes;
    }
}