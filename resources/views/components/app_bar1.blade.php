<nav class="navbar navbar-dark bg-dark fixed-top" style="height: max-height;">
    <div class="container-fluid" style=" height : 100%">
        <div class="navbar-brand">Express relai</div>
        <x-packages></x-packages>
        <div style=" height : 100%">
            <div style="width: 300px">
                <div id="reportrange">
                    <span style="width : 90% ; display: flex; justify-content: center;"></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-calendar3" viewBox="0 0 16 16" >
                        <path
                            d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                        <path
                            d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1
                         0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                    </svg>
                </div>
            </div>
            <div id="error-append-container" style="display: flex; justify-content : center; background-color : rgba(255, 255, 255, 0.2); border-radius : 3px; height : max-content ">
                <span id="error-append" ></span>
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Express relai</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard') }}">Expédition</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('accueil') }}">Accueil</a>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#chiffre">Chiffre d'affaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<style>
    #reportrange {
        background: #fff;
        cursor: pointer;
        padding: 5px 10px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 15px;
    }

    #error-append {
        font-size: 8px;
        color: red;
        font-weight: bold;
        font-size : 12px ;
    }
</style>