<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{-- titleつける場合 @section('title', 'ページタイトル') としてください --}}
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif
        {{--
        @section
            <link rel="stylesheet" href="css/app.css">
        @endsection
        としてください
        commonsのuser_checkも同じ形のやつがいるので、ここ修正したらそこも変更してください
        --}}
        <link rel="stylesheet" href="/css/app.css">
        @hasSection('css')
            @yield('css')
        @endif
    </head>
    <body>
        <header>
            <div class="container">
                <!-- <a class="brand" href="/">{{ config('app.name') }}</a> -->
                @if(Auth::user()->is_admin)
                    @include('commons.admin_nav')
                @else
                    @include('commons.user_nav')
                @endif
            </div>
        </header>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </body>
</html>
