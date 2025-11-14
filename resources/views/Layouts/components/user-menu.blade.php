<!-- layouts/components/user-menu.blade.php -->
<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
    <!--begin::User Image-->
    <li class="user-header text-bg-primary">
        <img src="/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image" />
        <p>
            Alexander Pierce - Web Developer
            <small>Member since Nov. 2023</small>
        </p>
    </li>
    <!--end::User Image-->
    <!--begin::Menu Body-->
    <li class="user-body">
        <!--begin::Row-->
        <div class="row">
            <div class="col-4 text-center"><a href="#">Followers</a></div>
            <div class="col-4 text-center"><a href="#">Sales</a></div>
            <div class="col-4 text-center"><a href="#">Friends</a></div>
        </div>
        <!--end::Row-->
    </li>
    <!--end::Menu Body-->
    <!--begin::Menu Footer-->
    <li class="user-footer d-flex justify-content-between align-items-center px-3">
        <a href="#" class="btn btn-sm btn-outline-secondary">Profile</a>
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger">Sign out</button>
        </form>
    </li>
    <!--end::Menu Footer-->
</ul>
