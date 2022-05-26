<div class="tablas">
    <h2 class="titulo">PRODUCTOS</h2>
    <?= $data ?>
    <?php if($tipousuario==1): ?>
        <a class="btn btn-primary btnnuevo" href="Producto/vistaCrearProducto/" role="button">Nuevo</a>
    <?php endif; ?>
</div>