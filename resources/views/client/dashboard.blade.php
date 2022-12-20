@extends('layouts.user_app')

@section('content')

   

     <div class="container">
     
      </div>
     

     
  


@endsection


@section('scripts')
<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$( document ).ready(function() {

});


$(document).on('click','#btnAdd',function(e)
{


 var name = $('#txtname').val();
 var txtemail = $('#txtemail').val();
 var txtpass = $('#txtpass').val();
 var txtpass2 = $('#txtpass2').val();
 var type = $('#type').val();



     var formData =  new FormData();

         formData.append('name', name);
         formData.append('email', txtemail);
         formData.append('password', txtpass);
         formData.append('password_confirmation', txtpass2);
         formData.append('type', type);
         formData.append('_token', CSRF_TOKEN);

         $.ajax({
         type:'POST',
         url: 'user_registration',
         dataType:"json",
         processData: false,
         contentType: false,
         data:formData,
         success:function(data)
         {

          if(data.error == false)
          {
             Swal.fire({
             title: 'Create Account!',
             text: data.message,
             icon: 'success',
             confirmButtonText: 'OK'
             })

             $("#exampleModal").modal('toggle');

          }
                 else {

                 var err_txt = "";
                 var get_text = "";
                 for(var x=0 ; x < data.errors.length ; x++){

                 get_text =  data.errors[x];

                 err_txt += get_text + "<br>";
                 }


                 Swal.fire({
                 title: 'Create Account!',
                 icon: "error",
                 html: err_txt,
                 });

                 }



         }
         });




});
</script>
@endsection