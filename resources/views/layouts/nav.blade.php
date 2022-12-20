<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Talent Engagement</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
         </button>
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             <li class="nav-item">
             <a class="nav-link active" aria-current="page" href="{{ url('client/dashboard') }}">Dashboard</a>
             </li>

               <?php 
               if(Auth::user()->hasRole('Client'))
               {
              ?>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('client/manage_jobs') }}">Manage Jobs</a>
                </li>
               <?php
               }
               ?>
           
        
         </ul>
         <div class="d-flex">

         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
           
             <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Settings
             </a>
             <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <?php 
               if(Auth::user()->hasRole('Freelance'))
               {
              ?>
                <li><a class="dropdown-item" href="{{ url('freelance/profile') }}">Profile</a></li>
              <?php
                }
              ?>
             <li><a class="dropdown-item" href="{{ url('logout') }}">Logout</a></li>

             <li><hr class="dropdown-divider"></li>
             <li><a class="dropdown-item" href="#">Something else here</a></li>
             </ul>
             </li>
             <li class="nav-item">
   
             </li>
         </ul>
             
           <!-- <button class="btn btn-sm btn-outline-info"  data-bs-toggle="modal" data-bs-target="#exampleModal">Signup</button> -->
         </div>
       </div>
      </div>
     </nav>
