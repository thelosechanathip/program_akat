<nav id="sidebar" class="" style="height: 100vh;">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="p-4 pt-5">
        <h1><a href="index.html" class="logo">Request</a></h1>
        <ul class="list-unstyled components mb-5">
            <li>
                <a href="http://www.akathospital.com">Website โรงพยาบาล</a>
            </li>
            <li>
                <a href="{{ route('/') }}">หน้าแรก</a>
            </li>
            <li>
                <a href="{{ route('request_user') }}">คำร้องขอ User เข้าใช้งานระบบ HoSXP</a>
            </li>
        </ul>
    </div>
</nav>
