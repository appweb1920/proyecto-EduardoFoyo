@extends('layout')
@push('css')
@endpush

@section('content')
<div class="container">
    <div class="container light-style flex-grow-1 container-p-y">
        <form action="{{route('add_interest')}}" method="post">
        @csrf
            <h4 class="font-weight-bold py-3 mb-4">
                Agregar intereses
            </h4>

            <div class="card overflow-hidden p-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">intereses</label>
                    <input type="text" class="form-control" name="interest">
                </div>
                <div class="text-right mt-3">
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

@endpush