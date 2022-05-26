<div class="formdivcat">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?= $urlpost ?>">
      <input type="hidden" id="marcaid" name="marcaid" value="<?= $datosMarca[0]->MARCAID ?>">
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Nombre de la Marca</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datosMarca[0]->MARCA ?>">
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>