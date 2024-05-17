@extends('layouts.app')
@extends('layouts.nav')
@extends('menu.menu')
@section('content')


<div class="content-wrapper">
    <div class="row rowFixed">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title titleModule">Provider List</h3> 
                    <a href="{{ route('admin.provider.create') }}" class="btn float-right colorCyan" role="button">+ Add Provider</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="listProvider" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th style="width:20%; text-align:center">First Name</th>
                                <th style="width:20%; text-align:center">Last Name</th>
                                <th style="width:20%; text-align:center">Dni</th>
                                <th style="width:20%; text-align:center">Address</th>
                                <th style="width:20%; text-align:center">Mobile</th>
                                <th style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($providers as $provider)
                                <tr id='providerId_{{$provider->id}}'>
                                    <td>
                                        <span class="textFirstName"> {{ $provider->first_name }}</span>
                                    </td>
                                    <td style=" text-align:center">
                                        <span class="textFirstName">{{ $provider->last_name }}</span>
                                    </td>
                                    <td style=" text-align:center">
                                        <span class="textFirstName">{{ $provider->dni }}</span>
                                    </td>
                                    <td style=" text-align:center">
                                        <span class="textFirstName">{{ $provider->address }}</span>
                                    </td>
                                    <td style=" text-align:center">
                                        <span class="textFirstName">{{ $provider->mobile }}</span></span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn paddBto showData"
                                                data-title="Show" value="{{$provider->id}}"
                                                onclick="showDataProvider({{$provider->id}})">
                                                <i class="fa-regular fa-eye"></i>
                                            </button>
                                            <form action="{{route('admin.provider.edit',$provider->id)}}" method="GET">
                                                <button type="submit" class="btn" data-title="Edit">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn paddBto" 
                                            onclick="deleteProvider({{$provider->id}})" data-title="Delete">
                                                <i class="fas fa-trash-alt" style="color:red"></i>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                               
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <thead>
                                <tr>
                                    <th style="width:20%; text-align:center">First Name</th>
                                    <th style="width:20%; text-align:center">Last Name</th>
                                    <th style="width:20%; text-align:center">Dni</th>
                                    <th style="width:20%; text-align:center">Address</th>
                                    <th style="width:20%; text-align:center">Mobile</th>
                                    <th style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            @include('admin.provider.partials.actions')
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>





@endsection

@section('scripts')

    <script src="{{ asset('js/modules/provider/list.js') }}"></script>

@endsection
