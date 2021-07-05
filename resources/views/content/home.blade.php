@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')
<!-- Kick start -->
<!-- <div class="card">
  <div class="card-header">
    <h4 class="card-title">Kick start your next project 🚀</h4>
  </div>
  <div class="card-body">
    <div class="card-text">
      <p>
        Getting start with your project custom requirements using a ready template which is quite difficult and time
        taking process, Vuexy Admin provides useful features to kick start your project development with no efforts !
      </p>
      <ul>
        <li>
          Vuexy Admin provides you getting start pages with different layouts, use the layout as per your custom
          requirements and just change the branding, menu &amp; content.
        </li>
        <li>
          Every components in Vuexy Admin are decoupled, it means use use only components you actually need! Remove
          unnecessary and extra code easily just by excluding the path to specific SCSS, JS file.
        </li>
      </ul>
    </div>
  </div>
</div> -->
<!--/ Kick start -->

<!-- Page layout -->
<div class="card dashboard">
 
  <div class="card-body">
    <div class="card-text">
    <div id="mainMenu" class="mainMenuOverlay floating2 open">
  <div class="navire floating3"></div>
	<div class="itemMenuBox bills"><a href="/envios" target="_blank" class="itemMenu "><i class="fas fa-truck"></i><span>Envíos</span></a></div>
	<div class="itemMenuBox tarsheed"><a href="#" class="itemMenu "><i class="fas fa-search"></i></a></div>
	<div class="itemMenuBox employees"><a href="#" class="itemMenu "><i class="fas fa-envelope-open-text"></i></a></div>
	<div class="itemMenuBox location"><a href="{{ url('/suminitros')}}" class="itemMenu "><i class="fab fa-dropbox"></i></a></div>
	<div class="itemMenuBox eservices"><a href="{{url('#')}}" class="itemMenu "><i class="fas fa-clipboard-list"></i></a></div>
	<div class="itemMenuBox contact"><a href="#" class="itemMenu"><i class="fas fa-clipboard-check"></i></a></div>
 	
	<a href="#" class="toggleMenu floating"><img src="{{ asset('images/adeymex-menu.png')}}" height="96" width="101" alt="" class=""></a>
</div>
    </div>
  </div>
</div>
<!--/ Page layout -->
@endsection
