<div class="card-body p-4 p-md-5 poppins-medium">
    <h2 class="mb-4 pb-2 pb-md-0 mb-md-4">Editar datos</h2>
    <form>
        <div>
            <h4 for="username" class="username mb-4">Usuario: {{auth()->user()->username}}</h4>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                    @if (!empty($userData))
                        <input type="text" class="form-control form-control-lg" name="first_name" id="first_name" value="{{ $userData->first_name}}">
                    @else
                        <input type="text" class="form-control form-control-lg" name="first_name" id="first_name" value="{{ old('first_name') }}">
                    @endif
                    @if($errors->has('first_name'))
                        <p class="text-danger">{{ $errors->first('first_name') }}</p>
                    @endif
                    <label class="form-label" for="name">Nombre</label>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input  type="text" class="form-control form-control-lg" name="last_name" id="last_name"
                        value="{{ !empty($userData->last_name) ? $userData->last_name : old('last_name') }}">
                    @if($errors->has('last_name'))
                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                    @endif
                    <label class="last_name" for="last_name">Apellido</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="text" class="form-control form-control-lg" id="address" name="address"
                    value="{{ !empty($userData->address) ? $userData->address : old('address') }}">
                    @if($errors->has('address'))
                        <p class="text-danger">{{ $errors->first('last_name') }}</p>
                    @endif
                    <label class="form-label" for="address">Dirección</label>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                <input type="text" class="form-control form-control-lg maskDNI" name="dni" id="dni" 
                data-inputmask='"mask": "99.999.999"' data-mask  
                value="{{ !empty($userData->dni) ? $userData->dni : old('dni') }}">
                @if($errors->has('dni'))
                    <p class="text-danger">{{ $errors->first('dni') }}</p>
                @endif
                    <label class="form-label" for="dni">DNI</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="email" class="form-control form-control-lg" name="email" id="email" 
                    onblur="validateEmail(this.value)" {{-- onchange="searchUsername(this.value)" --}}  
                    value="{{ !empty($userData->user->email) ? $userData->user->email : '' }}" {{ !empty($userData->user->email) ? 'disabled' : ''}}>
                    @if($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                    @endif
                    <label for="email" class="email">Correo electrónico</label>
                    <p class="text-success">
                        {{!empty($userData->user->email) ? $userData->user->email : '' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="mobile" id="mobile" class="form-control form-control-lg" 
                    data-inputmask='"mask": "(999) 999-9999"' data-mask  
                    value="{{ !empty($userData->mobile) ? $userData->mobile : old('mobile') }}">
                </div>
                <label class="mobile" for="mobile">Teléfono</label>
                @if($errors->has('mobile'))
                    <p class="text-danger">{{ $errors->first('mobile') }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div data-mdb-input-init class="form-outline">
                    <input type="date" class="form-control form-control-lg" name="date_of_birth" id="date_of_birth"
                        placeholder="date_of_birth"  
                        value="{{ !empty($userData->date_of_birth) ? $userData->date_of_birth : old('date_of_birth') }}">
                    <label class="date_of_birth" for="date_of_birth">Fecha de nacimiento</label>
                    @if($errors->has('date_of_birth'))
                        <p class="text-danger">{{ $errors->first('date_of_birth') }}</p>
                    @endif
                </div>
            </div>
            <!--    Acá debe ir la foto del usuario -->
            
        </div>

        <div class="col-12 d-flex justify-content-center">
            <button type="submit" class="poppins-regular btn general-btn btn-lg">Editar</button>
        </div>
    </form>
</div>

<!-- foto del usuario
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
-->