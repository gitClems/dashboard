<div class="page-titre-icon">
    <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
            class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z" />
        </svg>
    </div>
    <span class="page-title">
        Les expéditions
    </span>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&family=Roboto&display=swap');

    .page-title {
        font-size: 2em;
        color: rgba(0, 0, 0, 0.70);
        padding-left: 10%;
        transition: 500ms;
        margin-right: 10px
    }

    .page-titre-icon {
        margin: 5px;
        background: white;
        box-shadow: 1px 1px 5px gray;
        border-radius: 5px 0px 50px 5px;
        display: flex;
        align-items: center;
        font-family: 'Libre Baskerville', serif;
        width: 55%;
        transition: 500ms;
    }


    .bi-speedometer {
        height: 100%;
        color: rgba(128, 128, 128, 0.5);
        box-shadow: 1px 1px 10px grey;
        border-radius: 50%;
    }

    .bi-graph-up-arrow {
        height: 100%;
        color: rgb(255, 201, 7);
        background-color: transparent;
        margin: 10px;
    }

    @media only screen and (max-width: 800px) {

        .page-title {
            font-size: 1.6em;
            transition: 500ms;
        }
    }

    @media only screen and (max-width: 600px) {
        .page-titre-icon {
            width: 90%;
            transition: 500ms;
        }
    }
</style>
