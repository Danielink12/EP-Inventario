<!-- INICIO DE NAV -->
<div class="flex-shrink-0 p-3 bg-white sidebar" style="width: 280px;">
    <a href="/EP/public/Home" class="navbarcont d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
      <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      <span class="fs-5 fw-semibold">Dist. Emmanuel</span>
    </a>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
          Home
        </button>
        <div class="collapse show" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <!-- <li><a href="#" class="link-dark rounded">Overview</a></li> -->
            <!-- <li><a href="#" class="link-dark rounded">Updates</a></li> -->
            <li><a href="/EP/public/Home" class="link-dark rounded">Pagina principal</a></li>
          </ul>
        </div>
      </li>
      <!-- <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Dashboard
        </button>
        <div class="collapse show" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-dark rounded">Overview</a></li>
            <li><a href="#" class="link-dark rounded">Weekly</a></li>
            <li><a href="#" class="link-dark rounded">Monthly</a></li>
            <li><a href="#" class="link-dark rounded">Annually</a></li>
          </ul>
        </div>
      </li> -->
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Mantenimientos
        </button>
        <div class="collapse show" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
          <li><a href="/EP/public/Marca" class="link-dark rounded">Marcas</a></li>
            <li><a href="/EP/public/Categoria" class="link-dark rounded">Categorias</a></li>
            <li><a href="/EP/public/Producto" class="link-dark rounded">Productos</a></li>
            <li><a href="/EP/public/Entradasalida" class="link-dark rounded">Entradas y salidas</a></li>
            <li><a href="/EP/public/Usuario" class="link-dark rounded">Usuarios</a></li>
          </ul>
        </div>
      </li>
      <li class="border-top my-3"></li>
      <li class="mb-1">
        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
          Cuenta
        </button>
        <div class="collapse show" id="account-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <!-- <li><a href="#" class="link-dark rounded">New...</a></li> -->
            <li><a href="#" class="link-dark rounded">Perfil</a></li>
            <!-- <li><a href="#" class="link-dark rounded">Ajustes</a></li> -->
            <li><a href="/EP/public/Home/cerrarSesion" class="link-dark rounded">Cerrar Sesión</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </div>

  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

  <script src="../config/js/sidebars.js"></script>
<!-- FIN DE NAV -->