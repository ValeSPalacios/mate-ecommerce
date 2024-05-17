<div class="d-flex justify-content-center">
    <div class='container d-lg-flex justify-content-center'>
        <div class='row'>
                @guest
                    <div class='col-lg-5 d-flex justify-content-center' id='headerImg'>
                @else
                <div class='col-lg-12 d-flex justify-content-center' id='headerImg'>
                @endguest
              
                <div class="m-auto">
                    <img src="{{asset('img/logos/logo-5.png')}}" 
                    class="img-fluid"/>
                </div>
                    
              </div>
    
              <div class='col-lg-7 col-md-12 d-flex align-items-center 
                    opcionesRegistro'>
                   <div class="container ms-lg-5">
                      <div class="row ms-5 fw-bold">
                        @guest
                            @if(Route::has('register'))
                            <div class="col-7 col-sm-8">
                            
                                <a href="{{route('register')}}" class="bi bi-people-fill">
                                      Registrarse
                                </a>
                                </div>
                            @endif

                            @if(Route::has('login'))
                            <div class="col-5 col-sm-4">
                                <a href="{{route('login')}}"  class="bi bi-bookmark-check">
                                    Login
                                </a>
                                </div>
                            @endif
                                
                            
                        @endguest
                          
                      
    
                          
                      </div>
                   </div>
               </div>
        </div>
    </div> 
</div>

 
