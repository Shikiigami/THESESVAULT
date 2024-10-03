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
        <i class="ri-book-mark-line"></i><span>Main Campus Theses</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="{{ route('all-research') }}">
                <i class="{{ request()->routeIs('all-research') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>ALL</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user-ceat.index') }}">
                <i class="{{ request()->routeIs('user-ceat.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CEAT</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user-cs.index') }}">
                <i class="{{ request()->routeIs('user-cs.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CS</span>
            </a>
        </li>
        <li>
          <a href="{{ route('user-cba.index') }}">
              <i class="{{ request()->routeIs('user-cba.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CBA</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user-cnhs.index') }}">
              <i class="{{ request()->routeIs('user-cnhs.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CNHS</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user-cte.index') }}">
              <i class="{{ request()->routeIs('user-cte.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CTE</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user-ccje.index') }}">
              <i class="{{ request()->routeIs('user-ccje.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CCJE</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user-chtm.index') }}">
              <i class="{{ request()->routeIs('user-chtm.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CHTM</span>
          </a>
        </li>
        <li>
          <a href="{{ route('user-cah.index') }}">
              <i class="{{ request()->routeIs('user-cah.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CAH</span>
          </a>
        </li>
      
    </ul>
</li>

    <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
      <i class="ri-book-mark-line"></i><span>CCRD Thesis</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{ route('araceli.index') }}">
          <i class="{{ request()->routeIs('araceli.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Araceli Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('balabac.index') }}">
          <i class="{{ request()->routeIs('balabac.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Balabac Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('bataraza.index') }}">
          <i class="{{ request()->routeIs('bataraza.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Bataraza Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('brookespoint.index') }}">
          <i class="{{ request()->routeIs('brookespoint.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Brooke's Point Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('coron.index') }}">
          <i class="{{ request()->routeIs('coron.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Coron Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('cuyo.index') }}">
          <i class="{{ request()->routeIs('cuyo.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>PCAT Cuyo Campus</span>
        </a>
      </li>
      </li>
      <li>
        <a href="{{ route('dumaran.index') }}">
          <i class="{{ request()->routeIs('dumaran.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Dumaran Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('elnido.index') }}">
          <i class="{{ request()->routeIs('elnido.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Elnido Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('linapacan.index') }}">
          <i class="{{ request()->routeIs('linapacan.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Linapacan Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('narra.index') }}">
          <i class="{{ request()->routeIs('narra.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Narra Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('quezon.index') }}">
          <i class="{{ request()->routeIs('quezon.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Quezon Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('rizal.index') }}">
          <i class="{{ request()->routeIs('rizal.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Rizal Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('roxas.index') }}">
          <i class="{{ request()->routeIs('roxas.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Roxas Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('sanrafael.index') }}">
          <i class="{{ request()->routeIs('sanarafel.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>San Rafael Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('sanvicente.index') }}">
          <i class="{{ request()->routeIs('sanvicente.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>San Vicente Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('sofronio.index') }}">
          <i class="{{ request()->routeIs('sofronio.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Sofronio Española Campus</span>
        </a>
      </li>
      <li>
        <a href="{{ route('taytay.index') }}">
          <i class="{{ request()->routeIs('taytay.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Taytay Campus</span>
        </a>
      </li>
    </ul>
  </li>


  <li class="nav-item">
  <a class="nav-link{{ request()->routeIs('user.favorites') ? '' : ' collapsed' }}" href="{{route('user.favorites')}}">
    <i class="bi bi-bookmark-check-fill"></i>
    <span>Bookmarks</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link{{ request()->routeIs('user.requests') ? '' : ' collapsed' }}" href="{{route('user.requests')}}">
    <i class="ri-git-pull-request-line"></i>
    <span>Requests</span>
  </a>
</li>
</ul>
</aside>
