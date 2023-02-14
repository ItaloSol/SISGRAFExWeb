<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-8 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Escolha uma seção.</h5>
              <p class="mb-4">
                Veja cada linha de produção das seções
              </p>

              <div class="mb-3">
                <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option selected>Seção de Impressão</option>
                  <option value="1">Acabamento</option>
                  <option value="2">Tipografia</option>
                  <option value="3">Banner</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <iconify-icon icon="fluent:production-20-regular" width="140" height="170"></iconify-icon>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <iconify-icon icon="material-symbols:calendar-month-outline" width="38" height="38"></iconify-icon>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#OpConcluida">
                      Ordens de Produção Concluidas
                    </button>

                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Em 7 dias</span>
              <h3 class="card-title mb-2">3 Ops</h3>
              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <iconify-icon icon="material-symbols:today-outline-rounded" width="38" height="38"></iconify-icon>

                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#OpPendente">
                      Ver as Ordens em Produção
                    </button>

                  </div>
                </div>
              </div>
              <span>Produzindo Hoje</span>
              <h3 class=" card-title text-nowrap mb-1">4 Ops</h3>
              <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-8">
            <h5 class="card-header m-0 me-2 pb-3">Produção Total</h5>
            <div id="totalRevenueChart" class="px-2"></div>
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <div class="text-center">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    2023
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                    <a class="dropdown-item" href="javascript:void(0);">2021</a>
                    <a class="dropdown-item" href="javascript:void(0);">2022</a>
                    <a class="dropdown-item" href="javascript:void(0);">2020</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="growthChart"></div>

            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
              <div class="d-flex">
                <div class="me-2">
                  <iconify-icon icon="fluent-mdl2:product-variant" width="34" height="34"></iconify-icon>
                </div>
                <div class="d-flex flex-column">
                  <small>2022</small>
                  <h6 class="mb-0">75</h6>
                </div>
              </div>
              <div class="d-flex">
                <div class="me-2">
                  <iconify-icon icon="fluent-mdl2:product-variant" width="34" height="34"></iconify-icon>
                </div>
                <div class="d-flex flex-column">
                  <small>2023</small>
                  <h6 class="mb-0">90</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ Total Revenue -->
    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
      <div class="row">
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <iconify-icon icon="wpf:today" width="38" height="38"></iconify-icon>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#OpConcluidaInformações">
                      Mudar Informações
                    </button>
                  </div>
                </div>
              </div>
              <span class="d-block mb-1">Concluido Hoje</span>
              <h3 class="card-title text-nowrap mb-2">0</h3>
              <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> 0%</small>
            </div>
          </div>
        </div>
        <div class="col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar flex-shrink-0">
                  <iconify-icon icon="material-symbols:nearby-error" width="38" height="38"></iconify-icon>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="cardOpt1">
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#OpProblema">
                      Relatar problema
                    </button>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#OpVerBo">
                      Ver Problemas
                    </button>

                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Problemas encontrados</span>
              <h3 class="card-title mb-2">0</h3>
            </div>
          </div>
        </div>
        <!-- </div>
    <div class="row"> -->
        <div class="col-12 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                  <div class="card-title">
                    <h5 class="text-nowrap mb-2">Relatório da seção</h5>
                    <span class="badge bg-label-warning rounded-pill">Ano 2023</span>
                  </div>
                  <div class="mt-sm-auto">
                    <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small>
                    <h3 class="mb-0">90 Ops</h3>
                  </div>

                </div>

                <div id="profileReportChart"></div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->

  <div class="row">
    <div class="col-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="row">
                <div class="col-4">linha de Produção</div>
                <div class="col-8"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#central">
                    Central de Informações
                  </button></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <div class="row">
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">

          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Impressora: Plotter</h5>
              <small class="text-muted">4 Op na linha de Impressão</small>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">

                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>

              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->


      <!-- Expense Overview -->
      <!-- <div class="col-md-6 col-lg-4 order-1 mb-4">
      <div class="card h-100">
        <div class="card-header">
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">
                Eficiência de produção
              </button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab">Tempo Gasto</button>
            </li>
            <li class="nav-item">
              <button type="button" class="nav-link" role="tab">Ultilização de impressoras</button>
            </li>
          </ul>
        </div>
        <div class="card-body px-0">
          <div class="tab-content p-0">
            <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
              <div class="d-flex p-4 pt-3">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../assets/img/icons/unicons/wallet.png" alt="User" />
                </div>
                <div>
                  <small class="text-muted d-block">Total Balance</small>
                  <div class="d-flex align-items-center">
                    <h6 class="mb-0 me-1">$459.10</h6>
                    <small class="text-success fw-semibold">
                      <i class="bx bx-chevron-up"></i>
                      42.9%
                    </small>
                  </div>
                </div>
              </div>
              <div id="incomeChart"></div>
              <div class="d-flex justify-content-center pt-4 gap-2">
                <div class="flex-shrink-0">
                  <div id="expensesOfWeek"></div>
                </div>
                <div>
                  <p class="mb-n1 mt-1">Expenses This Week</p>
                  <small class="text-muted">$39 less than last week</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
      <!--/ Expense Overview -->

      <!-- Transactions -->
      <!-- <div class="col-md-6 col-lg-4 order-2 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Transactions</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
              <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
              <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Paypal</small>
                  <h6 class="mb-0">Send money</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">+82.6</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Wallet</small>
                  <h6 class="mb-0">Mac'D</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">+270.69</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Transfer</small>
                  <h6 class="mb-0">Refund</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">+637.91</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Credit Card</small>
                  <h6 class="mb-0">Ordered Food</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">-838.71</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
            <li class="d-flex mb-4 pb-1">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Wallet</small>
                  <h6 class="mb-0">Starbucks</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">+203.33</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
            <li class="d-flex">
              <div class="avatar flex-shrink-0 me-3">
                <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded" />
              </div>
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">Mastercard</small>
                  <h6 class="mb-0">Ordered Food</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0">-92.45</h6>
                  <span class="text-muted">USD</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div> -->
      <!--/ Transactions -->
      <!--  -->
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">

          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Impressora: 5525</h5>
              <small class="text-muted">4 Op na linha de Impressão</small>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">

                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade do Produto
                  </div>
                </div>

              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->
      <!--  -->
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">

          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Impressora: 2</h5>
              <small class="text-muted">4 Op na linha de Impressão</small>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">

                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade do Produto
                  </div>
                </div>

              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">

          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Impressora: 3</h5>
              <small class="text-muted">4 Op na linha de Impressão</small>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">

                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade do Produto
                  </div>
                </div>

              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">

          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Impressora: 4</h5>
              <small class="text-muted">4 Op na linha de Impressão</small>
            </div>

          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">

            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">

                <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>

              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                  <div class="toast-header">
                    <i class="bx bx-bell me-2"></i>
                    <div class="me-auto fw-semibold">Op: 61665</div>
                    <small>40 minutos</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                  </div>
                  <div class="toast-body">
                    Descrição do produto e Quantidade:
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->
      <!--  -->
    </div>
  </div>
  <?php include_once('b-modals.php'); ?>
  <!-- / Content -->