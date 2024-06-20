@extends('admin.admin_dashboard')
@section('admin')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="page-content">
    <div class="row profile-body">

      <!-- middle wrapper start -->
      <div class="col-md-12 col-xl-12 middle-wrapper">
        <div class="row">
            <div class="card body-content">
                <div class="card-body">
                    <h2 class="card-title">Editar Informação</h2>

                    <form method="POST" action="{{ route('admin.profile.store') }}" class="profile-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputTitulo" class="form-label">Titulo</label>
                                <select name="titulo" class="form-control" id="exampleInputTitulo">
                                    <option value="Sr." {{ $profileData->titulo == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                    <option value="Sra." {{ $profileData->titulo == 'Sra.' ? 'selected' : '' }}>Sra.</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputUsername1" class="form-label">Nome</label>
                                <input type="text" name="name" class="form-control" id="exampleInputUsername1" placeholder="Nome" value="{{$profileData->name}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$profileData->email}}">
                            </div>
                            <div class="col-md-6">
                                <label for="nif" class="form-label">NIF</label>
                                <input type="text" name="nif" class="form-control" id="nif" placeholder="NIF" value="{{$profileData->nif}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <div class="col-md-12 col-sm-6 mb-3">
                                    <input type="text" name="telefone" class="form-control" id="telefone" placeholder="Telefone" value="{{$profileData->telefone}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="form-label">Telemovel</label>
                                <div class="col-md-12 col-sm-6 mb-3">
                                    <input type="text" name="telemovel" class="form-control" id="exampleInputEmail1" placeholder="Telemovel" value="{{$profileData->telemovel}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Morada</label>
                            <div class="row">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <input type="text" name="pais" class="form-control" id="exampleInputEmail1" placeholder="País" value="{{$profileData->pais}}">
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <input type="text" name="cidade" class="form-control" id="exampleInputEmail1" placeholder="Cidade" value="{{$profileData->cidade}}">
                                </div>
                                <div class="col-md-4 col-sm-6 mb-3">
                                    <input type="text" name="morada" class="form-control" id="exampleInputEmail1" placeholder="Morada" value="{{$profileData->morada}}">
                                </div>
                                <div class="col-md-2 col-sm-6 mb-3">
                                    <input type="text" name="codigo_postal" class="form-control" id="exampleInputEmail1" placeholder="Código Postal" value="{{$profileData->codigo_postal}}">
                                </div>
                            </div>
                        </div>
                        <!-- Password change form -->
                        <h6 class="card-title mt-4">Alterar Password</h6>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Password Atual</label>
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="exampleInputEmail1" autocomplete="off">
                            @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nova Password</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" id="exampleInputEmail1" autocomplete="off">
                            @error('new_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Confirmar Nova Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" id="exampleInputEmail1" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Confirmar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <!-- middle wrapper end -->
    </div>
</div>

@endsection
