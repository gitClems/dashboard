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
        background-color: #3f4458;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-end;
        height: 100px;
        color: white;
        font-family: 'Roboto', sans-serif;
        flex: 1;
        min-width: 300px;
        padding-right: 50px;
        margin: 5px
    }

    /*
        .nombre-expeditions {
            border-radius: 5px 0px 0px 5px;
            margin-left: 5px;
        }

        .chiffre-affaire {
            border-radius: 0px 5px 5px 0px;
            margin-right: 5px;
        } */

    .nombre {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        height: 50%;
        width: 50%;
        font-size: 50px
    }
</style>
