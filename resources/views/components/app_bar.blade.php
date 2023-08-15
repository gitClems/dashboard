<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <div class="navbar-brand">Express relai</div>
        <div>
            <select name="" id="date-range-select">
                <option value="this-week">This week</option>
                <option value="last-week">Last week</option>
                <option value="this-month">This month</option>
                <option value="last-month">Last month</option>
                <option value="custom-range">Custom range</option>
            </select>
            <input type="date" name="" id="start-date" value="{{ $min }}" min="{{ $min }}"
                @disabled(true)> 
            <input type="date" name="" id="end-date" value="{{ $max }}" max="{{ $max }}"
                @disabled(true)>
            <button id="reset-date-range" @disabled(true)>Reset date</button>
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
                        <a class="nav-link active" aria-current="page" href="#client">Client</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#chiffre">Chiffre d'affaire</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>