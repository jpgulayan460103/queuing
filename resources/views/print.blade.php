<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rigen Marketing</title>


        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            @page {
                margin: 0px;
                padding: 0px;
                padding-bottom: 70px;
            }
            body { margin: 0px;  padding-bottom: 70px;}
            h1, h2, h3, h4{
                line-height: 0.1;
            }
            hr { 
                display: block;
                margin-left: auto;
                margin-right: auto;
                border-style: dashed;
                border-width: 1px;
            }
        </style>
    </head>
    <body>
        <div style="width: 100mm;">
            <center>
                <img src="img/logo.png" style="width: inherit; margin-bottom: 10px">
                <h1 style="text-align: center">MATI</h1>
                <hr>
                <h2 style="text-align: center">{{ sprintf('%03d',$priority_number->priority_number) }}</h2>
                <hr>
                <h4 style="text-align: center">{{ strtoupper($priority_number->type) }}</h4>
                <p style="text-align: center;font-size:14pt">{{ strtoupper($priority_number->created_at->toDayDateTimeString()) }}</p>
            </center>
        </div>
        <script>
            setTimeout(() => {
                window.print();
                self.close();
            }, 100);
        </script>
    </body>
</html>
