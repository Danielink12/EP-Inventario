<div class="formdiv">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="http://localhost:8080/EP/public/Usuario/editarUsuario">
      <input type="hidden" id="userid" name="userid" value="<?= $datosUsuario[0]->USUARIOID ?>">
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nombres</label>
      <input type="text" class="form-control" id="nombres" name="nombres" value="<?= $datosUsuario[0]->NOMBRES ?>">
    </div>
    <div class="col-md-6">
      <label for="inputAddress" class="form-label">Apellidos</label>
      <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="" value="<?= $datosUsuario[0]->APELLIDOS ?>">
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Telefono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" placeholder="" value="<?= $datosUsuario[0]->TELEFONO ?>">
    </div>
    <div class="col-6">
      <label for="inputAddress2" class="form-label">Usuario</label>
      <input type="text" class="form-control" id="usuario" name="usuario" placeholder="" value="<?= $datosUsuario[0]->USERN ?>">
    </div>
    <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Contraseña</label>
      <input type="password" class="form-control" id="pass" name="pass" value="<?= $datosUsuario[0]->PASSW ?>">
    </div>
    <div class="col-md-4">
      <label for="inputState" class="form-label">Tipo de Usuario</label>
      <select id="tipousuario" name="tipousuario" class="form-select">
        <option>ELEGIR...</option>
        <option value="1" <?= $datosUsuario[0]->TUADMIN ?>>ADMINISTRADOR</option>
        <option value="2" <?= $datosUsuario[0]->TUOPERADOR ?>>OPERADOR</option>
      </select>
    </div>
    <div class="col-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="estadousuario" name="estadousuario" <?= $datosUsuario[0]->ESTADO ?>>
        <label class="form-check-label" for="gridCheck">
          Activo
        </label>
      </div>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>