@extends('layouts.user_app')

@section('content')

   

     <div class="container">

      <div id="page1" class="mt-5">
       <h2>Manage Jobs</h2>
       <hr>
      <button class="btn btn-danger mt-2"  id="btnToggle">Add Jobs</button>
      <!-- <button class="btn btn-danger mt-5"  data-bs-toggle="modal" data-bs-target="#exampleModal">Add Jobs</button> -->
      </div>

      <div id="page2" class="mt-5" style="display:none;">

 

      <h2>Add Jobs</h2>
         
       <hr>

         <div class="d-flex justify-content-end">
            <button class="btn btn-danger" id="back">Back</button>
          </div>


            <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Title</label>
                  <input type="text" class="form-control" id="txttitle" placeholder="Title">
            </div>

            
          <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Skills</label>
              <br>
              <select class="form-control js-data-example-ajax" id="mySelect" style="width:100%" ></select>

          </div>

            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Level</label>
                <select class="form-select"  id="txtlevel">
                <option value="entry">Entry</option>
                <option value="intermediate">Intermediate</option>
                <option value="expert">Expert</option>
                </select>
            </div>

          <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Job Description</label>
              <textarea class="form-control" id="txtjd" rows="4"></textarea>
          </div>

          <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Rate(Hourly) Ex. 3$-5$ Dollars</label>
              <div class="row">
                 <div class="col-md-6">
                 <input type="number" class="form-control" id="txtrate" min="1" value="1">
                  </div>
                  <div class="col-md-6">
                 <input type="number" class="form-control" id="txtrate2" min="1" value="2">
                  </div>
              </div>
             
          </div>

          <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Slot</label>
              <input type="number" class="form-control" id="txtslot" min="1" value="1">
          </div>

          <button type="button" id="btnAdd" class="btn btn-primary" style="float:right;">Add</button>
        
      </div>

    </div>
     
<!-- 
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Job</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>     
      <div class="modal-body">

      <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="txttitle" placeholder="Title">
      </div>

      
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Skills</label>
        <br>
        <select class="form-control js-data-example-ajax" id="mySelect" style="width:100%" ></select>

    </div>

      <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Level</label>
            <input type="text" class="form-control" id="txtlevel" placeholder="Level">
      </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Job Description</label>
        <textarea class="form-control" id="txtjd" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Rate(Hourly)</label>
        <input type="text" class="form-control" id="txtrate" placeholder="Rate Ex. 3$-5$ Dollars">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Slot</label>
        <input type="number" class="form-control" id="txtslot" min="1" value="1">
    </div>







                      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="btnAdd" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div> -->

     
  


@endsection


@section('scripts')
<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$( document ).ready(function() {
 


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




$(document).on('click','#btnToggle',function(e)
{
  // $("#page1").toggle('slide', "left", 1000);
  $("#page1").fadeOut();
  $("#page2").fadeIn("slow");
});

$(document).on('click','#back',function(e)
{
  // $("#page1").toggle('slide', "left", 1000);
  $("#page2").fadeOut();
  $("#page1").fadeIn("slow");
});

$(document).on('click','#btnAdd',function(e)
{

var skills = $('#mySelect').select2("val");

 var txttitle = $('#txttitle').val();
 var txtlevel = $('#txtlevel').val();
 var txtjd = $('#txtjd').val();
 var txtrate = $('#txtrate').val() + "$ - " + $('#txtrate2').val() + "$";
 var txtslot = $('#txtslot').val();

 if(skills.length != 0)
 {
      var formData =  new FormData();

      formData.append('title', txttitle);
      formData.append('level', txtlevel);
      formData.append('job_description', txtjd);
      formData.append('rate', txtrate);
      formData.append('slot', txtslot);
      formData.append('skills', JSON.stringify(skills));
      formData.append('_token', CSRF_TOKEN);

      $.ajax({
      type:'POST',
      url: 'ajax/add_job',
      dataType:"json",
      processData: false,
      contentType: false,
      data:formData,
      success:function(data)
      {
      console.log(data);

      if(data.error == false)
      {
        Swal.fire({
        title: 'Create Job!',
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
            title: 'Create Job!',
            icon: "error",
            html: err_txt,
            });

            }


      }
      });

 } else 
 {

      Swal.fire({
        title: 'Create Job!',
        icon: "error",
        html: "Please select skills",
        });

 }
 

    


});
</script>
@endsection