@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Bem vindo ao GESImoveis!</h4>
      </div>
    </div>

    <!-- Listagem de todas as propriedades do sistema -->
    <div class="row">
      <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Propriedades</h6>
            </div>
            <p class="text-muted">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
            <div id="monthlySalesChart"></div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <!-- Listagem de todas os arrendamentos do sistema -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Arrendamentos</h6>
              </div>
              <p class="text-muted">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
              <div id="monthlySalesChart"></div>
            </div>
          </div>
        </div>
    </div> <!-- row -->

    <!-- Listagem de todas os Inquilinos do sistema -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Inquilinos</h6>
                </div>
                <p class="text-muted">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
                <div id="monthlySalesChart"></div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

    <!-- Listagem de todos os Proprietários do sistema -->
    <div class="row">
        <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Utilizadores</h6>
                </div>
                <p class="text-muted">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
                <div id="monthlySalesChart"></div>
            </div>
            </div>
        </div>
    </div> <!-- row -->

</div>

@endsection
