<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="app">
                        <router-link :to="{name: 'purchases'}">Purchases</router-link> |
                        <router-link :to="{name: 'offerings'}">Offerings</router-link>
                        <hr>
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ elixir('js/app.js') }}"></script>
    </body>
</html>
