<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    @lang('menu.text_logo')
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">

                    

                    @if(Auth::check() && Access::check(Auth::user()->role, 'editor'))
                        <li><a href="{{ url('/publish/create') }}"name='account'>@lang('menu.publish')</a></li>
                        <li><a href="{{ url('/admin/posts') }}"name='account'>@lang('menu.admin_posts')</a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login')    }}">@lang('menu.login')</a></li>
                        <li><a href="{{ url('/register') }}">@lang('menu.register')</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::check())
                                    <li>
                                        <a href="{{ url('/account') }}"name='account'>@lang('menu.account')</a>
                                    </li>
                                @endif


                                <li>
                                    <a href="{{ url('/logout') }}">
                                        <i class="fa fa-btn fa-sign-out"></i>@lang('menu.logout')
                                    </a>
                                </li>

                                
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>