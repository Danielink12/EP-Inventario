<div class="formdivcat">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?= $urlpost ?>">
      <input type="hidden" id="categoriaid" name="categoriaid" value="<?= $datosCategoria[0]->CATEGORIAID ?>">
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Nombre de Categoria</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="<?= $datosCategoria[0]->CATEGORIA ?>" required>
    </div>
      <button type="submit" class="btn btn-primary"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>