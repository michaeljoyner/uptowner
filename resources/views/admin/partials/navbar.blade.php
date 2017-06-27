<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logos/uptowner_logo@2x.png') }}" alt="logo" width="70px"/>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/admin">Home</a></li>
                <li><a href="/admin/menu/groups">Menu</a></li>
                <li><a href="/admin/events">Events</a></li>
                {{--<li class="dropdown">--}}
                    {{--<a href="#"--}}
                       {{--class="dropdown-toggle"--}}
                       {{--data-toggle="dropdown"--}}
                       {{--role="button"--}}
                       {{--aria-haspopup="true"--}}
                       {{--aria-expanded="false"--}}
                    {{-->Cards <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="/admin/cards">View</a></li>--}}
                        {{--<li><a href="/admin/cards/search">Search</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/admin/users">Users</a></li>
                <li class="dropdown">
                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false"
                    >{{ Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/users/passwords">Reset Password</a></li>
                        <li>
                            <form action="/admin/logout" method="POST" class="logout-form">
                                {!! csrf_field() !!}
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>