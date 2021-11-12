<?php

use App\models\dto\Cliente;

require_once "src/views/componentes/header.php";

use \App\controllers\ProductoController;

$productoContoller = new ProductoController();

$allProducts = $productoContoller->selecAllProductos();

$ProdctoArrayString = "";

?>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-4">
            <form method="POST" action="index.php">
                <input type="hidden" name="cliente_id" value="<?php echo $_GET['cliente_id'] ?>"/>
                <input type="hidden" name="controller" value="venta"/>
                <input type="hidden" name="action" value="insert"/>


                <div class="mb-3">
                    <div>
                        <h1>Productos:</h1>
                    </div>
                    <div class="containerVentas">
                        <?php foreach ($allProducts as $objProducto): ?>
                            <input type="checkbox" name="productosVentaArray[]"
                                   value="<?php echo $objProducto->getProductoId(); ?>"/> <?php echo $objProducto->getNombreProducto(); ?>
                            <br/>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="mb-3">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">
                        Comprar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
</body>


