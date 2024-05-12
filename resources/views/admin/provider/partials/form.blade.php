<div class="row mt-4">
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label for="first_name" class="col-form-label text-right colorLabel code">First Name:</label>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name='first_name' maxlength="100" size="100" required
            value={{!empty($provider)?$provider->first_name:old('first_name')}}>
        </div>
        <div class="col-2 text-right">
            <label for="last_name" class="col-form-label text-right colorLabel">Last name:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" name='last_name' id='last_name' maxlength="100" size="100" required
            value={{!empty($provider)?$provider->last_name:old('last_name')}}>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label for="dni" class="col-form-label text-right colorLabel code">DNI:</label>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name='dni' id='dni' maxlength="8" size="8" required
            value={{!empty($provider)?$provider->dni:old('dni')}}>
           
            @if($errors->has('dni'))
            <p class="text-danger">{{ $errors->first('dni') }}</p>
            @endif
        </div>
        <div class="col-2 text-right">
            <label for="address" class="col-form-label text-right colorLabel">Address:</label>
        </div>
        <div class="col-3">
            <input type="text" class="form-control" name='address' id='address' maxlength="200" size="200" required
            value={{!empty($provider)?$provider->address:old('address')}} >
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label for="mobile" class="col-form-label text-right colorLabel code">Mobile:</label>
        </div>
        <div class="col-4">
            <input type="text" class="form-control" name='mobile'id='mobile' maxlength="10" size="10" required 
            value={{!empty($provider)?$provider->mobile:old('mobile')}}>
        </div>

    </div>




    <div class="text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</div>
