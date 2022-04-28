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
                    <li class="nav-item" > <a class="nav-link" href="{{ route('purchase') }}">New Purchase</a></li>
                    <li class="nav-item" > <a class="nav-link" href="{{ route('purchase.list')}}">Purchase List</a></li>
                    @endcan
                    @can('approve request')
                    <li class="nav-item"> <a class="nav-link" href="{{route('approve.page.purchase')}}">Approve Purchase</a></li>
                    @endcan
                    @can('authorize request')
                    <li class="nav-item" > <a class="nav-link" href="{{route('authorize.page.purchase')}}">Authorize Purchase</a></li>
                    @endcan
                    @can('export request')
                    <li class="nav-item" > <a class="nav-link" href="{{route('store.page.purchase')}}">Store Approve Purchase</a></li>

                    <li class="nav-item"> <a class="nav-link" href="{{route('store.list.purchase')}}">Store Purchase Export list</a></li>
                    @endcan
                    @hasrole('Super-Admin')
                    <li class="nav-item"> <a class="nav-link" href="{{route('purchase.admin')}}"> Purchases</a></li>
                    @endhasrole

                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#letter" aria-expanded="false" aria-controls="letter">
                <span class="menu-icon bg-secondary">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Letter</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="letter">
                <ul class="nav flex-column sub-menu">
                    @hasanyrole('Super-Admin|Secretary')
                    <li class="nav-item"><a class="nav-link" href="{{route('letter')}}">New Letter</a></li>
                    <li  class="nav-item"> <a class="nav-link" href="{{route('letter.list')}}">Letter List</a></li>
                    @endhasanyrole
                    @hasanyrole('Head|Team Leader')
                    <li class="nav-item"> <a class="nav-link" href="{{route('letter.manage')}}">Manage Letter</a></li>
                    @endhasanyrole
                    @hasrole('Team')
                    <li class="nav-item"><a class="nav-link" href="{{route('letter.letters')}}">Letters</a></li>
                    @endhasrole
                    @hasanyrole('GM')
                    <li  class="nav-item"> <a class="nav-link" href="{{route('letter.gm.cc')}}">CC Letters</a></li>
                    @endhasanyrole
                    @hasrole('Super-Admin')

                    @endhasrole

                </ul>
            </div>
        </li>
        @hasanyrole('Secretary|Super-Admin|Head')
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
                    <li class="nav-item" > <a class="nav-link" href="{{route('archive.list')}}"> Archive List</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('archive.create')}}">Create Archive</a></li>
                    @endhasrole

                    @hasrole('Head')
                    <li class="nav-item" key="3"> <a class="nav-link" href="{{route('archive.list')}}">Archive List</a></li>
                    @endhasrole
                    @hasrole('Super-Admin')
                    <li class="nav-item" key="4"> <a class="nav-link" href="{{route('show.archive.report')}}">Generate Report</a></li>
                    @endhasrole
                    @can('access request')
                    <li class="nav-item" key="5"> <a class="nav-link" href="{{route('archive.admin')}}">Archives List</a></li>
                    @endcan
                </ul>
            </div>
        </li>
        @endhasanyrole
    </ul>
</nav>