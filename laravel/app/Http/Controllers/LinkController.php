<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Controllers\Controller;
use Request;
use DB;
use Redirect;

class LinkController extends Controller {

    public function create(Request $request) {

        if (Request::isMethod('post')) {
            $url = Request::input('url');
            if (isset($url) === true && filter_var($url, FILTER_VALIDATE_URL)) {

                $hash = null;
                $exists = Link::where('url', '=', $url);

                if ($exists->count() >= 1) {
                    $hash = $exists->first()->hash;
                    return redirect('/')->with('get', '<a href="' . [url('/get')][0] . '?h=' . $hash . '">' . [url('/get')][0] . '?h=' . $hash . '</a>');
                } else {
                    $urlDB = Link::create(['url' => $url]);
                    $idDB = $urlDB->id;
                    $hash = base_convert($idDB, 10, 36);

                    DB::table('links')
                            ->where('id', $idDB)
                            ->update(['hash' => $hash]);
                }

                if ($hash != null) {
                    return redirect('/')->with('get', '<a href="' . [url('/get')][0] . '?h=' . $hash . '">' . [url('/get')][0] . '?h=' . $hash . '</a>');
                }
            } else {
                return redirect('/')->with('error', 'You probaly did not enter corret URL');
            }
        }
    }

    public function get() {
        if (isset($_GET['h'])) {
            $link = DB::table('links')->where('hash', $_GET['h'])->first()->url;
            return Redirect::to($link);
        } else {
            return redirect('/')->with('error', 'Something went wrong, try again');
        }
    }

}
