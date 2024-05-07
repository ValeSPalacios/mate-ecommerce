@extends('layouts.appClient')
@section('title','Email Enviado')
@extends('layouts.logo')
@extends('layouts.navBar')
@section('content')
<div class="row">
    <div class="col-4">
        <div class="card border border-success">
            <div class="card-body">
                <div class="border border-dark text-danger">
                    Mail Enviado con éxito. Por favor, controla tu bandeja de entrada
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.footer')