<?php

namespace App\Http\Controllers;

use App\Link;
use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Request;


class LinkController extends Controller {

    public function create() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['url']) === true && filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                $url = $_POST['url'];
                Link::create(['url' => $url]);     
            } else {
                echo 'wrong URL';
            }
        }
    }
}
