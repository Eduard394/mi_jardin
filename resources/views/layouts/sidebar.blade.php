<aside class="main-sidebar" id="sidebar-wrapper">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/images/sistema/User_Circle.png" class="img-circle"
                     alt="User Image"/>
            </div>
            <div class="pull-left info">
                @if (Auth::guest())
                <p>InfyOm</p>
                @else
                    <p>{{ Auth::user()->name}}</p>
                @endif

                <a href="#"><i class="fa fa-circle text-success"></i>@lang('En linea')</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            @include('layouts.menu')
        </ul>
    </section>
</aside>