<div class="card-body">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="username" class="username">Username {{-- -- <span class="username text-danger displayNoneError" ></span >--}}</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username"  value="{{ !empty($user) ? $user->username : old('username') }}">
              </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="email" class="email">Email</label>
                @if(!empty($user))
                    <p class="alert alert-success text-center p-1">
                        {{$user->email}}
                    </p>
                @else
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" onblur="validateEmail(this.value)" {{-- onchange="searchUsername(this.value)" --}}  value="{{ !empty($user) ? $user->email : '' }}" {{ !empty($user) ? 'disabled' : ''}}>
                    @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                @endif
               
                
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="password" class="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="first_name" class="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ !empty($user->userdata) ? $user->userdata->first_name : '' }}">
                @if($errors->has('first_name'))
                    <p class="text-danger">{{ $errors->first('first_name') }}</p>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="last_name" class="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ !empty($user->userdata) ? $user->userdata->last_name : '' }}">
                @if($errors->has('last_name'))
                    <p class="text-danger">{{ $errors->first('last_name') }}</p>
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="dni" class="dni">DNI</label>
                <input type="text" class="form-control maskDNI" name="dni" id="dni" placeholder="DNI" data-inputmask='"mask": "99.999.999"' data-mask  value="{{ !empty($user->userdata) ? $user->userdata->dni : '' }}">
              </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="address" class="address">Address</label>
                <input type="text" class="form-control" name="address" id="address" placeholder="address" value="{{ !empty($user->userdata) ? $user->userdata->address : '' }}">
              </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="mobile" class="mobile">Mobile</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="mobile" id="mobile" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask  value="{{ !empty($user->userdata) ? $user->userdata->mobile : '' }}">
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="date_of_birth" class="date_of_birth">Date of birth</label>
                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" placeholder="date_of_birth"  value="{{ !empty($user->userdata) ? $user->userdata->date_of_birth : '' }}">
              </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="role">Role</label>
                <select class="form-control custom-select" name="role" data-dropdown-css-class="select2-secondary" id="role" style="width: 100%;"  {{ !empty($user) ? 'disabled' : ''}}>
                    <option selected="selected" >Select</option>
                    @foreach ($roles as $role)
                        <p>Hola</p>
                        @if (!empty($user) && !empty($user->roles[0]))
                            <option value="{{$role->id}}" {{ ($user->roles[0]->id === $role->id ? 'selected' : '') ? 'selected':''}}> {{$role->name}}</option>
                        @else
                            <option value="{{$role->id}}">{{ $role->name }}</option>
                        @endif
                    @endforeach
                    {{-- <option value="1">Admin</option>
                    <option value="2">Client</option>
                    <option value="3">User</option> --}}
                </select>
                @if($errors->has('role'))
                    <p class="text-danger">{{ $errors->first('role') }}</p>
                @endif
        </div>
        
    
        
            
        
    </div>
    <div class="w-75 m-auto">
        @if (!empty($user->userdata->avatar))
            
        <div class="form-group">
            <label for="avatar" class="avatar">Avatar</label>
            <img src="{{ url($user->userdata->avatar) }}" class="elevation-2 userImage" alt="User Image">
        </div>
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
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            Submit
    
        </button>
      </div>
</div>
   
  <!-- /.card-body -->

 
