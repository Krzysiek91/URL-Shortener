<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Controllers\Controller;
use Request;
use DB;
use Redirect;

class LinkController extends Controller {

    public function create(Request $request) {

        if (!Request::isMethod('post')) {
            return;
        }
            
            
        $url = Request::input('url');
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return redirect('/')->with('error', 'You probaly did not enter corret URL');
        }

        $link = Link::where('url', '=', $url)->get()->first();

        if (!$link) {
            // If the link does not exist, create one
            $link = Link::create(['url' => $url]);
            $idDB = $link->id;
            $hash = base_convert($idDB, 10, 36);
            
            $link->hash = $hash;
            $link->save();
        }
                
        $url = url('/' . $link->hash);
        return redirect('/')->with('get', '<a href="' . $url . '">' . $url . '</a>');
    }

    public function get($hash) {        
        $link = Link::where('hash', $hash)->get()->first();      
        if ($link == null){
             return redirect('/')->with('error', 'Coud not find the record in DB');
        }
        return Redirect::to($link->url);
    }
    
}
