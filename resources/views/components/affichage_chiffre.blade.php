<div class="nombre-expeditions">
    <span style="font-size: 25px; ">Nombre d'expéditions</span>
    <div class="nombre" id="nombre-expedition"></div>
</div>

<div class="chiffre-affaire">
    <span style="font-size: 25px; ">Chiffre d'affaire</span>
    <div class="nombre" id="chiffre-affaire"></div>
</div>

<style>
    .affichage-chiffree {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-evenly;
        align-items: center;
        width: 100%;
        height: max-content;
    }

    .nombre-expeditions,
    .chiffre-affaire {
        border-radius: 5px;
        background-color: #3f4458;
        display: flex;
        flex-direction: column;
        height: 100px;
        color: white;
        font-family: 'Roboto', sans-serif;
        flex: 1;
        min-width: 300px;
        margin: 5px;
        transition: 0.5s;
    }

    .nombre-expeditions {
        justify-content: center;
        align-items: flex-start;
        padding-left: 10px;
    }

    .chiffre-affaire {
        justify-content: center;
        align-items: flex-end;
        padding-right: 10px;
    }

    #nombre-expedition {
        color: greenyellow;
        border-bottom: 2px solid yellowgreen;
    }

    #chiffre-affaire {
        color: orange;
        border-bottom: 2px solid orange;
    }

    .nombre {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        height: 50%;
        width: max-content;
        font-size: 3em;
        transition: 500ms;
    }

    @media only screen and (max-width : 650px) {
        .nombre {
            font-size: 2em;
            transition: 500ms;
        }

        .nombre-expeditions,
        .chiffre-affaire {
            flex-direction: row;
            justify-content: space-evenly;
            justify-items: center;
            height: max-content;
            padding-bottom: 10px;
            padding-top: 10px;
            transition: 0.5s;
        }
    }
</style>
