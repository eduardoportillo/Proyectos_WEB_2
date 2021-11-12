<?php

use App\models\dto\Cliente;

require_once "src/views/componentes/header.php";

/**
 * @var Cliente $objCliente
 */
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-4">
            <form method="post" action="index.php">
                <input type="hidden" name="controller" value="cliente"/>
                <input type="hidden" name="action" value="<?php echo ($objCliente == null) ? "insert" : "update"; ?>"/>
                <input type="hidden" name="id_cliente"
                       value="<?php echo ($objCliente == null) ? "0" : $objCliente->getIdCliente(); ?>">

                <div class="mb-3">
                    <div>
                        <label>Nombres Completo:</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" name="nombre_completo"
                               value="<?php echo ($objCliente == null) ? "" : $objCliente->getNombreCompleto(); ?>"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <label>Telefono:</label>
                    </div>
                    <div>
                        <input class="form-control" type="number" name="telefono"
                               value="<?php echo ($objCliente == null) ? "" : $objCliente->getTelefono(); ?>"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <label>Carnet</label>
                    </div>
                    <div>
                        <input class="form-control" type="number" name="carnet"
                               value="<?php echo ($objCliente == null) ? "" : $objCliente->getCarnet(); ?>"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <label>Edad:</label>
                    </div>
                    <div>
                        <input class="form-control" type="number" name="edad"
                               value="<?php echo ($objCliente == null) ? "" : $objCliente->getEdad(); ?>"/>
                    </div>
                </div>
                <div class="mb-3">
                    <div>
                        <label>Género:</label>
                    </div>
                    <div>
                        <select class="form-select" name="sexo">
                            <option value="0" <?php echo ($objCliente != null && $objCliente->getSexo() == "0") ? " selected " : ""; ?>>
                                No definido
                            </option>
                            <option value="-1" <?php echo ($objCliente != null && $objCliente->getSexo() == "-1") ? " selected " : ""; ?>>
                                Femenino
                            </option>
                            <option value="1" <?php echo ($objCliente != null && $objCliente->getSexo() == "1") ? " selected " : ""; ?>>
                                Masculino
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                </div>
                <div class="mb-3">
                    <input class="btn btn-primary" type="submit" value="Guardar Datos"/>
                </div>
            </form>
        </div>
    </div>
</div>

