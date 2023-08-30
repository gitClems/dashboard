<button onclick="topFunction()" id="myBtn" title="Go to top">
    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" color='#d80d1f'
        class="bi bi-arrow-up-square" viewBox="0 0 16 16">
        <path fill-rule="evenodd"
            d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
    </svg> --}}
    {{-- <span style="font-size: 15px">Up</span> --}}
</button>
<style>
    :root {
        --header-height: 3rem;
        --nav-width: 68px;
        --first-color: #101213;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;
        --body-font:
            'Nunito', sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100;
        --primary-color: #d80d1f;
    }

    #myBtn {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        border: 1px solid grey;
        outline: none;
        background-color: rgba(0, 0, 0, 0.24);
        cursor: pointer;
        border-radius: 10px;
        font-size: 18px;
        width: 30px;
        height: 50px;
    }

    #myBtn::before,
    #myBtn::after {
        content: "";
        position: absolute;
        top: 20%;
        left: 50%;
        height: 10px;
        width: 10px;
        transform: translate(-50%, -0%) rotate(45deg);
        border: 2px solid rgba(0, 0, 0);
        border-bottom: transparent;
        border-right: transparent;
        animation: scroll-down 1s ease-out infinite;
    }

    #myBtn::before {
        top: 30%;
        animation-delay: 0.3s;
    }

    @keyframes scroll-down {
        0% {
            opacity: 0;
        }

        30% {
            opacity: 1;
        }

        60% {
            opacity: 1;
        }

        100% {
            top: 90%;
            opacity: 0;
        }
    }
</style>
<script>
    let mybutton = document.getElementById("myBtn");

    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "flex";
            mybutton.style.transition = '0.2s'
        } else {
            mybutton.style.display = "none";
            mybutton.style.transition = '0.2s'
        }
    }

    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
