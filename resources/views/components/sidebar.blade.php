<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
      <!--begin::Brand Link-->
      <a href="./index.html" class="brand-link">
        <!--begin::Brand Image-->
        <img
          src="../../dist/assets/img/AdminLTELogo.png"
          alt="AdminLTE Logo"
          class="brand-image opacity-75 shadow"
        />
        <!--end::Brand Image-->
        <!--begin::Brand Text-->
        <span class="brand-text fw-light">{{Auth::user()->name}}</span>
        <span class="brand-text fw-light">|</span>
        <form action="{{ route('logout') }}" method="post">
          @csrf
                  <button type="submit">log out </button>


        </form>
        <!--end::Brand Text-->
      </a>
      <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <!--begin::Sidebar Menu-->
        <ul
          class="nav sidebar-menu nav-pills flex-column "
          data-lte-toggle="treeview"
          role="menu"
          data-accordion="false"
        >
         @foreach ($items as $item )
             
          <li class="nav-item">
            <a href="{{ route($item['route']) }}" class="nav-link {{ $item['route']==$active ? 'active' : '' }}">
              <i class="{{ $item['icon'] }}"></i>
              <p>{{$item['title']}}
                <span class="right badge badge-danger">New</span>
              </p>

            </a>
          </li>
            @endforeach

        </ul>
        <!--end::Sidebar Menu-->
      </nav>
    </div>
    <!--end::Sidebar Wrapper-->
  </aside>