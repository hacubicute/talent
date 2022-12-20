@extends('layouts.app')


@section('content')

<div class="container mt-5  d-flex justify-content-center" >


                    <div class="card mt-5" style="width:500px">
            
                    <div class="card-body" >
                    <h2 >Talent Engagement</h2>
                    
                    <div class="text-center">

                        <div class="mb-3 mt-5">
    
                        <input type="email" class="form-control" id="txtemail" placeholder="Email">
                        </div>

                        <div class="mb-3">
                        <input type="password" class="form-control" id="txtpass" placeholder="Password">
                        </div>
                         
                      <button class="btn btn-info mt-3" id="btnLogin">Login</button>

                    </div>


                    </div>
                    </div>
 
     
   
</div>




@endsection


@section('scripts')
<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var base_url = window.location.origin;

$( document ).ready(function() {
   
});


$(document).on('click','#btnLogin',function(e)
{

   

    var txtemail = $('#txtemail').val();
    var txtpass = $('#txtpass').val();

  

        var formData =  new FormData();


            formData.append('email', txtemail);
            formData.append('password', txtpass);
     
            formData.append('_token', CSRF_TOKEN);

            $.ajax({
            type:'POST',
            url: 'user_login',
            dataType:"json",
            processData: false,
            contentType: false,
            data:formData,
            success:function(data)
            {

            // console.log(data);
        
            if(data.error == true)
            {

                Swal.fire({
                icon: "error",
                title: "LOGIN",
                html: data.message,
                });

            }
            else {
             
                var new_url = base_url + "" + data.url;
                window.location.href = new_url;
            }
  

            }
            });




});
</script>
@endsection