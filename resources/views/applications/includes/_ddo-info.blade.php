<div>
    <h5>&#9680; DDO Details</h5>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <select class="form-select" id="ddo_district" name="ddo_district" aria-label="ddo district" disabled>
            <option value="">- Select -</option>
            @foreach ($districts as $district)
                <option value="{{ $district->district_code }}" @selected($district->district_code == $ddoInfo->district_code)>
                    {{ $district->district_name }}
                </option>
            @endforeach
        </select>
        <label for="ddo_district">DDO District</label>
        <span id="error_ddo_district" class="text-danger"></span>
        @error('ddo_district')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        {{-- <select class="form-select" id="ddo_designation" name="ddo_designation"
                        aria-label="ddo designation">
                        <option value="">- Select -</option>
                    </select> --}}
        <input type="text" class="form-control form-control-sm" id="ddo_designation" name="ddo_designation"
            value="{{ $ddoInfo->ddo_designation }}" readonly />
        <label for="ddo_designation">DDO Designation</label>
        <span id="error_ddo_designation" class="text-danger"></span>
        @error('ddo_designation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <textarea class="form-control" placeholder="DDO Address" name="ddo_address" id="ddo_address" readonly>{{ $ddoInfo->ddo_address ?? 'NA' }}</textarea>
        <label for="ddo_address">DDO Address</label>
        <span id="error_ddo_address" class="text-danger"></span>
        @error('ddo_address')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
