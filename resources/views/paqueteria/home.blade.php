<nav class="menu-home">
    <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
    <label class="menu-open-button" for="menu-open">
        <span class="lines line-1"></span>
        <span class="lines line-2"></span>
        <span class="lines line-3"></span>
    </label>

    <a href="{{route('envios.lista')}}" class="menu-item-home blue">   
        <i class="fas fa-paper-plane"></i>
        <span>Envios </span>
    </a>
    
    <a href="{{route('remitentes.index')}}" class="menu-item-home green">  
        <i class="fas fa-user-alt"></i>
        <span>Remitentes</span>
    </a>
    
    <a href="{{route('destinatarios.index')}}" class="menu-item-home red">    
        <i class="fas fa-user-alt"></i>
        <span>Destinatarios</span>
    </a>
    
    <a href="{{route('recoleccion.index')}}" class="menu-item-home purple"> 
        <i class="fas fa-archive"></i> 
        <span>Recolecciones</span>
    </a>
    
    <a href="{{route('suministros.index')}}" class="menu-item-home orange"> 
        <i class="fas fa-box-open"></i>
        <span>Suministros</span>
    </a>
    
    <a href="" class="menu-item-home lightblue"> 
        <i class="fa fa-diamond"></i> 
        <span>Seguimiento</span>
    </a>
</nav>

<style>
  

    .menu-item-home, .menu-open-button{
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: #EEEEEE;
        border-radius: 100%;
        width: 195px;
        height: 195px;
        /* margin-left: -50px; */
        position: absolute;
        color: #FFFFFF;
        text-align: center;
        line-height: 80px;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
        -webkit-transition: -webkit-transform ease-out 200ms;
        transition: -webkit-transform ease-out 200ms;
        transition: transform ease-out 200ms;
        transition: transform ease-out 200ms, -webkit-transform ease-out 200ms;
        
    }


    .menu-open {
        display: none;
    }

    .lines {
        width: 25px;
        height: 3px;
        background: #596778;
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -12.5px;
        margin-top: -1.5px;
        -webkit-transition: -webkit-transform 200ms;
        transition: -webkit-transform 200ms;
        transition: transform 200ms;
        transition: transform 200ms, -webkit-transform 200ms;
    }

    .line-1 {
        -webkit-transform: translate3d(0, -8px, 0);
        transform: translate3d(0, -8px, 0);
    }

    .line-2 {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .line-3 {
        -webkit-transform: translate3d(0, 8px, 0);
        transform: translate3d(0, 8px, 0);
    }

    .menu-open:checked+.menu-open-button .line-1 {
        -webkit-transform: translate3d(0, 0, 0) rotate(45deg);
        transform: translate3d(0, 0, 0) rotate(45deg);
    }

    .menu-open:checked+.menu-open-button .line-2 {
        -webkit-transform: translate3d(0, 0, 0) scale(0.1, 1);
        transform: translate3d(0, 0, 0) scale(0.1, 1);
    }

    .menu-open:checked+.menu-open-button .line-3 {
        -webkit-transform: translate3d(0, 0, 0) rotate(-45deg);
        transform: translate3d(0, 0, 0) rotate(-45deg);
    }

    .menu-home {
        background-color: blue;
        margin: auto;
        position: absolute;
        top: 40%;
        left: 40%;
        width: 0px;
        height: 0px;
        text-align: center;
        box-sizing: border-box;
        font-size: 26px;
    }


    /* .menu-item-home {
   transition: all 0.1s ease 0s;
} */

    .menu-item-home:hover {
        background: #EEEEEE;
        color: #3290B1;
    }

    .menu-item-home:nth-child(3) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
        
    }

    .menu-item-home:nth-child(4) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-item-home:nth-child(5) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-item-home:nth-child(6) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-item-home:nth-child(7) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-item-home:nth-child(8) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-item-home:nth-child(9) {
        -webkit-transition-duration: 180ms;
        transition-duration: 180ms;
    }

    .menu-open-button {
        z-index: 2;
        -webkit-transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
        -webkit-transition-duration: 400ms;
        transition-duration: 400ms;
        -webkit-transform: scale(1.1, 1.1) translate3d(0, 0, 0);
        transform: scale(1.1, 1.1) translate3d(0, 0, 0);
        cursor: pointer;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        
    }

    .menu-open-button:hover {
        -webkit-transform: scale(1.2, 1.2) translate3d(0, 0, 0);
        transform: scale(1.2, 1.2) translate3d(0, 0, 0);
    }

    .menu-open:checked+.menu-open-button {
        -webkit-transition-timing-function: linear;
        transition-timing-function: linear;
        -webkit-transition-duration: 200ms;
        transition-duration: 200ms;
        -webkit-transform: scale(0.5, 0.5) translate3d(0, 0, 0);
        transform: scale(0.5, 0.5) translate3d(0, 0, 0);
    }

    .menu-open:checked~.menu-item-home {
        -webkit-transition-timing-function: cubic-bezier(0.935, 0, 0.34, 1.33);
        transition-timing-function: cubic-bezier(0.935, 0, 0.34, 1.33);
    }

    .menu-open:checked~.menu-item-home:nth-child(3) {
        transition-duration: 180ms;
        -webkit-transition-duration: 180ms;
        /* -webkit-transform: translate3d(0.08361px, -104.99997px, 0); */
        transform: translate3d(0.08361px, -190px, 0);
        
    }

    .menu-open:checked~.menu-item-home:nth-child(4) {
        transition-duration: 280ms;
        -webkit-transition-duration: 280ms;
        /* -webkit-transform: translate3d(90.9466px, -52.47586px, 0); */
        transform: translate3d(175.9466px, -90.47586px, 0);
    }

    .menu-open:checked~.menu-item-home:nth-child(5) {
        transition-duration: 380ms;
        -webkit-transition-duration: 380ms;
        /* -webkit-transform: translate3d(90.9466px, 52.47586px, 0); */
        transform: translate3d(175.9466px,120.47586px, 0);
    }

    .menu-open:checked~.menu-item-home:nth-child(6) {
        transition-duration: 480ms;
        -webkit-transition-duration: 480ms;
        /* -webkit-transform: translate3d(0.08361px, 104.99997px, 0); */
        transform: translate3d(-0px, 220.99997px, 0);
    }

    .menu-open:checked~.menu-item-home:nth-child(7) {
        transition-duration: 580ms;
        -webkit-transition-duration: 580ms;
        /* -webkit-transform: translate3d(-90.86291px, 52.62064px, 0); */
        transform: translate3d(-175.86291px, 115.62064px, 0);
    }

    .menu-open:checked~.menu-item-home:nth-child(8) {
        transition-duration: 680ms;
        -webkit-transition-duration: 680ms;
        /* -webkit-transform: translate3d(-91.03006px, -52.33095px, 0); */
        /* transform: translate3d(-91.03006px, -52.33095px, 0); */
        transform: translate3d(-175.03006px, -85.99997px, 0);
    }

    .menu-open:checked~.menu-item-home:nth-child(9) {
        transition-duration: 780ms;
        -webkit-transition-duration: 780ms;
        /* -webkit-transform: translate3d(-0.25084px, -104.9997px, 0); */
        transform: translate3d(-0.25084px, -104.9997px, 0);
    }

    .blue {
        
        background-color: #669AE1;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .blue:hover {
        color: #669AE1;
        text-shadow: none;
    }

    .green {
        background-color: #70CC72;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .green:hover {
        color: #70CC72;
        text-shadow: none;
    }

    .red {
        background-color: #FE4365;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .red:hover {
        color: #FE4365;
        text-shadow: none;
    }

    .purple {
        background-color: #C49CDE;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .purple:hover {
        color: #C49CDE;
        text-shadow: none;
    }

    .orange {
        background-color: #FC913A;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .orange:hover {
        color: #FC913A;
        text-shadow: none;
    }

    .lightblue {
        background-color: #62C2E4;
        box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
    }

    .lightblue:hover {
        color: #62C2E4;
        text-shadow: none;
    }

    .credit {
        margin: 24px 20px 120px 0;
        text-align: right;
        color: #EEEEEE;
    }

    .credit a {
        padding: 8px 0;
        color: #C49CDE;
        text-decoration: none;
        transition: all 0.3s ease 0s;
    }

    .credit a:hover {
        text-decoration: underline;
    }

</style>
