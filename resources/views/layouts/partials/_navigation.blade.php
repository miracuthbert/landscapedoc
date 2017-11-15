{{--<div id="top">--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="col-sm-12">--}}
{{--<div class="pull-right">--}}
{{--<ul class="nav nav-pills">--}}
{{--&nbsp;<li>--}}
{{--<a href="{{ url('/') }}">Home</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="">Services</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="">About Us</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="">Contact Us</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'LandscapeDoc') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ route('services.index') }}">Services</a>
                </li>
                <li>
                    <a href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li>
                    <a href="">About</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->username != null ? Auth::user()->username : Auth::user()->firstname }}
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li><a href="{{ route('home') }}">My Dashboard</a></li>
                                <li>
                                    <a href="{{ route('user.profile') }}">Profile</a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
            </ul>
        </div>
    </div>
</nav>