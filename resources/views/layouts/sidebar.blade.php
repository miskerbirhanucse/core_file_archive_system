<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none bg-white d-lg-flex justify-content fixed-top">
        <img src="{{asset('backend/asset/images/core.png')}}" alt="logo" style="padding-left: 20px;" />
        <!-- <a class="sidebar-brand brand-logo-mini" href="index.html"><img src="{{asset('backend/asset/images/logo-mini.svg')}}" alt="logo" /></a> -->
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{asset('backend/asset/images/ic_profile.png')}}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal text-white">{{Auth::user()->name}}</h5>

                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link text-white">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="/dashboard">
                <span class="menu-icon bg-secondary">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @hasrole('Super-Admin')
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon bg-secondary">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Manage Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="/admin/users">All Users</a></li>
                </ul>
            </div>
        </li>
        @endhasrole
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#purchase-basic" aria-expanded="false" aria-controls="purchase-basic">
                <span class="menu-icon bg-secondary">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Manage Purchase</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="purchase-basic">
                <ul class="nav flex-column sub-menu">
                    @can('create request')
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.create')}}">Create Purchase</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.list')}}">Purchase List</a></li>
                    @endcan
                    @can('approve request')
                    <li class="nav-item"> <a class="nav-link" href="{{route('approve.page.purchase')}}">Approve Purchase</a></li>
                    @endcan
                    @can('authorize request')
                    <li class="nav-item"> <a class="nav-link" href="{{route('authorize.page.purchase')}}">Authorize Purchase</a></li>
                    @endcan
                    @can('export request')
                    <li class="nav-item"> <a class="nav-link" href="{{route('store.page.purchase')}}">Store Approve Purchase</a></li>

                    <li class="nav-item"> <a class="nav-link" href="{{route('store.list.purchase')}}">Store Purchase Export list</a></li>
                    @endcan
                    @hasrole('Super-Admin')
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.admin_all')}}">All Purchase</a></li>
                    @endhasrole

                </ul>
            </div>
        </li>
        @hasanyrole('Secretary|Super-Admin')
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#file" aria-expanded="false" aria-controls="file">
                <span class="menu-icon">
                    <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">File Archive</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="file">
                <ul class="nav flex-column sub-menu">
                    @hasrole('Secretary')
                    <li class="nav-item" key="1"> <a class="nav-link" href="{{route('archive.list')}}">File Archive List</a></li>
                    @endhasrole
                    <li class="nav-item" key="2"> <a class="nav-link" href="{{route('archive.create')}}">Create File Archive</a></li>
                    @hasrole('Super-Admin')
                    <li class="nav-item"> <a class="nav-link" href="{{route('archive.admin_all')}}">All File Archive List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('show.archive.report')}}">Generate Report</a></li>
                    @endhasrole

                </ul>
            </div>
        </li>
        @endhasanyrole
        <!--
        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-icon">
                    <i class="mdi mdi-chart-bar"></i>
                </span>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-icon">
                    <i class="mdi mdi-contacts"></i>
                </span>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
                <span class="menu-icon">
                    <i class="mdi mdi-file-document-box"></i>
                </span>
                <span class="menu-title">Documentation</span>
            </a>
        </li> -->
    </ul>
</nav>