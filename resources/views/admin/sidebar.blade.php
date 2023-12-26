<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="/"><img src="{{ asset('home/img/logo.jpg') }}" alt="" /></a>
    <a class="sidebar-brand brand-logo-mini" href="/"><img src="{{ asset('admin/assets/images/icon_phone_mini.jpg') }}" alt="" /></a>
  </div>
  <ul class="nav">
    <!-- <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="admin/assets/images/faces/face15.jpg" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                  <span>Gold Member</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
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
          </li> -->
    <li class="nav-item nav-category">
      <span class="nav-link">Menu</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="/redirect">
        <span class="menu-icon">
          <i class="mdi mdi-chart-bar"></i>
        </span>
        <span class="menu-title">Trang chủ</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-tai-khoan')}}">
        <span class="menu-icon">
          <i class="mdi mdi-contacts"></i>
        </span>
        <span class="menu-title">Quản lý tài khoản</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-hang')}}">
        <span class="menu-icon">
          <i class="mdi mdi-laptop"></i>
        </span>
        <span class="menu-title">Quản lý hãng</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-banner')}}">
        <span class="menu-icon">
          <i class="mdi mdi-playlist-play"></i>
        </span>
        <span class="menu-title">Quản lý banner</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-san-pham')}}">
        <span class="menu-icon">
          <i class="mdi mdi-cellphone-iphone"></i>
        </span>
        <span class="menu-title">Quản lý sản phẩm</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-hinh-anh')}}">
        <span class="menu-icon">
          <i class="mdi mdi-file-image"></i>
        </span>
        <span class="menu-title">Quản lý hình ảnh</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-don-hang')}}">
        <span class="menu-icon">
          <i class="mdi mdi-table-large"></i>
        </span>
        <span class="menu-title">Quản lý đơn hàng</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-chi-nhanh')}}">
        <span class="menu-icon">
          <i class="mdi mdi-source-fork"></i>
        </span>
        <span class="menu-title">Quản lý chi nhánh</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-kho')}}">
        <span class="menu-icon">
          <i class="mdi mdi-equal-box"></i>
        </span>
        <span class="menu-title">Quản lý kho</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{url('quan-ly-dien-thoai-cu')}}">
        <span class="menu-icon">
          <i class="mdi mdi-recycle"></i>
        </span>
        <span class="menu-title">Quản lý điện thoại cũ</span>
      </a>
    </li>
    <!-- <li class="nav-item menu-items">
      <a class="nav-link" href="pages/icons/mdi.html">
        <span class="menu-icon">
          <i class="mdi mdi-contacts"></i>
        </span>
        <span class="menu-title">Icons</span>
      </a>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
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