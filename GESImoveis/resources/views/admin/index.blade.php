@extends('admin.admin_dashboard')
@section('admin')

<link rel="stylesheet" href="{{ asset('css/dash.css') }}">


<div class="page-content">
    <!-- Listagem de todas as propriedades do sistema -->
    <div class="row">
      <div class="col-lg-6 col-xl-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Propriedades</h6>
            </div>
            <div id="monthlySalesChart"></div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <!-- Listagem de todas os arrendamentos do sistema -->
    <div class="row">
        <div class="col-lg-6 col-xl-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Arrendamentos</h6>
              </div>
              <div id="monthlySalesChart"></div>
            </div>
          </div>
        </div>
    </div> <!-- row -->

    <!-- Listagem de todas os Inquilinos do sistema -->
    <div class="row">
        <div class="col-lg-6 col-xl-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Inquilinos</h6>
                </div>
                <div id="monthlySalesChart"></div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

    <!-- Listagem de todos os Proprietários do sistema -->
    <div class="row">
        <div class="col-lg-6 col-xl-6 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Utilizadores</h6>
                </div>
                <div id="monthlySalesChart"></div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

</div>

@endsection
