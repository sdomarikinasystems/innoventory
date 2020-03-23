<nav class="navbar navbar-expand-lg " style="z-index: 100; background-color: #2c3e50 !important;  border-bottom: 1px solid rgba(52, 73, 94,0.3);">
  <a style="margin-top: -5px;" class="navbar-brand" href="hrdashboard"><small>CDTRS HR</small></a>
  <button class="navbar-toggler" style="color: white;" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   <i class="fas fa-bars"></i>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a href="#"  data-toggle="dropdown" class="nav-link dropdown-toggle"><i class="fas fa-dharmachakra"></i> System</a>
        <div class="dropdown-menu">
          <a href="#" class="nav-link dropdown-item"><i class="fas fa-globe-asia"></i> About Online Portal</a>
           <a href="#" class="nav-link dropdown-item"><i class="fas fa-rocket"></i> Publish an Official CDTRS Version</a>
           <a href="maintenance_security" class="nav-link dropdown-item"><i class="fas fa-shield-alt"></i> Maintenance and Security Options</a>
        </div>
      </li>
    </ul>

   <form action="portal_logout" method="GET" class="form-inline my-2 my-lg-0">
        {{ csrf_field() }}
        <button class="btn btn-light my-2 my-sm-0" type="submit"><i class="fas fa-sign-out-alt"></i> Sign-out</button>
      </form>
  </div>
</nav>

<div class="sidebar">
    <div style=" background-color: none; background-image: none !important;">
      <a  class="sidebar_link" id="page_dashboard" href="hrdashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <hr class="separator">
      <small class="sidebar_title">Reports</small>
      <a  class="sidebar_link" id="page_leavereports" href="admin_leavereports"><i class="fas fa-address-book"></i> Leave Reports</a>
      <hr class="separator">
      <small class="sidebar_title">Leave Credits</small>
      <a  class="sidebar_link" id="page_lc_teaching" href="admin_lc_teaching"><i class="fas fa-chalkboard-teacher"></i> Teaching</a>
      <a  class="sidebar_link" id="page_lc_nonteaching" href="admin_lc_nonteaching"><i class="fas fa-user-tie"></i> Non Teaching</a>
      <hr class="separator">
      <small class="sidebar_title">Forms</small>
      <a  class="sidebar_link" id="page_dash" href="#"><i class="fas fa-arrow-circle-right"></i> Generate Form 7</a>
    </div>
    </div>
  </div>

  <script type="text/javascript">
    function highlight_pagelink(linkid){
    $(linkid).css("color","white");
    $(linkid).css("background-color","#2c3e50");
    }
  </script>