<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('dashboard') ? '' : ' collapsed' }}" href="{{ route ('dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('file.index') ? '' : ' collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-book-mark-line"></i><span>Theses</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    <li>
        <a href="{{ route('file.index') }}">
          <i class="bi bi-circle"></i><span>ALL</span>
        </a>
      </li>
      <li>
        <a href="{{ route('ceatfile.index') }}">
          <i class="bi bi-circle"></i><span>CEAT</span>
        </a>
      </li>
      <li>
        <a href="{{ route('csfiles.index') }}">
          <i class="bi bi-circle"></i><span>CS</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('adviser.index') ? '' : ' collapsed' }}" href="{{route('adviser.index')}}">
      <i class="ri-account-box-fill"></i>
      <span>Advisers</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('user-data.list') ? '' : ' collapsed' }}"  href="{{route('user-data.list')}}">
      <i class="bi bi-people"></i>
      <span>Users</span>
    </a>
  </li>
  <li class="nav-item">
  <a class="nav-link{{ request()->routeIs('user.adudit-trail') ? '' : ' collapsed' }}" href="{{ route('user.adudit-trail') }}">
    <i class="ri-footprint-line"></i>
    <span>Audit Trail</span>
  </a>
</li>
</ul>
</aside>
