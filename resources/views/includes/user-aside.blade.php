<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('dashboard') ? '' : ' collapsed' }}" href="{{ route ('dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('file.index') ? '' : ' collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-book-mark-line"></i><span>Theses</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
        <a href="{{ route('all-research') }}">
          <i class="bi bi-circle"></i><span>ALL</span>
        </a>
      </li>
      <li>
        <a href="{{ route('user-ceat.index') }}">
          <i class="bi bi-circle"></i><span>CEAT</span>
        </a>
      </li>
      <li>
        <a href="{{ route('user-cs.index') }}">
          <i class="bi bi-circle"></i><span>CS</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->

  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('user-adviser.index') ? '' : ' collapsed' }}" href="{{route('user-adviser.index')}}">
      <i class="ri-account-box-fill"></i>
      <span>Advisers</span>
    </a>
  </li>

  <li class="nav-item">
  <a class="nav-link{{ request()->routeIs('user.favorites') ? '' : ' collapsed' }}" href="{{route('user.favorites')}}">
    <i class="bi bi-bookmark-check-fill"></i>
    <span>Bookmarks</span>
  </a>
</li>
  
</ul>

</aside><!-- End Sidebar-->
