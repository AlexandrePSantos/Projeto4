@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <div>
                <img class="wd-100 rounded-circle" alt="profile"
                    src="{{ (!empty($profileData->foto)) ?
                        url('upload/admin_images/'.$profileData->foto) :
                        url('upload/no_image.jpg') }}"
                >
                <span class="h4 ms-3">{{ ($profileData->name) }}</span>
              </div>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Titulo:</label>
                <p class="text-muted">{{ ($profileData->titulo) }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{ ($profileData->email) }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Telemovel:</label>
              <p class="text-muted">{{ ($profileData->telemovel) }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Telefone:</label>
              <p class="text-muted">{{ ($profileData->telefone) }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">NIF:</label>
                <p class="text-muted">{{ ($profileData->nif) }}</p>
            </div>
            <div class="mt-3">
                <label class="tx-11 fw-bolder mb-0 text-uppercase">Morada:</label>
                <p class="text-muted">{{ ($profileData->pais) }}, {{ ($profileData->cidade) }}, {{ ($profileData->morada) }}, {{ ($profileData->codigo_postal) }}</p>
                <p class="text-muted"></p>
            </div>
          </div>
        </div>
        <!-- new wrapper start -->
        <div class="card rounded mt-3">
            <div class="card-body">
                <h6 class="card-title">Alterar Password</h6>
                <form method="POST" action="{{ route('admin.update.password') }}" class="forms-sample" >
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Password Atual</label>
                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror " id="exampleInputEmail1" autocomplete="off" placeholder="*****">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nova Password</label>
                        <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror " id="exampleInputEmail1" autocomplete="off" placeholder="*****">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Confirmar Password</label>
                        <input type="password" name="conf_password" class="form-control" id="exampleInputEmail1" autocomplete="off" placeholder="*****">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Confirmar Alteração</button>
                </form>
            </div>
        </div>
        <!-- new wrapper end -->
      </div>
      <!-- left wrapper end -->

      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Editar Informação</h6>

                    <form method="POST" action="{{ route('admin.profile.store') }}" class="forms-sample" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputTitulo" class="form-label">Titulo</label>
                            <select name="titulo" class="form-control" id="exampleInputTitulo">
                                <option value="Sr." {{ $profileData->titulo == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                <option value="Sra." {{ $profileData->titulo == 'Sra.' ? 'selected' : '' }}>Sra.</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Nome</label>
                            <input type="text" name="name" class="form-control" id="exampleInputUsername1" placeholder="Nome" value="{{$profileData->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$profileData->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telemovel</label>
                            <input type="text" name="telemovel" class="form-control" id="exampleInputEmail1" placeholder="Telemovel" value="{{$profileData->telemovel}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telefone</label>
                            <input type="text" name="telefone" class="form-control" id="exampleInputEmail1" placeholder="Telefone" value="{{$profileData->telefone}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NIF</label>
                            <input type="text" name="nif" class="form-control" id="exampleInputEmail1" placeholder="NIF" value="{{$profileData->nif}}">
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
                        <div class="mb-3">
                            <label class="form-label" for="formFile">Foto</label>
                            <input class="form-control" name="foto" type="file" id="image">
                        </div>
                        <div class="mb-3">
                            <img id="showImage" class="wd-80 rounded-circle"
                                src="{{ (!empty($profileData->foto)) ? url('upload/admin_images/'.$profileData->foto) : url('upload/no_image.jpg') }}"
                                alt="profile"
                            >
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
