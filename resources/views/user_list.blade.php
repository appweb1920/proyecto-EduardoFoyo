@extends('layout')


@section('content')
<div class="card">
    <div class="card-header">
        <strong>Multiples</strong> Orden
    </div>
    
    <div class="card-body card-block">
        <div class="table-responsive table--no-card m-b-30">
            <table id="table_id" class="table table-borderless display table-striped table-earning">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
               
            </table>
        </div>
    </div>
    <div class="mt-3 token">
        <div class="row no-gutters">
            <div class="ml-5 col-7">
                <div class="monto row mb-3">
                    <input type="text" class="form-control col-sm-6" id="monto" placeholder="Ingresa el monto...">
                    <button type="submit" id="create_order" class="generate ml-5 btn btn-primary" >
                        Generar Orden
                        <div class="spinner-border spinner-border-sm load" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush