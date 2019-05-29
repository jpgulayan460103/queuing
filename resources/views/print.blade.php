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
            }
            body { margin: 0px;}
            h1, h2, h3, h4, h5{
                line-height: 0.6;
                font-size: 250%
            }
            hr { 
                display: block;
                margin-left: auto;
                margin-right: auto;
                border-style: dashed;
                border-width: 1px;
            }
            #priority_number, #rigen{
                font-size: 400%;
            }
            #marketing{
                font-size:200%
            }
        </style>
    </head>
    <body>
        <div style="width: 100mm;">
            <center>
                <br>
                <h1 style="text-align: center" id="rigen">RIGEN</h1>
                <h4 style="text-align: center" id="marketing">MARKETING</h4><br>
                <h1 style="text-align: center">- MATI -</h1>
                <hr>
                <h2 style="text-align: center" id="priority_number">{{ sprintf('%03d',$priority_number->priority_number) }}</h2>
                <hr>
                <h4 style="text-align: center;padding-bottom:5px;">{{ strtoupper($priority_number->type) }}</h4>
                <h5 style="text-align: center;padding-bottom:5px;">{{ strtoupper($priority_number->created_at->format('F d, Y')) }}</h5>
                <h5 style="text-align: center;">{{ strtoupper($priority_number->created_at->format('h:i:s A')) }}</h5>
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
