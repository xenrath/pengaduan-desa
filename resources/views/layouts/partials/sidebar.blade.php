<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="/" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('complaint-category.index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                        <span>Category Complaint</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('complaint.index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-comment-alt-dots"></i></div>
                        <span>Complaint</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('person.index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-cube"></i></div>
                        <span>People</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.index') }}" class="waves-effect">
                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-cube"></i></div>
                        <span>User</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
