<?php
use App\models\dto\Producto;
require_once "src/views/componentes/header.php";

/**
 * @var Producto[] $listaProducto;
 */

?>
<div class="container">
    <div class="row mt-3">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Codigo</th>
                    <th>Nombres Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listaProducto as $objProducto): ?>
                    <tr>
                        <td><?php echo $objProducto->getProductoId(); ?></td>
                        <td><?php echo $objProducto->getCodigo(); ?></td>
                        <td><?php echo $objProducto->getNombreProducto(); ?></td>
                        <td><?php echo $objProducto->getDescripcion(); ?></td>
                        <td><?php echo $objProducto->getPrecio(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
