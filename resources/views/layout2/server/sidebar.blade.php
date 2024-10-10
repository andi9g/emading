<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">


        {{-- <li class="nav-item">
          <a class="nav-link collapsed" href="index.html">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li><!-- End Dashboard Nav -->



        <li class="nav-item">
          <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
              <a href="#">
                <i class="bi bi-circle"></i><span>Alerts</span>
              </a>
            </li>
          </ul>
        </li> --}}

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed @yield('activePengguna')" href="{{ url('pengguna', []) }}">
          <i class="bi bi-people"></i>
          <span>Data Pengguna</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed @yield('activePengaturan')" href="{{ url('pengaturan', []) }}">
          <i class="bi bi-globe"></i>
          <span>Pengaturan Website</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed @yield('activeKonten')" href="{{ url('konten', []) }}">
          <i class="bi bi-database"></i>
          <span>Data Konten</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
