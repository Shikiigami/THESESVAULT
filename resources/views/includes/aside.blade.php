<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
  @if (auth()->check() && auth()->user()->role != 'sub-admin')
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('dashboard') ? '' : ' collapsed' }}" href="{{ route ('dashboard') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  @endif

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-mark-line"></i><span>Main Campus Theses</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @if (auth()->check() && auth()->user()->role === 'admin')
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>ALL</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && (
        auth()->user()->role === 'admin' ||
        (auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CEAT')
         ))
        <li>
            <a href="{{ route('ceatfile.index') }}">
                <i class="{{ request()->routeIs('ceatfile.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CEAT</span>
            </a>
        </li>
     @endif

       @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CS')
        <li>
            <a href="{{ route('csfiles.index') }}">
                <i class="{{ request()->routeIs('csfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CS</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CBA')
        <li>
            <a href="{{ route('cbafiles.index') }}">
                <i class="{{ request()->routeIs('cbafiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CBA</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CNHS')
        <li>
            <a href="{{ route('cnhsfiles.index') }}">
                <i class="{{ request()->routeIs('cnhsfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CNHS</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CTE')
        <li>
            <a href="{{ route('ctefiles.index') }}">
                <i class="{{ request()->routeIs('ctefiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CTE</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CCJE')
        <li>
            <a href="{{ route('ccjefiles.index') }}">
                <i class="{{ request()->routeIs('ccjefiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CCJE</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CHTM')
        <li>
            <a href="{{ route('chtmfiles.index') }}">
                <i class="{{ request()->routeIs('chtmfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CHTM</span>
            </a>
        </li>
        @endif
        @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'CAH')
        <li>
            <a href="{{ route('cahfiles.index') }}">
                <i class="{{ request()->routeIs('cahfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>CAH</span>
            </a>
        </li>
        @endif
    </ul>
</li>



<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#grad-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-mark-line"></i><span>Graduate School/School of Law</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="grad-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @if (auth()->check() && auth()->user()->role === 'admin')
        <li>
            <a href="{{ route('diplomaInTech.index') }}">
                <i class="{{ request()->routeIs('diplomaInTech.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Diploma in Teaching </span>
            </a>
        </li>
        <li>
            <a href="{{ route('doctorEd.index') }}">
                <i class="{{ request()->routeIs('doctorEd.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Doctor of Education</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Arts in Education</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Arts in Teaching</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Arts in Literature </span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Arts in Management</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master in Business Administration</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Science in Technopreneurship</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master in Public Administration</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Science in Environmental Management</span>
            </a>
        </li>
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Master of Science in Nursing</span>
            </a>
        </li>
        
        
        @endif
    </ul>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#med-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-mark-line"></i><span>School of Medicine</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="med-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @if (auth()->check() && auth()->user()->role === 'admin')
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Doctor of Medicine</span>
            </a>
        </li>
        @endif
    </ul>
</li>

<!-- <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('file.index') ? '' : ' collapsed' }}" data-bs-target="#law-nav" data-bs-toggle="collapse" href="#">
        <i class="ri-book-mark-line"></i><span>School of Law</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="law-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      @if (auth()->check() && auth()->user()->role === 'admin')
        <li>
            <a href="{{ route('file.index') }}">
                <i class="{{ request()->routeIs('file.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Bachelor of Laws</span>
            </a>
        </li>
        @endif
    </ul>
</li> -->



<li class="nav-item">
  <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
    <i class="ri-book-mark-line"></i><span>CCRD Theses</span><i class="bi bi-chevron-down ms-auto"></i>
  </a>
  <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Araceli')
    <li>
      <a href="{{route('aracelifiles.index')}}">
        <i class="{{ request()->routeIs('aracelifiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Araceli Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Balabac')
    <li>
      <a href="{{route('balabacfiles.index')}}">
        <i class="{{ request()->routeIs('balabacfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Balabac Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Bataraza')
    <li>
      <a href="{{route('batarazafiles.index')}}">
        <i class="{{ request()->routeIs('batarazafiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Bataraza Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Brooke\'s Point')
    <li>
      <a href="{{route('brookespointfiles.index')}}">
        <i class="{{ request()->routeIs('brookespointfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Brooke's Point Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Coron')
    <li>
      <a href="{{route('coronfiles.index')}}">
        <i class="{{ request()->routeIs('coronfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Coron Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'PCAT Cuyo')
    <li>
      <a href="{{route('cuyofiles.index')}}">
        <i class="{{ request()->routeIs('cuyofiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>PCAT Cuyo Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Dumaran')
    <li>
      <a href="{{route('dumaranfiles.index')}}">
        <i class="{{ request()->routeIs('dumaranfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Dumaran Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'El Nido')
    <li>
      <a href="{{route('elnidofiles.index')}}">
        <i class="{{ request()->routeIs('elnidofiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>El Nido Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Linapacan')
    <li>
      <a href="{{route('linapacanfiles.index')}}">
        <i class="{{ request()->routeIs('linapacanfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Linapacan Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Narra')
    <li>
      <a href="{{route('narrafiles.index')}}">
        <i class="{{ request()->routeIs('narrafiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Narra Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Quezon')
    <li>
      <a href="{{route('quezonfiles.index')}}">
        <i class="{{ request()->routeIs('quezonfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Quezon Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Rizal')
    <li>
      <a href="{{route('rizalfiles.index')}}">
        <i class="{{ request()->routeIs('rizalfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Rizal Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Roxas')
    <li>
      <a href="{{route('roxasfiles.index')}}">
        <i class="{{ request()->routeIs('roxasfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Roxas Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'San Rafael')
    <li>
      <a href="{{route('sanrafaelfiles.index')}}">
        <i class="{{ request()->routeIs('sanrafaelfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>San Rafael Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'San Rafael')
    <li>
      <a href="{{route('sanvicentefiles.index')}}">
        <i class="{{ request()->routeIs('sanvicentefiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>San Vicente Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Sofronio Española')
    <li>
      <a href="{{route('sofroniofiles.index')}}">
        <i class="{{ request()->routeIs('sofroniofiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Sofronio Española Campus</span>
      </a>
    </li>
    @endif
    @if (auth()->check() && auth()->user()->role === 'admin' || auth()->user()->role === 'sub-admin' && auth()->user()->college->college_name === 'Taytay')
    <li>
      <a href="{{route('taytayfiles.index')}}">
        <i class="{{ request()->routeIs('taytayfiles.index') ? 'bi bi-circle-fill' : 'bi bi-circle' }}"></i><span>Taytay Campus</span>
      </a>
    </li>
    @endif
  </ul>
</li>
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('adviser.index') ? '' : ' collapsed' }}" href="{{route('adviser.index')}}">
      <i class="ri-account-box-fill"></i>
      <span>Advisers</span>
    </a>
  </li>
  @if (auth()->user()->role === 'admin') 
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('user-data.list') ? '' : ' collapsed' }}"  href="{{route('user-data.list')}}">
      <i class="bi bi-people"></i>
      <span>Users</span>
    </a>
  </li>
  @endif
  @if (auth()->user()->role === 'admin') 
  <li class="nav-item">
    <a class="nav-link{{ request()->routeIs('requests.list') ? '' : ' collapsed' }}"  href="{{route('requests.list')}}">
      <i class="ri-git-pull-request-line"></i>
      <span>Requests</span>
    </a>
  </li>
  @endif
  @if (auth()->user()->role === 'admin') 
  <li class="nav-item">
  <a class="nav-link{{ request()->routeIs('fullrequests.list') ? '' : ' collapsed' }}" href="{{ route('fullrequests.list') }}">
    <i class="ri-file-text-line"></i>
    <span>Full-Text Request</span>
  </a>
</li>
@endif
@if (auth()->user()->role === 'admin') 
<li class="nav-item">
<a class="nav-link{{ request()->routeIs('recent-login') ? '' : ' collapsed' }}" href="{{ route('recent-login') }}">
  <i class="ri-login-box-line"></i>
  <span>Logbook</span>
</a>
</li>
@endif
  @if (auth()->user()->role === 'admin') 
  <li class="nav-item">
  <a class="nav-link{{ request()->routeIs('user.adudit-trail') ? '' : ' collapsed' }}" href="{{ route('user.adudit-trail') }}">
    <i class="ri-footprint-line"></i>
    <span>Audit Trail</span>
  </a>
</li>
@endif
</ul>
</aside>

