  <!-- Main Sidebar Container -->
  <aside class="main-sidebar mi-side-color sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text text-success"><b>NASECO </b> Seeds</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route('chemicals.index') }}" class="nav-link">
                        <h5 class="text-success"><b>
                               Chemical Module
                            </b></h5>
                    </a>
                    <hr class="p-0 m-0">
                </li>
                <li class="nav-item">
                    <a href="{{ route('fuel-in.index') }}" class="nav-link">
                        <i class="fas fa-plus"></i>
                        <p>
                            Chemical In
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('fuel-out.index') }}" class="nav-link">
                        <i class="fas fa-minus"></i>
                        <p>
                            Chemical Out
                        </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="fuel_report.php" class="nav-link">
                        <i class="fas fa-chart-bar"></i>
                        <p>
                          Reports
                          <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('fuel-in.report') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fuel In Report</p>
                          </a>
                        </li>              
                        <li class="nav-item">
                          <a href="{{ route('fuel-out.report') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fuel Out Report</p>
                          </a>
                        </li> 
                        <li class="nav-item">
                          <a href="{{ route('fuel-out.report-sum') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fuel Summary Report</p>
                          </a>
                        </li> 
                        <li class="nav-item">
                          <a href="{{ route('lub-in.report') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>lubs in Report</p>
                          </a>
                        </li>     
                        <li class="nav-item">
                          <a href="{{ route('lub-out.report') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>lubs Out Report</p>
                          </a>
                        </li> 
                                               
                      </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
