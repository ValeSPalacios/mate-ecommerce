<div class="card-body container">
    <div class="row">
        <div class="col-md-6">
            
                <label for="name" class="name">Nombre{{--   --  <span class="name text-danger displayNoneError" ></span> --}}</label>
                  @if (!empty($userData))
                      <input type="text" class="form-control" name="first_name" id="first_name" 
                      placeholder="Name" 
                      value="{{ $userData->first_name}}">
                  @else
                      <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Name" 
                      value="{{ old('first_name') }}">
                  @endif
                  @if($errors->has('first_name'))
                  <p class="text-danger">{{ $errors->first('first_name') }}</p>
              @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name" class="last_name">Apellido</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name"
                 value="{{ !empty($userData->last_name) ? $userData->last_name : old('last_name') }}">
                @if($errors->has('last_name'))
                    <p class="text-danger">{{ $errors->first('last_name') }}</p>
                @endif
            </div>
        </div>
       
        <div class="col-md-6">
            
                <label for="username" class="username">Username 
                    {{-- -- <span class="username text-danger displayNoneError" ></span >--}}</label>
                <div class="mt-1">
                    <span class="text-success">
                        {{auth()->user()->username}}
                    </span>
                </div>
                    
              
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="email">Email</label>
                <p class="text-success">
                    {{!empty($userData->user->email) ? $userData->user->email : '' }}
                </p>
                <!--<input type="email" class="form-control" name="email" id="email" placeholder="Email" 
                onblur="validateEmail(this.value)" {{-- onchange="searchUsername(this.value)" --}}  
                value="{{ !empty($userData->user->email) ? $userData->user->email : '' }}" {{ !empty($userData->user->email) ? 'disabled' : ''}}>-->
                @if($errors->has('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>
        <div class="col-md-6">
          <label for="address" class="form-label address">Dirección</label>
          <input type="text" class="form-control" id="address" name="address"
          value="{{ !empty($userData->address) ? $userData->address : old('address') }}">
          @if($errors->has('address'))
             <p class="text-danger">{{ $errors->first('last_name') }}</p>
         @endif
        </div>
       
       
        <div class="col-md-6">
            
                <label for="dni" class="dni">DNI</label>
                <input type="text" class="form-control maskDNI" name="dni" id="dni" placeholder="DNI" 
                data-inputmask='"mask": "99.999.999"' data-mask  
                value="{{ !empty($userData->dni) ? $userData->dni : old('dni') }}">
                @if($errors->has('dni'))
                    <p class="text-danger">{{ $errors->first('dni') }}</p>
                @endif
        </div>
          

    <div class="col-md-6">
                @if (!empty($userData->avatar))
                <div class="form-group">
                    <label for="avatar" class="avatar">Avatar</label>
                    <img src="{{ url($userData->avatar) }}" class="elevation-2 userImage" alt="User Image">
                </div>
            @else
                <div class="form-group">
                    <label for="avatar" class="avatar">Avatar</label>
                    <div class="input-group">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" name="avatar" id="avatar">
                        <label class="custom-file-label customFileLabelAvatar" for="avatar" class="avatar">Avatar</label>
                        </div>
                    </div>
                </div>
            @endif
        </div>
          
       <div class="col-md-6">
        <div class="form-group">
            <label for="mobile" class="mobile">Mobile</label>
            <div class="input-group">
                <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" name="mobile" id="mobile" class="form-control" 
                data-inputmask='"mask": "(999) 999-9999"' data-mask  
                value="{{ !empty($userData->mobile) ? $userData->mobile : old('mobile') }}">
            </div>
            @if($errors->has('mobile'))
            <p class="text-danger">{{ $errors->first('mobile') }}</p>
        @endif
        </div>
       </div>

       <div class="col-md-6">
        <div class="form-group">
            <label for="date_of_birth" class="date_of_birth">Date of birth</label>
            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
             placeholder="date_of_birth"  
             value="{{ !empty($userData->date_of_birth) ? $userData->date_of_birth : old('date_of_birth') }}">
          </div>
          @if($errors->has('date_of_birth'))
          <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
      @endif
       </div>

        <div class="col-12 d-flex justify-content-center">
          <button type="submit" class="btn btnStyle1">Editar</button>
        </div>
    </div>
</div>