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
                <form method="POST" action="{{ route('admin.update.password') }}" class="forms-sample">
                    @csrf <!-- Adicionar o token CSRF -->
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
                    <button type="submit" class="btn btn-primary me-2">Confirmar Alteração</button>
                </form>

            </div>
        </div>
        <!-- new wrapper end -->
      </div>
      <!-- left wrapper end -->

      <!-- middle wrapper start -->
                </div>
            </div>
        </div>
      </div>
      <!-- middle wrapper end -->
    </div>
</div>

@endsection
