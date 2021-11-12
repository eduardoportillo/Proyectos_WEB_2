<?php
use App\models\dto\Cliente;
require_once "src/views/componentes/header.php";

/**
 * @var Cliente[] $listaCliente
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
                    <th>Nombres Completo</th>
                    <th>Telefono</th>
                    <th>Carnet</th>
                    <th>Género</th>
                    <th>Edad</th>
                    <th>Comprar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listaCliente as $objCliente): ?>
                    <tr>
                        <td><?php echo $objCliente->getIdCliente(); ?></td>
                        <td><?php echo $objCliente->getCodigo(); ?></td>
                        <td><?php echo $objCliente->getNombreCompleto(); ?></td>
                        <td><?php echo $objCliente->getTelefono(); ?></td>
                        <td><?php echo $objCliente->getCarnet(); ?></td>
                        <td><?php echo $objCliente->getGeneroForDisplay(); ?></td>
                        <td><?php echo $objCliente->getEdad(); ?></td>
                        <td>
                            <a href="index.php?cliente_id=<?php echo  $objCliente->getIdCliente() ?>&controller=venta&action=ventaproducto">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        </td>
                        <td><a class="btn btn-primary"
                               href="index.php?id_cliente=<?php echo $objCliente->getIdCliente() ?>&controller=cliente&action=edit">Editar</a>
                        </td>
                        <td>
                            <a class="btn btn-danger"
                               onclick="return confirm('¿Estas seguro de eliminar este cliente?')"
                               href="index.php?id_cliente=<?php echo  $objCliente->getIdCliente() ?>&controller=cliente&action=delete">Eliminar</a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
