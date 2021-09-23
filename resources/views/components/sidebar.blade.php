<div class="sidebar-header">
    <div class="sidebar-title">
        Navigation
    </div>
    <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<div class="nano">
    <div class="nano-content">
        <nav id="menu" class="nav-main" role="navigation">
            <ul class="nav nav-main">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-parent">
                    <a>
                        <i class="fa fa-car" aria-hidden="true"></i>
                        <span>Vehicle</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a href="{{ route('vehicleCat.index') }}">Jenis</a>
                        </li>
                        <li>
                            <a href="{{ route('vehicle.index') }}">Vehicle</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-parent">
                    <a>
                        <i class="fa fa-history" aria-hidden="true"></i>
                        <span>Tracking</span>
                    </a>
                    <ul class="nav nav-children">
                        <li>
                            <a href="{{ route('track.index') }}">Roda</a>
                        </li>
                        <li>
                            <a href="{{ route('kontainer') }}">Kontainer</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>


    </div>

</div>
