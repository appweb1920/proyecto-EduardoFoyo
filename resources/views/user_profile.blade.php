@extends('layout')
@push('css')
<style>
body{
    background: #f5f5f5;
    margin-top:20px;
}

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background: transparent;
    color: #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
@endpush

@section('content')
<div class="container">
    <div class="container light-style flex-grow-1 container-p-y">
        <button id="delete_user" class="btn btn-danger mt-3" style="margin-left:95%">
            <i class="fas fa-trash-alt"></i>
        </button>
        <form action="{{route('edit_user_data')}}" method="post">
        @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <h4 class="font-weight-bold py-3 mb-4">
                Datos de Usuario
            </h4>

            <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Cambiar Contraseña</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Informacion</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                        <div class="card-body media align-items-center">
                            <img src="{{ asset('img/usuarios')}}/{{$user->user_photo}}.jpg" alt="" class="d-block ui-w-80">
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">E-mail</label>
                                <input type="text" class="form-control mb-1" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                            @if ($user->gender === "m")
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked disabled>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Hombre
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" disabled>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Mujer
                                    </label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" disabled>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Hombre
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2" checked disabled>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Mujer
                                    </label>
                                </div>
                            @endif
                                
                            </div>
                        </div>

                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Contraseña</label>
                                    <input type="password" name="password" value="{{$user->password}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Repite contraseña</label>
                                    <input type="password" name="confirm_password" value="{{$user->password}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Descripcion</label>
                                    <textarea class="form-control" name="description" rows="5">{{$user->description}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
                
    </div>
</div>
@endsection

@push('scripts')
<script>
$( document ).ready(function() {
    $("#delete_user").click(function () {
        var txt;
        if (confirm("¿Estas seguro de que quieres Eliminar?")) {
            window.location.href = "{{route('delete_user',$user->id)}}";
        }
    });
});
</script>
@endpush