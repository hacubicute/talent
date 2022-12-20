@extends('layouts.user_app')


@section('css')

<style>
  .profile-pic-wrapper {
  height: 100vh;
  width: 100%;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;

}
.pic-holder {
  text-align: center;
  position: relative;
  border-radius: 50%;
  width: 150px;
  height: 150px;
  overflow: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
  border:1px solid black;
}

.pic-holder .pic {
  height: 100%;
  width: 100%;
  -o-object-fit: cover;
  object-fit: cover;
  -o-object-position: center;
  object-position: center;
}

.pic-holder .upload-file-block,
.pic-holder .upload-loader {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: rgba(90, 92, 105, 0.7);
  color: #f8f9fc;
  font-size: 12px;
  font-weight: 600;
  opacity: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.pic-holder .upload-file-block {
  cursor: pointer;
}

.pic-holder:hover .upload-file-block,
.uploadProfileInput:focus ~ .upload-file-block {
  opacity: 1;
}

.pic-holder.uploadInProgress .upload-file-block {
  display: none;
}

.pic-holder.uploadInProgress .upload-loader {
  opacity: 1;
}

/* Snackbar css */
.snackbar {
  visibility: hidden;
  min-width: 250px;
  background-color: #333;
  color: #fff;
  text-align: center;
  border-radius: 2px;
  padding: 16px;
  position: fixed;
  z-index: 1;
  left: 50%;
  bottom: 30px;
  font-size: 14px;
  transform: translateX(-50%);
}

.snackbar.show {
  visibility: visible;
  -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
  animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@-webkit-keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@keyframes fadein {
  from {
    bottom: 0;
    opacity: 0;
  }
  to {
    bottom: 30px;
    opacity: 1;
  }
}

@-webkit-keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

@keyframes fadeout {
  from {
    bottom: 30px;
    opacity: 1;
  }
  to {
    bottom: 0;
    opacity: 0;
  }
}

</style>

@endsection

@section('content')

   

     <div class="container">

    <div class="mt-5 row">
          <div class="pic-holder col-md-4">
            <!-- uploaded pic shown here -->

            <?php 
                      if(Auth::user()->profile_path != "" || Auth::user()->profile_path != null)
                      {
            ?>
                          <img id="profilePic" class="pic" src="/storage/profile_picture/<?php echo Auth::user()->profile_path; ?>">
            <?php 
                      }
            ?>
   

            <input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="opacity: 0;" />
            <label for="newProfilePhoto" class="upload-file-block">
            <div class="text-center">
            <div class="mb-2">
              <i class="fa fa-camera fa-2x"></i>
            </div>
            <div class="text-uppercase">
              Update <br /> Profile Photo
            </div>
            </div>
            </label>
          </div>

          <div class="col-md-4">
              <h2 class="mt-3" style="margin-left:10px">Justin Rollo</h2>
              <h5 class="mt-3" style="margin-left:10px"><i class="bi bi-pin-map"></i> San Fernando La Union </h5>
          </div>

    <div>   

            <hr>
            <h1>Languages</h1>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Add Languages</label>
              <br>
              <select class="form-control js-data-example-ajax" id="langSelect" style="width:100%" ></select>
            </div>

            <hr>
            <h1>Video Introduction <i class="bi bi-pencil-fill fa-xs" data-bs-toggle="modal" data-bs-target="#videoModal" style="font-size:25px;"></i></h1>
              
              <div id="div_video" style="display:none;">

                  <video width="400" controls id="videoplayer">
                        <source src="" id="user_video">
                        Your browser does not support HTML5 video.
                      </video>
              </div> 

            <hr>
     
            <div><h1>Education <i class="bi bi-pencil-fill fa-xs" data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size:25px;"></i></h1></div>
           
            <div id="div_education">

            </div>

            <hr>
            <h1>Skills</h1>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Add Skills</label>
              <br>
              <select class="form-control js-data-example-ajax" id="mySelect" style="width:100%" ></select>

            </div>

            <hr>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">School</label>
          <input type="text" id="txtschool" class="form-control txtclear" id="exampleInputEmail1">
          </div>

          <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Degree</label>
          <input type="text" id="txtdegree" class="form-control txtclear" id="exampleInputEmail1">
          </div>

          

          <div class="row">

          <div class="col-md-6">
          <label for="exampleInputEmail1" class="form-label">From</label>
          <input type="text" id="txtfrom" class="form-control txtclear" id="exampleInputEmail1">
          </div>

          <div class="col-md-6">
          <label for="exampleInputEmail1" class="form-label">To</label>
          <input type="text" id="txtto" class="form-control txtclear" id="exampleInputEmail1">
          </div>

          </div>

       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btnAddEducation" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Video</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

              <video width="400" controls>
                <source src="" id="video_here">
                Your browser does not support HTML5 video.
              </video>
              <br>
            <input type="file" name="file" id="gfile" class="user_video" accept="video/*">
     
      </div>
      <div class="modal-footer">
        <button type="button" id="btnVideo" class="btn btn-primary">Upload</button>
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
  load_video();
  load_education();
});


function load_video()
{
  var formData =  new FormData();
  formData.append('_token', CSRF_TOKEN);
  $.ajax({
        type:'POST',
        url: 'ajax/load_video',
        dataType:"json",
        processData: false,
        contentType: false,
        data:formData,
        success:function(data)
        {

          if(data.video != null || data.video != "")
          {
            $('#div_video').show();
            var strSRC = base_url + "/storage/user_video/" + data.video;
            $("#videoplayer").html('<source src="'+strSRC+'"></source>' );
         
          }
          else 
          {
                       
            $('#div_video').hide();
          }
         
        

        }
        });

}


function load_education()
{
  var formData =  new FormData();
  formData.append('_token', CSRF_TOKEN);
  $.ajax({
        type:'POST',
        url: 'ajax/load_education',
        dataType:"json",
        processData: false,
        contentType: false,
        data:formData,
        success:function(data)
        {

         

         for(var x=0; x < data.length; x++)
         {

          console.log(data[x].school);

          

         }
            

        }
        });

}


$('#langSelect').select2({
  multiple: true,
  ajax: {
    url: '/search_language',
    data: function (params) {
      var query = {
        search: params.term,
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    },
    processResults: function (data) {

      console.log(data);
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
      };
    }
    
  }
});

$('#mySelect').select2({
  multiple: true,
  ajax: {
    url: '/search_select',
    data: function (params) {
      var query = {
        search: params.term,
      }

      // Query parameters will be ?search=[term]&type=public
      return query;
    },
    processResults: function (data) {

      console.log(data);
      // Transforms the top-level key of the response object from 'items' to 'results'
      return {
        results: data
      };
    }
    
  }
});

$(document).on('click','#btnTest',function(e)
{
  var myFile = $('#newProfilePhoto').prop('files');
  // var gfiles = $('#newProfilePhoto')[0].files;
    console.log(myFiles);
});



$(document).on('click','#btnAddEducation',function(e)
{

        var school = $('#txtschool').val();
        var from = $('#txtfrom').val();
        var to = $('#txtto').val();
        var degree = $('#txtdegree').val();

        var formData =  new FormData();

        formData.append('school', school);
        formData.append('from', from);
        formData.append('to', to);
        formData.append('degree', degree);
        formData.append('_token', CSRF_TOKEN);

        $.ajax({
        type:'POST',
        url: 'ajax/add_education',
        dataType:"json",
        processData: false,
        contentType: false,
        data:formData,
        success:function(data)
        {
          if(data.error == false)
                {
                    Swal.fire({
                    title: 'Add Education Success!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                    })

                    $("#exampleModal").modal('toggle');

                    $('.txtclear').val(null);

                }
                 else {

                 var err_txt = "";
                 var get_text = "";
                 for(var x=0 ; x < data.errors.length ; x++){

                 get_text =  data.errors[x];

                 err_txt += get_text + "<br>";
                 }


                 Swal.fire({
                 title: 'Upload Video!',
                 icon: "error",
                 html: err_txt,
                 });

                 }


        }
        });
});



$(document).on('click','#btnVideo',function(e)
{

  var gfiles = $('#gfile')[0].files[0];


        var formData =  new FormData();

        formData.append('get_file', gfiles);
        formData.append('_token', CSRF_TOKEN);

        $.ajax({
        type:'POST',
        url: 'ajax/change_video',
        dataType:"json",
        processData: false,
        contentType: false,
        data:formData,
        success:function(data)
        {
          if(data.error == false)
                {
                    Swal.fire({
                    title: 'Upload Video!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                    })

                    $("#videoModal").modal('toggle');

                }
                 else {

                 var err_txt = "";
                 var get_text = "";
                 for(var x=0 ; x < data.errors.length ; x++){

                 get_text =  data.errors[x];

                 err_txt += get_text + "<br>";
                 }


                 Swal.fire({
                 title: 'Upload Video!',
                 icon: "error",
                 html: err_txt,
                 });

                 }


        }
        });
});


$(document).on("change", ".user_video", function(evt) {
  var $source = $('#video_here');
  $source[0].src = URL.createObjectURL(this.files[0]);
  $source.parent()[0].load();
});


$(document).on("change", ".uploadProfileInput", function () {
  var triggerInput = this;
  var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
  var holder = $(this).closest(".pic-holder");
  var wrapper = $(this).closest(".profile-pic-wrapper");
  $(wrapper).find('[role="alert"]').remove();
  triggerInput.blur();
  var files = !!this.files ? this.files : [];
  if (!files.length || !window.FileReader) {
    return;
  }
  if (/^image/.test(files[0].type)) {
 
    // only image file
    var reader = new FileReader(); // instance of the FileReader
    reader.readAsDataURL(files[0]); // read the local file


                  var formData =  new FormData();

                  formData.append('get_file', files[0]);
                  formData.append('_token', CSRF_TOKEN);

                  $.ajax({
                  type:'POST',
                  url: 'ajax/change_picture',
                  dataType:"json",
                  processData: false,
                  contentType: false,
                  data:formData,
                  success:function(data)
                  {
                  console.log(data);


                  }
                  });


    reader.onloadend = function () {
      $(holder).addClass("uploadInProgress");
      $(holder).find(".pic").attr("src", this.result);
      $(holder).append(
        '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
      );

      // Dummy timeout; call API or AJAX below
      setTimeout(() => {
        $(holder).removeClass("uploadInProgress");
        $(holder).find(".upload-loader").remove();
        // If upload successful
        if (Math.random() < 0.9) {
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
          );

          // Clear input after upload
          $(triggerInput).val("");

          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
      

        } else {
          $(holder).find(".pic").attr("src", currentImg);
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
          );

          // Clear input after upload
          $(triggerInput).val("");
          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        }
      }, 1500);
    };
  } else {
    $(wrapper).append(
      '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
    );
    setTimeout(() => {
      $(wrapper).find('role="alert"').remove();
    }, 3000);
  }
});


$(document).on('click','#btnAdd',function(e)
{





});
</script>
@endsection