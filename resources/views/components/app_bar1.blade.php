<head>
    <x-packages></x-packages>
    <link rel="stylesheet" href="css/dashboard.css">
    <style>
        #header {
            background-color: white;
            box-shadow: 1px 1px 1px rgba(128, 128, 128, 0.347);
        }

        #reportrange {
            width: 300px;
            border: 1px solid grey;
            display: flex;
            justify-content: center;
            align-content: center
        }
    </style>
</head>

<link rel="stylesheet" href="css/dashboard.css">
<script src="js/dashboard.js"></script>

<header class="header" id="header">
    <div class="header_toggle">
        <i class='bx bx-menu' id="header-toggle"></i>
    </div>

    <div id="reportrange">
        <span style="width : 90% ; display: flex; justify-content: center;"></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-calendar3" viewBox="0 0 16 16">
            <path
                d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
            <path
                d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1
                 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
        </svg>
    </div>

    <a href="{{ route('dashboard') }}" class="nav_logo">
        <div class="dashboard-logo"></div>
    </a>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <div class="nav_list">
                <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span
                        class="nav_name">Dashboard</span> </a>
                <a href="#" class="nav_link"> <i class='bx bx-user nav_icon'></i> <span
                        class="nav_name">Users</span> </a> <a href="#" class="nav_link"> <i
                        class='bx bx-message-square-detail nav_icon'></i> <span class="nav_name">Messages</span>
                </a> <a href="#" class="nav_link"> <i class='bx bx-bookmark nav_icon'></i> <span
                        class="nav_name">Bookmark</span> </a> <a href="#" class="nav_link"> <i
                        class='bx bx-folder nav_icon'></i> <span class="nav_name">Files</span> </a> <a href="#"
                    class="nav_link"> <i class='bx bx-bar-chart-alt-2 nav_icon'></i> <span class="nav_name">Stats</span>
                </a>
            </div>
        </div> <a href="#" class="nav_link"> <i class='bx bx-log-out nav_icon'></i> <span
                class="nav_name">SignOut</span> </a>
    </nav>

</div>
