<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    {{ HTML::style('css/main.css') }}
</head>
<body>
    
    <div id="container">
        <div id="header">
        <a href="{{ route('home') }}">Make it Snappy Q&A</a>
            <div id="searchbar">
                {{ Form::open(array('route'=>'search')) }}
                {{ Form::token() }}
                {{ Form::text('keyword', '', array('id'=>'keyword', 'placeholder'=>'Search')) }}
                {{ Form::submit('Search') }}
                {{ Form::close() }}
            </div>
        </div><!-- header -->

        <div id="nav">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @if(!Auth::check())
                    <li><a href="{{ route('users.create') }}">Register</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @else
                    <li><a href="{{ route('logout') }}">Logout ({{ Auth::user()->username }})</a></li>
                    <li><a href="{{ route('your_questions') }}">Your Q's</a></li>
                @endif
            </ul>
        </div><!-- nav -->

        <div id="content">
            @if(Session::has('message'))
                <p id="message">{{ Session::get('message') }}</p>
            @endif
            @yield('content')
        </div><!-- content -->

        <div id="footer">
            &copy; Make it Snappy Q&A {{ date('Y') }}
        </div><!-- footer -->
    </div><!-- container -->
</body>
</html>