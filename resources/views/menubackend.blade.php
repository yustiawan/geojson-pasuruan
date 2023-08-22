<ul id="sidebarnav">
    <li class="nav-small-cap">
        <i class="mdi mdi-dots-horizontal"></i>
        <span class="hide-menu">Data Master</span>
    </li>
    <li class="sidebar-item">

        <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
            <i class="mdi mdi-border-inside"></i>
            <span class="hide-menu">Master Data</span>
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
            <li class="sidebar-item">
                <a href="{{ url('admin/opd') }}" class="sidebar-link">
                    <i class="mdi mdi-blur-linear"></i>
                    <span class="hide-menu"> Organisasi Perangkat Daerah</span>
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
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/settingmap') }}" aria-expanded="false">
            <i class="mdi mdi-tab-unselected"></i>
            <span class="hide-menu">Program</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/datakemiskinan') }}" aria-expanded="false">
            <i class="mdi mdi-tab-unselected"></i>
            <span class="hide-menu">Data Kemiskinan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/settingmap') }}" aria-expanded="false">
            <i class="mdi mdi-tab-unselected"></i>
            <span class="hide-menu">Report</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('admin/settingmap') }}" aria-expanded="false">
            <i class="mdi mdi-tab-unselected"></i>
            <span class="hide-menu">Manajemen User</span>
        </a>
    </li>


</ul>
