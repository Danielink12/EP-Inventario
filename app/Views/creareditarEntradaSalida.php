<div class="formdivcat">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?= $urlpost ?>">
      <input type="hidden" id="esid" name="esid" value="<?= $datosES[0]->IYSID ?>">
      <div class="col-md-12">
      <label for="inputState" class="form-label">Producto</label>
      <select id="productoid" name="productoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($producto->getResult() as $itemproducto): ?>
        <option value="<?= $itemproducto->PRODUCTOID ?>" <?php if($itemproducto->PRODUCTOID==$datosES[0]->PRODUCTOID){echo "selected";} ?>><?= $itemproducto->PRODUCTO ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-12">
      <label for="inputEmail4" class="form-label">Cantidad</label>
      <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?= $datosES[0]->CANTIDAD ?>" required>
    </div>
    <div class="col-md-12">
      <label for="inputState" class="form-label">Tipo de Proceso</label>
      <select id="tipoprocesoid" name="tipoprocesoid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($tipoproceso->getResult() as $itemtipoproceso): ?>
        <option value="<?= $itemtipoproceso->TIPOPROCESOID ?>" <?php if($itemtipoproceso->TIPOPROCESOID==$datosES[0]->TIPOPROCESOID){echo "selected";} ?>><?= $itemtipoproceso->TIPOPROCESO ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="btn btn-primary btnnuevaES"><?= esc($txtbtn) ?></button>
    </div>
  </form>
</div>