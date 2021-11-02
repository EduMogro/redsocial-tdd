@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card border-0">
                    <form action="{{ route('statuses.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <textarea class="form-control border-0" placeholder="Ingresa un estado" name="body"></textarea>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-primary" id="create-status">Publicar estado</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection