@extends('layouts.dashboard-master')
@section('page-header')
	Add Flat Data
@stop
@section('dashboard-body')
<div class="row">
	<form class="row g-3" action="{{url('store-flat-info')}}" method="POST">
    	@csrf
    	<div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-control form-control-sm" id="rhe_name" name ="rhe_name" placeholder="Name of the RHE">
                <label for="rhe_name">Name of the RHE</label>
                <span id="error_rhe_name" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
           		<select class="form-select" id="flat_type" name="flat_type"aria-label="flat_type">
	                <option selected="">- Select -</option>
            		@foreach ($flatTypes as $flatType)
                	<option value="{{ $flatType->flat_type_id }}">{{ $flatType->flat_type }}</option>
            		@endforeach
             	</select>
            	<label for="flat_type">Select Flat Type</label>
            	<span id="error_flat_type" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
           		<select class="form-select" id="block_name" name="block_name_list" aria-label="block_name">
	                <option selected="">- Select -</option>
            		@foreach ($blocks as $block)
                	<option value="{{ $block->block_id }}">{{ $block->block_name }}</option>
            		@endforeach
             	</select>
            	<label for="block_name">Select Block Name</label>
            	<span id="error_block" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <select class="form-select" id="floor" name="floor_no" aria-label="floor">
                	<option selected="">- Select -</option>
                    <option value="1">Ground</option>
                    <option value="2">First</option>
                    <option value="3">Second</option>
                    <option value="4">Third</option>
                    <option value="5">Fourth</option>
                    <option value="6">Fifth</option>
                    <option value="7">Sixth</option>
                    <option value="8">Seventh</option>
                    <option value="9">Eighth</option>
                    <option value="10">Top</option>
	            </select>
	            <label for="floor">Floor No.</label>
	            <span id="error_floor" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" class="form-control form-control-sm" id="flat_no" name ="flat_number" placeholder="Flat Number">
                <label for="flat_no">Flat No.</label>
                <span id="error_flat_no" class="text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
		    <div class="form-floating">
		        <select class="form-select" id="flat_status" name="flat_status_list" aria-label="flat_status">
		            <option selected="">- Select -</option>
		            @foreach ($flat_status_list as $flat_status)
		                <option value="{{ $flat_status->flat_status_id }}">{{ $flat_status->flat_status_code }}</option>
		            @endforeach
		        </select>
		        <label for="flat_status">Select Flat Status</label>
		        <span id="error_flat_status" class="text-danger"></span>
		    </div>
		</div>
		<div class="col-md-4">
		    <div class="form-floating" id="remarks_container" style="display: none;">
		        <input type="text" class="form-control form-control-sm" id="remarks_field" name="remarks" placeholder="Remarks">
		        <label for="remarks">Remarks</label>
		        <span id="error_remarks_field" class="text-danger"></span>
		    </div>
		</div>
        <div class="col-md-12 text-center">
          <button type="submit"class="btn btn-success" id="submit-btn">Add Data</button>
        </div>
	</form>
</div>
@stop
<script src="{{asset('/jquery/jquery.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('#remarks_container').hide();
    $('#flat_status').change(function(){
        $('#remarks_field').val('');
        var flat_status=$('#flat_status').val();
        if (flat_status == 8){
            $('#remarks_container').show();
        }else{
            $('#remarks_container').hide();
        }
    });
    $('#submit-btn').click(function(){
        
        var error_rhe_name ='';
        var error_father_husband_name ='';

        if($.trim($('#rhe_name').val()).length == 0)
        {
         error_rhe_name = 'This field is required';
         $('#error_rhe_name').text(error_rhe_name);
         $('#rhe_name').addClass('has-error');
        }
        else
        {
         error_rhe_name = '';
         $('#error_rhe_name').text(error_title);
         $('#rhe_name').removeClass('has-error');
        }

        if($.trim($('#flat_type').val()).length == 0)
        {
         error_flat_type = 'This field is required';
         $('#error_flat_type').text(error_flat_type);
         $('#flat_type').addClass('has-error');
        }
        else
        {
         error_flat_type = '';
         $('#error_flat_type').text(error_flat_type);
         $('#flat_type').removeClass('has-error');
        }

        if($.trim($('#block_name_list').val()).length == 0)
        {
         error_block = 'This field is required';
         $('#error_block').text(error_block);
         $('#block_name_list').addClass('has-error');
        }
        else
        {
         error_block = '';
         $('#error_block').text(error_block);
         $('#block_name_list').removeClass('has-error');
        }

        if($.trim($('#floor_no').val()).length == 0)
        {
         error_floor = 'This field is required';
         $('#error_floor').text(error_floor);
         $('#floor_no').addClass('has-error');
        }
        else
        {
         error_floor = '';
         $('#error_floor').text(error_floor);
         $('#floor_no').removeClass('has-error');
        }

        if($.trim($('#flat_number').val()).length == 0)
        {
         error_flat_no = 'This field is required';
         $('#error_flat_no').text(error_flat_no);
         $('#flat_number').addClass('has-error');
        }
        else
        {
         error_flat_no = '';
         $('#error_flat_no').text(error_flat_no);
         $('#flat_number').removeClass('has-error');
        }

        if($.trim($('#flat_status_list').val()).length == 0)
        {
         error_flat_status = 'This field is required';
         $('#error_flat_status').text(error_flat_status);
         $('#flat_status_list').addClass('has-error');
        }
        else
        {
         error_flat_status = '';
         $('#error_flat_status').text(error_flat_status);
         $('#flat_status_list').removeClass('has-error');
        }

        if($.trim($('#remarks').val()).length == 0)
        {
         error_remarks_field = 'This field is required';
         $('#error_remarks_field').text(error_remarks_field);
         $('#remarks').addClass('has-error');
        }
        else
        {
         error_remarks_field = '';
         $('#error_remarks_field').text(error_remarks_field);
         $('#remarks').removeClass('has-error');
        }

        if( error_rhe_name != '' || error_flat_type != '' || error_block != '' || error_floor != '' || error_flat_no != '' || error_flat_status != '' || error_remarks_field != '')
        {
         return false;
        }
        else
        {
         return true;
        }
    });
});
</script>