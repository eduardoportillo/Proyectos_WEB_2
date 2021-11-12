<?php

use App\models\bll\ProductoBLL;
use \App\models\dto\venta;

require_once "src/views/componentes/header.php";
/**
 * @var venta[] $listaVentas ;
 */

$productoBLL = new ProductoBLL();

?>
<div class="container">
    <div class="row mt-3">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Cliente</th>
                    <th>Productos</th>
                    <th>Monto</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listaVentas as $objVenta): ?>
                    <tr>
                        <td><?php echo $objVenta->getIdVenta(); ?></td>
                        <td><?php echo $objVenta->getClienteForDisplay(); ?></td>
                        <td>
                            <select class="form-select">

                                <?php foreach ($listaVentas as $ventas):
                                $arrayProductos = explode(",", $ventas->getProductos());
                                for ($i = 0; $i < count($arrayProductos); $i++) {
                                ?>
                                    <option>  <?php echo $productoBLL->select($arrayProductos[$i])->getNombreProducto(); ?></option>
                                <?php }
                                endforeach; ?>

                            </select>
                        </td>
                        <td><?php echo $objVenta->getMonto(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
            <!--       Pruebas       -->
            <?php foreach ($listaVentas as $ventas): ?>
                <?php
                $arrayProductos = explode(",", $ventas->getProductos());
                for ($i = 0; $i < count($arrayProductos); $i++) {
                    echo $productoBLL->select($arrayProductos[$i])->getNombreProducto();
                }
                ?>
                </br>
            <?php endforeach; ?>
            <!--       Pruebas       -->
        </div>
    </div>
</div>