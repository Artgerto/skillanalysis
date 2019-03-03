<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SuperJob Skill Analysis</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .app{
            background-color: white;
        }

        html,
        body,
        header,
        .intro-4 {
            /*padding-top: 80px;*/
            height: 100%;
        }

        main {
            /*margin-top: 80px;*/
            min-height: 57vh;
        }
    </style>
</head>
<body>
<div id="app">
            <resume-form :resumes="{{json_encode($resumes)}}"></resume-form>
            {{--<user-profile :user="{{Auth::user()}}" :uprofile="{{$user}}"></user-profile>--}}
</div>
</body>
</html>