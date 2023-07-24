<ul id="sidebarnav">
    <li class="nav-small-cap">
        <i class="mdi mdi-dots-horizontal"></i>
        <span class="hide-menu">Data Master</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-inside"></i>
            <span class="hide-menu">Administrasi</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">
                <a href="{{ url('admin/kecamatan') }}" class="sidebar-link">
                    <i class="mdi mdi-border-vertical"></i>
                    <span class="hide-menu">Data Kecamatan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ url('admin/desa') }}" class="sidebar-link">
                    <i class="mdi mdi-blur-linear"></i>
                    <span class="hide-menu"> Data Desa/Kelurahan</span>
                </a>
            </li>

        </ul>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/settingmap') }}" aria-expanded="false">
            <i class="mdi mdi-tab-unselected"></i>
            <span class="hide-menu">Setting Peta</span>
        </a>
    </li>

</ul>
