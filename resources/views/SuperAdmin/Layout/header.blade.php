<div class="az-header">
    <div class="container-fluid">
        <div class="az-header-left">
            <a href="@yield('back_url')" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 pt-2"
                title="click to reload this page"><i class="fa fa-arrow-left mr-0"></i> Back</a>
        </div>
        <div class="az-header-menu1">
            <div class="az-header-menu-header1">
                <a href="dashboard" class="az-logo w-100">
                    <img src="{{ url('assets/img/zaadDocs.png') }}"
                        class="d-md-block animate__animated animate__rubberBand">
                </a>
            </div>
        </div>
        <div class="az-header-right animate__animatedd animate__flipInX">
            <h4 class="mt-2 text-right" style="max-width: 250px;">
                <span class="d-block text-truncate" title=""></span>
            </h4>
            <div class="dropdown az-profile-menu">
                <a href="javascript:void(0)" class="az-img-user shadoww border rounded-10"><img
                        src="{{ url('assets/img/appicon.webp') }}" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-header-profile">
                        <div class="az-img-user shadoww border rounded-10">
                            <img src="{{ url('assets/img/appicon.webp') }}" alt="">
                        </div>
                        <h6>{{ Str::ucfirst(auth()->user()->name) }}</h6>
                    </div>
                    <a href="{{ url('settings') }}" class="dropdown-item"><i class="typcn typcn-cog-outline"></i>
                        Settings</a>
                    <a href="{{ url('logout') }}" class="dropdown-item"><i class="typcn typcn-power-outline"></i>
                        Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>
