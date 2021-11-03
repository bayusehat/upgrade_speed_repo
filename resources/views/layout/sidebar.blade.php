<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
  
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">INBOX WO</div>
        </a>
  
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
  
        <!-- Nav Item - Dashboard -->
        {{-- <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
        </li> --}}
  
        <!-- Divider -->
        <hr class="sidebar-divider">
  
        <!-- Heading -->
        <div class="sidebar-heading">
          Menu
        </div>
        
        {{-- @if (session('profil') == 2 || session('profil') == 4)
        <!-- Nav Item - Charts -->
        <li class="nav-item">
          <a class="nav-link" href="{{ url('ctb') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>CTB Menu</span></a>
        </li>
        @endif --}}
        @if (session('profil') == 'OBC' || session('profil') == "ADMIN")
        <!-- Nav Item - Tables -->
        <li class="nav-item">
          <a class="nav-link" href="{{ url('obc') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>OBC</span></a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ url('prepaid') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Indihome Prepaid</span></a>
        </li> --}}
        @endif
        @if (session('profil') == "OPLANG" || session('profil') == "ADMIN")
        <li class="nav-item">
          <a class="nav-link" href="{{ url('oplang') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>OPLANG</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('oplang/mola') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>MOLA</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('report_witel') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>REPORT WITEL</span></a>
        </li>
        @endif
        {{-- @if (session('profil') == 4)

        <li class="nav-item">
          <a class="nav-link" href="{{ url('wo') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Share WO OBC</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('master/caring') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Hasil Caring</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('voc') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Master VOC</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('user') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Master User</span></a>
        </li>
        @endif --}}

        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ url('report/agent') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Report CTB</span></a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('report/obc') }}">
            <i class="fas fa-fw fa-file"></i>
            <span>Report OBC</span></a>
        </li> --}}
  
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
  
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
  
      </ul>
      <!-- End of Sidebar -->
  
      <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
              <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
              </button>
            </form>
  
            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
  
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
  
              <!-- Nav Item - Search Dropdown (Visible Only XS) -->
              <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                  <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                          <i class="fas fa-search fa-sm"></i>
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </li>
  
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bell fa-fw"></i>
                  <!-- Counter - Alerts -->
                  <span class="badge badge-danger badge-counter">3+</span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">
                    Alerts Center
                  </h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 12, 2019</div>
                      <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-success">
                        <i class="fas fa-donate text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 7, 2019</div>
                      $290.29 has been deposited into your account!
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-warning">
                        <i class="fas fa-exclamation-triangle text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">December 2, 2019</div>
                      Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                  </a>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
              </li>
  
              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-envelope fa-fw"></i>
                  <!-- Counter - Messages -->
                  <span class="badge badge-danger badge-counter" id="jumlah_notif">0</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  <h6 class="dropdown-header">
                    Message Center
                  </h6>
                  <div id="notif">

                  </div>
                  {{-- <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                      <div class="status-indicator"></div>
                    </div>
                    <div>
                      <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                      <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                      <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                      <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                  </a>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                      <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                      <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                      <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                      <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                  </a> --}}
                  <a class="dropdown-item text-center small text-gray-500" href="{{ url("oplang") }}">Read More Messages</a>
                </div>
              </li>
  
              <div class="topbar-divider d-none d-sm-block"></div>
  
              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('nama') }}</span>
                  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                  </a>
                  <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>
  
            </ul>
  
          </nav>
          <!-- End of Topbar -->
          <!-- Begin Page Content -->
        <div class="container-fluid">
      <script>
        $(document).ready(function(){
          loadNotif();
          setInterval(function(){
            loadNotif()
            console.log('Loaded ...')
          },5000000)
        })
          function loadNotif(){  
            $.ajax({
              url : "{{ url('notif') }}",
              method : 'GET',
              dataType : 'JSON',
              success:function(res){
                var html = '';
                $("#jumlah_notif").html(res.jumlah_notif);
                $.each(res.notification,function(i,val){
                 html += '<a class="dropdown-item d-flex align-items-center" href="#">'+
                            '<div class="dropdown-list-image mr-3">'+
                                '<img class="rounded-circle" src="https://i.pinimg.com/originals/0c/3b/3a/0c3b3adb1a7530892e55ef36d3be6cb8.png" alt="">'+
                                '<div class="status-indicator bg-success"></div>'+
                                '</div>'+
                              '<div class="font-weight-bold">'+
                                '<div class="text-truncate">WO ID :  '+val.id_upspeed+' - '+val.nomor_inet+'</div>'+
                                '<div class="small text-gray-500">'+val.nama_pelanggan+' ·</div>'+
                            '</div>'+
                          '</a>';
                  });
                  $("#notif").html(html);
                  notifyClose();
                  notif(res.jumlah_notif+" WO belum dikerjakan");
              }
            })
          }
      </script>