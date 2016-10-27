<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{!! Request::is('home') ? 'active' : '' !!}"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li><a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.anotherlink') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.multilevel') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                    <li><a href="#">{{ trans('adminlte_lang::message.linklevel2') }}</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-group"></i> <span>Users, Roles, Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{!! Request::is('admin/users*') ? 'active' : '' !!}"><a href="{{ url('admin/users') }}"><i class="fa fa-user"></i> Users</a></li>
                    <li class="{!! Request::is('admin/roles*') ? 'active' : '' !!}"><a href="{{ url('admin/roles') }}"><i class="fa fa-group"></i> Roles</a></li>
                    <li class="{!! Request::is('admin/permissions*') ? 'active' : '' !!}"><a href="{{ url('admin/permissions') }}"><i class="fa fa-key"></i> Permissions</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class="fa fa-bank"></i> <span>Banks & Resources</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{!! Request::is('admin/bankTypes*') ? 'active' : '' !!}"><a href="{{ url('admin/bankTypes') }}"><i class="fa fa-calculator"></i> BankTypes</a></li>
                    <li class="{!! Request::is('admin/interestConventions*') ? 'active' : '' !!}"><a href="{{ url('admin/interestConventions') }}"><i class="fa fa-sliders"></i> InterestConventions</a></li>
                    <li class="{!! Request::is('admin/interestTerms*') ? 'active' : '' !!}"><a href="{{ url('admin/interestTerms') }}"><i class="fa fa-book"></i> InterestTerms</a></li>
                    <li class="{!! Request::is('admin/banks*') ? 'active' : '' !!}"><a href="{{ url('admin/banks') }}"><i class="fa fa-bank"></i> Banks</a></li>
                </ul>
            </li>

            <li class="{!! Request::is('admin/currencies*') ? 'active' : '' !!}"><a href="{{ url('admin/currencies') }}"><i class="fa fa-money"></i> <span>Currencies</span></a></li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
