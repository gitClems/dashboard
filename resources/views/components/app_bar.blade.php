<head>
    <x-packages></x-packages>
    <link rel="stylesheet" href="css/dashboard.css">


    <!--flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
    <link rel="stylesheet" href="css/date_range.css">

    <link rel="stylesheet" href="css/appbar.css">
    <script src="js/dashboard.js"></script>
    <script src="components/main.js" type="module"></script>
</head>

{{-- Le app bar --}}
<header class="header" id="header">
    <a href="{{ route('accueil') }}" class="nav_logo_container">
        <div class="dashboard-logo"></div>
    </a>
    <div style="display: flex; justify-content : center; align-items : center;">
        <!-- input du filtre  -->
        <div class="filter-container">
            <input type="text" id="dateRangeInput">
        </div>
    </div>
    <div class="error-append-container">
        <span class="data-available-status"></span>
    </div>
</header>


{{-- Le side bar --}}
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div class="nav_list">
                <div class="header_toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
                <a href="{{ route('accueil') }}" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span
                        class="nav_name">Dashboard</span> </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-user nav_icon'></i>
                    <span class="nav_name">Users</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-message-square-detail nav_icon'></i>
                    <span class="nav_name">Messages</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-bookmark nav_icon'></i>
                    <span class="nav_name">Bookmark</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-folder nav_icon'></i>
                    <span class="nav_name">Files</span>
                </a>
                <a href="#" class="nav_link">
                    <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                    <span class="nav_name">Stats</span>
                </a>
            </div>
        </div>
        <a href="#" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span>
        </a>
    </nav>
</div>
