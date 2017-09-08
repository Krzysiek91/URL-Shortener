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
            <h1>Shorten your URL :)</h1>

            <form action="" method="post">
                <input type="url" name="url" placeholder="Enter a URL">
                <input type="submit" value="shorten" class="btn"></input>
            </form>
        </div>
    </body>
</html>
