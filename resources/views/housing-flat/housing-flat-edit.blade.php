@extends('layouts.dashboard-master')
@section('page-header')
	Edit Flat Data
@stop
@section('dashboard-body')
<div class="row">
	<form class="row g-3" action="{{url('store-flat-info')}}" method="POST">
    	@csrf
    	<div class="col-md-6">
            <div class="form-floating">
                <select class="form-select" id="estate" name="estate" aria-label="estate">
                	<option selected="">- Select -</option>
                    @foreach ($rhe_list as $rhe_list)
                        <option value="{{ $rhe_list->estate_id }}">{{ $rhe_list->estate_name }}</option>
                    @endforeach
	            </select>
	            <label for="estate">Select Name of the RHE</label>
	            <span id="error_estate" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
           		<select class="form-select" id="flat_type" name="flat_type"aria-label="flat_type">
	                <option selected="">- Select -</option>
             	</select>
            	<label for="flat_type">Select Flat Type</label>
            	<span id="error_flat_type" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
           		<select class="form-select" id="block" name="block" aria-label="block">
	                <option selected="">- Select -</option>
             	</select>
            	<label for="block">Select Block Name</label>
            	<span id="error_block" class="text-danger"></span>
            </div>
        </div>
	</form>
</div>
@stop
<script src="{{asset('/jquery/jquery.min.js')}}"></script>
<script>
$(document).ready(function(){
  $('#estate').change(function() {
    $('#flat_type').empty().append('<option value="">Please select Options</option>');
    $('#block').empty().append('<option value="">Please select Options</option>');
    let estate_id =  $('#estate').val();  
    let url ="{{url('housing-flat-get-flat-type')}}"
    $.ajax({
      type: 'POST',
      url:url,
      dataType:"JSON",
      data: {
        "_token": "{{ csrf_token() }}",
        "estate_id": estate_id
      },
      success: function (datas) {
        if (!datas || datas.length === 0) {
          // alert("sucess with 0 data");
           return;
        }
        // alert('success with non zero data');
        for (var  i = 0; i < datas.length; i++) {
          $('#flat_type').append($('<option>', {
            value: datas[i].id,
            text: datas[i].name
        }));
        }
      },
      error: function (ex) {
      }
    });
  });

  $('#flat_type').change(function() {
    $('#block').empty().append('<option value="">Please select Options</option>');
    let estate_id =  $('#estate').val();
    let flat_type =  $('#flat_type').val();  
    let url ="{{url('housing-flat-get-flat-block')}}"
    $.ajax({
      type: 'POST',
      url:url,
      dataType:"JSON",
      data: {
        "_token": "{{ csrf_token() }}",
        "estate_id": estate_id,
        "flat_type": flat_type
      },
      success: function (datas) {
        if (!datas || datas.length === 0) {
          // alert("sucess with 0 data");
           return;
        }
        // alert('success with non zero data');
        for (var  i = 0; i < datas.length; i++) {
          $('#block').append($('<option>', {
            value: datas[i].id,
            text: datas[i].name
        }));
        }
      },
      error: function (ex) {
      }
    });
  });
  $('#block').change(function() {
    let estate_id =  $('#estate').val();
    let flat_type =  $('#flat_type').val();
    let block =  $('#block').val();  
    let url ="{{url('housing-flat-list-view')}}"
    $.ajax({
      type: 'GET',
      url:url,
      dataType:"JSON",
      data: {
        "_token": "{{ csrf_token() }}",
        "estate_id": estate_id,
        "flat_type": flat_type,
        "block" : block
      },
      success: function (datas) {
        if (!datas || datas.length === 0) {
          // alert("sucess with 0 data");
           return;
        }
        // alert('success with non zero data');
        // for (var  i = 0; i < datas.length; i++) {
        //   $('#block').append($('<option>', {
        //     value: datas[i].id,
        //     text: datas[i].name
        // }));
        // }
      },
      error: function (ex) {
      }
    });
  });
});

</script>