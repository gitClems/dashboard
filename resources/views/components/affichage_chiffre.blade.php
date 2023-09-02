<div class="affichage-chiffree">
    <div class="expeditions">
        <div
            style="display: flex; justify-content:space-between; margin-top:10px; width : 100%; align-items: space-between">
            <span class="expeditions-label">Nombre d'expéditions</span>
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16"
                    color="grey">
                    <path fill-rule="evenodd"
                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z" />
                </svg>
            </div>
        </div>
        <div class="container">

            <div id="total-expeditions" class="container-item hover-text">
                <span class="labelle">Total</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="moyenne-expeditions" class="container-item hover-text">
                <span class="labelle">Avg(par/jour)</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="max-expeditions" class="container-item hover-text">
                <span class="labelle">Max</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="min-expeditions" class="container-item hover-text">
                <span class="labelle">Min</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
        </div>
    </div>
    <div class="chiffre-affaire">
        <div
            style="display: flex; justify-content:space-between;
             margin-top:10px; width : 100%; align-items: space-between; ">
            <span class="chiffre-affaire-label">Chiffre d'affaire</span>
            <div class="icon-container">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16"
                    color="grey">
                    <path fill-rule="evenodd"
                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                    <path
                        d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z" />
                    <path
                        d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z" />
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z" />
                </svg>
            </div>
        </div>
        <div class="container">
            <div id="total-chiffre-affaire" class="container-item hover-text">
                <span class="labelle">Total</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="moyenne-chiffre-affaire" class="container-item hover-text">
                <span class="labelle">Avg(par/jour)</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="max-chiffre-affaire" class="container-item hover-text">
                <span class="labelle">Max</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
            <div id="min-chiffre-affaire" class="container-item hover-text">
                <span class="labelle">Min</span>
                <span class="tooltip-text"></span>
                <span class="value"></span>
            </div>
        </div>
    </div>
</div>

<style>
    .affichage-chiffree {
        margin: 5px;
        background: transparent;
        display: flex;
        flex-wrap: wrap;
        height: 100%;
    }

    @media only screen and (max-width : 800px) {
        .affichage-chiffree {
            flex-direction: column;
        }

        .value {
            font-size: 1em;
            transition: 500ms;
        }
    }

    .bi-cash-coin,
    .bi-box-seam-fill {
        height: 1.4em;
        width: 1.4em;
        margin: 7px;
        transition: 500ms;
    }

    .icon-container {
        width: max-content;
        height: max-content;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        border-radius: 50%;
        box-shadow: 1px 1px 10px rgba(128, 128, 128, 1);
    }

    .expeditions-label,
    .chiffre-affaire-label {
        font-size: 1em;
        color: rgba(128, 128, 128, 0.7);
    }

    #total-chiffre-affaire .value,
    #total-expeditions .value {
        color: orange;
        width: 100%
    }

    #total-chiffre-affaire,
    #total-expeditions {
        border-bottom: 2px solid orange;
    }

    #moyenne-chiffre-affaire .value,
    #moyenne-expeditions .value {
        color: blue;
        width: 100%
    }

    #moyenne-chiffre-affaire,
    #moyenne-expeditions {
        border-bottom: 2px solid blue;
    }

    #min-chiffre-affaire .value,
    #min-expeditions .value {
        color: red;
        width: 100%
    }

    #min-chiffre-affaire,
    #min-expeditions {
        border-bottom: 2px solid red;
    }

    #max-chiffre-affaire .value,
    #max-expeditions .value {
        color: yellowgreen;
        width: 100%
    }

    #max-chiffre-affaire,
    #max-expeditions {
        border-bottom: 2px solid yellowgreen;
    }


    .container {
        display: grid;
        flex-wrap: wrap;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    }


    @media only screen and (max-width : 400px) {
        .container {
            display: grid;
            flex-wrap: wrap;
            grid-template-columns: repeat(auto-fit, minmax(60px, 1fr));
        }
    }

    .container-item {
        color: #495057;
        /* width: 100%; */
        border-radius: 5px;
        flex: 1;
        margin: 5px;
        padding: 0px 3px 0px 3px;
        display: flex;
        flex-direction: column;
        transition: 0.2s;
        align-items: center;
        cursor: pointer;
    }


    .expeditions,
    .chiffre-affaire {
        box-shadow: 1px 1px 10px rgba(128, 128, 128, 0.3);
        border-radius: 5px;
        background-color: rgb(255, 255, 255);
        /* background: linear-gradient(90deg,gold, white, gold); */
        cursor: default;
        display: flex;
        flex-direction: column;
        padding: 0px 5px 0px 5px;
        color: black;
        font-family: 'Roboto', sans-serif;
        flex: 1;
        margin: 5px;
        transition: 0.5s;
        min-width: 300px;
    }

    .expeditions {
        align-items: flex-start;
    }

    .chiffre-affaire {
        align-items: flex-end;
    }

    .value {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: max-content;
        font-size: 1em;
        transition: 500ms;
    }

    .labelle {
        font-size: 1em;
        transition: 500ms;
        color: rgba(128, 128, 128, 0.5);
    }

    .tooltip-text {
        visibility: hidden;
        position: absolute;
        top: -10px;
        left: -10px;
        z-index: 1;
        color: white;
        font-weight: bold;
        font-size: 11px;
        background-color: rgba(128, 128, 128, 0.5);
        border-radius: 3px;
        padding: 5px;
    }

    .hover-text:hover .tooltip-text {
        visibility: visible;
    }


    .hover-text {
        position: relative;
        display: inline-block;
        font-family: Arial;
        text-align: end;
    }

    @media only screen and (max-width : 650px) {
        .labelle {
            font-size: 0.7em;
            transition: 500ms;
        }

        .value {
            font-size: 0.7em;
            transition: 500ms;
        }

        .expeditions-label,
        .chiffre-affaire-label {
            font-size: 1em;
            transition: 500ms;
        }

        .bi-cash-coin,
        .bi-box-seam-fill {
            height: 1.2em;
            width: 1.2em;
            margin: 6px;
            transition: 500ms;
        }
    }
</style>
