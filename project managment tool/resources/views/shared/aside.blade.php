  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
              <a class="nav-link " href="{{ route('admin.home') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->





          <li class="nav-heading">Pages</li>

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.profile') }}">
                  <i class="bi bi-person"></i>
                  <span>Profile</span>
              </a>
          </li><!-- End Profile Page Nav -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('projects.index') }}">
                <i class="fa-solid fa-diagram-project"></i>
                <span>Pojects</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('tasks.index') }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Tasks</span>
            </a>
        </li>
          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.faq') }}">
                  <i class="bi bi-question-circle"></i>
                  <span>F.A.Q</span>
              </a>
          </li><!-- End F.A.Q Page Nav -->

          <li class="nav-item">
              <a class="nav-link collapsed" href="{{ route('admin.contact') }}">
                  <i class="bi bi-envelope"></i>
                  <span>Contact</span>
              </a>
          </li><!-- End Contact Page Nav -->




      </ul>

  </aside><!-- End Sidebar-->
