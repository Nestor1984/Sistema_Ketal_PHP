<?php
    require './models/Cliente.php';

    if (isset($_POST['guardar'])) {
        $cliente = new Cliente();
        $cliente->setCodigo($_POST['codigo']);
        $cliente->setNombre($_POST['nombre']);
        $cliente->setPaterno($_POST['paterno']);
        $cliente->setMaterno($_POST['materno']);
        $cliente->setDireccion($_POST['direccion']);
        $cliente->setTelefono((int)$_POST['telefono']);
        $cliente->setCorreo($_POST['correo']);
        $res = $cliente->guardar();
        if ($res) {
            $pageActual = $_SERVER['PHP_SELF'];
            header("refresh:0;url=$pageActual?page=cliente");
        }
        else {
            echo '<span class="transaccion-error">El código ingresado ya existe</span>';
        }
    }
?>

<link rel="stylesheet" href="./pages/cliente/cliente.css">

<h1>Cliente</h1>

<form action="" method='POST'>
    <div>
        <span>* Código</span>
        <input name='codigo' class='transicion' placeholder='Código...' type="text" required>
    </div>
    <div>
        <span>* Nombre</span>
        <input name='nombre' class='transicion' placeholder='Nombre...' type="text" required>
    </div>
    <div>
        <span>* Apellido paterno</span>
        <input name='paterno' class='transicion' placeholder='Apellido paterno...' type="text" required>
    </div>
    <div>
        <span>* Apellido materno</span>
        <input name='materno' class='transicion' placeholder='Apellido materno...' type="text" required>
    </div>
    <div>
        <span>* Dirección</span>
        <input name='direccion' class='transicion' placeholder='Dirección...' type="text" required>
    </div>
    <div>
        <span>* Teléfono</span>
        <input name='telefono' class='transicion' placeholder='Teléfono...' type="phone" required>
    </div>
    <div>
        <span>* Correo</span>
        <input name='correo' class='transicion' placeholder='Correo...' type="email" required>
    </div>

    <button name='guardar' class='transicion'>Guardar</button>
    <button type="reset" class='transicion'>Limpiar</button>
</form>

<table>
    <thead>
        <tr>
            <td>N°</td>
            <td>Código</td>
            <td>Nombre</td>
            <td>Paterno</td>
            <td>Materno</td>
            <td>Dirección</td>
            <td>Teléfono</td>
            <td>Correo</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $cliente = new Cliente();
            $cliente = $cliente->getList();
            foreach ($cliente as $index => $row) {
                ++$index;
                echo "
                    <tr>
                        <td>$index</td>
                        <td>" . $row->getCodigo() . "</td>
                        <td>" . $row->getNombre() . "</td>
                        <td>" . $row->getPaterno() . "</td>
                        <td>" . $row->getMaterno() . "</td>
                        <td>" . $row->getDireccion() . "</td>
                        <td>" . $row->getTelefono() . "</td>
                        <td>" . $row->getCorreo() . "</td>
                    </tr>
                ";
            }
        ?>
    </tbody>
</table>
