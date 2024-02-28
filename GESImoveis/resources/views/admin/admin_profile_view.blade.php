@extends('admin.admin_dashboard')
@section('admin')

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
                <p class="text-muted">{{ ($profileData->pais) }}</p>
                <p class="text-muted">{{ ($profileData->cidade) }}</p>
                <p class="text-muted">{{ ($profileData->morada) }}</p>
                <p class="text-muted">{{ ($profileData->codigo_postal) }}</p>
            </div>

            {{-- <div class="mt-3 d-flex social-links">
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="github"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="twitter"></i>
              </a>
              <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                <i data-feather="instagram"></i>
              </a>
            </div> --}}
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Editar Informação</h6>

                    <form class="forms-sample">
                        <div class="mb-3">
                            <label for="exampleInputTitulo" class="form-label">Titulo</label>
                            <input type="email" name="titulo" class="form-control" id="exampleInputEmail1" value="{{$profileData->titulo}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telemovel</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Telefone</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">NIF</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">País</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Cidade</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Morada</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Código Postal</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="Password">
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">
                                Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
      </div>
      <!-- middle wrapper end -->
    </div>
</div>

@endsection
