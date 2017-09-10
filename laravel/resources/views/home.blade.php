<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css')}}">
        <title>URL_Shortener</title>
    </head>
    <body>
        <div class="container">
            <h1>Shorten your URL</h1>

            {!! Form::open(['url' => 'create']) !!}
              {!! Form::text('url') !!}
              {!! Form::submit('Shorten') !!}
            {!! Form::close() !!}  

            <div class="link">
                <?php
                if (session()->has('get')) {
                    echo 'Here is your short URL: ' . session('get');
                } elseif (session()->has('error')) {
                    echo session('error');
                } 
                ?>
            </div>
            
        </div>
    </body>
</html>
