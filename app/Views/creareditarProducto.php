<div class="formdiv">
  <h2 class="titulo"><?= $seccion ?></h2>
  <form class="row g-3" method="post" action="<?= $urlpost ?>">
      <input type="hidden" id="productoid" name="productoid" value="<?= $datosProducto[0]->PRODUCTOID ?> ">
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nombre del Producto</label>
      <input type="text" class="form-control" id="nombreproducto" name="nombreproducto" value="<?= $datosProducto[0]->PRODUCTO ?>" required>
    </div>
    <div class="col-md-6">
      <label for="inputAddress" class="form-label">Stock</label>
      <input type="number" step="0.01" class="form-control" id="stock" name="stock" placeholder="" value="<?= $datosProducto[0]->STOCK ?>" required>
    </div>
    <div class="col-6">
      <label for="inputAddress" class="form-label">Pecio Proveedor</label>
      <input type="number" step="0.01" class="form-control" id="precioproveedor" name="precioproveedor" placeholder="" value="<?= $datosProducto[0]->PRECIOPROVEEDOR ?>" required>
    </div>
    <div class="col-6">
      <label for="inputAddress2" class="form-label">Precio Venta</label>
      <input type="number" step="0.01" class="form-control" id="precioventa" name="precioventa" placeholder="" value="<?= $datosProducto[0]->PRECIOVENTA ?>" required>
    </div>
    <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Ancho (si aplica)</label>
      <input type="number" step="0.01" class="form-control" id="ancho" name="ancho" value="<?= $datosProducto[0]->ANCHO ?>">
    </div>
    <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Alto (si aplica)</label>
      <input type="number" step="0.01" class="form-control" id="alto" name="alto" value="<?= $datosProducto[0]->ALTO ?>">
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Marca</label>
      <select id="marcaid" name="marcaid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($marca->getResult() as $itemmarca): ?>
        <option value="<?= $itemmarca->MARCAID ?>" <?php if($itemmarca->MARCAID==$datosProducto[0]->MARCAID){echo "selected";} ?>><?= $itemmarca->MARCA ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-6">
      <label for="inputState" class="form-label">Categoria</label>
      <select id="categoriaid" name="categoriaid" class="form-select" required>
        <option <?php if($nuevo==true){echo "selected disabled";}else{echo "disabled";} ?> value="">ELEGIR...</option>
        <?php foreach ($categoria->getResult() as $itemcategoria): ?>
        <option value="<?= $itemcategoria->CATEGORIAID ?>" <?php if($itemcategoria->CATEGORIAID==$datosProducto[0]->CATEGORIAID){echo "selected";} ?>><?= $itemcategoria->CATEGORIA ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="estadoproducto" name="estadoproducto" <?= $datosProducto[0]->ESTADO2 ?>>
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