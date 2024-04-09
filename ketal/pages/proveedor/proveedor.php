<?php
    require './models/Proveedor.php';

    if (isset($_POST['guardar'])) {
        $proveedor = new Proveedor();
        $proveedor->setCodigo($_POST['codigo']);
        $proveedor->setNombre($_POST['nombre']);
        $proveedor->setCiudad($_POST['ciudad']);
        $proveedor->setPais($_POST['pais']);
        $res = $proveedor->guardar();
        if ($res) {
            $pageActual = $_SERVER['PHP_SELF'];
            header("refresh:0;url=$pageActual?page=proveedor");
        }
        else {
            echo '<span class="transaccion-error">El código ingresado ya existe</span>';
        }
    }
?>

<link rel="stylesheet" href="./pages/proveedor/proveedor.css">

<h1>Proveedor</h1>

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
        <span>* Ciudad</span>
        <input name='ciudad' class='transicion' placeholder='Ciudad...' type="text" required>
    </div>
    <div>
        <span>* País</span>
        <input name='pais' class='transicion' placeholder='País...' type="text" required>
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
            <td>Ciudad</td>
            <td>País</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $proveedor = new Proveedor();
            $proveedor = $proveedor->getList();
            foreach ($proveedor as $index => $row) {
                ++$index;
                echo "
                    <tr>
                        <td>$index</td>
                        <td>" . $row->getCodigo() . "</td>
                        <td>" . $row->getNombre() . "</td>
                        <td>" . $row->getCiudad() . "</td>
                        <td>" . $row->getPais() . "</td>
                    </tr>
                ";
            }
        ?>
    </tbody>
</table>
