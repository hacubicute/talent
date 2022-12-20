@extends('layouts.user_app')

@section('content')

   

     <div class="container">
         Dashboard
      </div>
     

     
  


@endsection


@section('scripts')
<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$( document ).ready(function() {

});


$(document).on('click','#btnAdd',function(e)
{





});
</script>
@endsection