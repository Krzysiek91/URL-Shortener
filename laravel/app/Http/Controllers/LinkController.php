<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;
use Symfony\Component\Console\Input\Input;
use DB;

class LinkController extends Controller {

    public function create(Request $request) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['url']) === true && filter_var($_POST['url'], FILTER_VALIDATE_URL)) {

                $url = $_POST['url'];
                $hash = null;
                $exists = Link::where('url', '=', $url);

                if ($exists->count() >= 1) {
                    echo 'This URL already has a shortener';
                    $hash = $exists->first()->hash;
                    echo $hash;
                } else {
                    $urlDB = Link::create(['url' => $url]);
                    $hash = base_convert($urlDB, 10, 36);
                    DB::table('links')
                            ->where('id', $urlDB->id)
                            ->update(['hash' => $hash]);
                }
                /*
                  if ($urlDB) {
                  $hash = $urlDB->id;
                  echo $hash;
                  }
                 */
            } else {
                return 'Something went wrong';
            }
        }
    }

    public function get() {
        //
    }

}
