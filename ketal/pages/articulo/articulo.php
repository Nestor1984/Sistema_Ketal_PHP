<?php 
    require './models/Articulo.php';

    if (isset($_POST['guardar'])) {
        $articulo = new Articulo();
        $articulo->setCodigo($_POST['codigo']);
        $articulo->setNombre($_POST['nombre']);
        $articulo->setPrecio((float)$_POST['precio']);
        $articulo->setFechaElaboracion($_POST['fecha_elaboracion']);
        $articulo->setFechaVencimiento($_POST['fecha_vencimiento']);
        $res = $articulo->guardar();
        if ($res) {
            $pageActual = $_SERVER['PHP_SELF'];
            header("refresh:0;url=$pageActual?page=articulo");
        }
        else {
            echo '<span class="transaccion-error">El código ingresado ya existe</span>';
        }
    }
?>

<link rel="stylesheet" href="./pages/articulo/articulo.css">

<h1>Artículo</h1>

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
        <span>* Precio</span>
        <input name='precio' class='transicion' placeholder='0.00' type="number" step="any" required>
    </div>
    <div>
        <span>* Fecha de elaboracion</span>
        <input name='fecha_elaboracion' class='transicion' placeholder='dd/mm/yyyy' type="date" required>
    </div>
    <div>
        <span>* Fecha de vencimiento</span>
        <input name='fecha_vencimiento' class='transicion' placeholder='dd/mm/yyyy' type="date" required>
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
            <td>Precio</td>
            <td>Fecha de elaboración</td>
            <td>Fecha de vencimiento</td>
        </tr>
    </thead>

    <tbody>
        <?php
            $articulo = new Articulo();
            $articulos = $articulo->getList();
            foreach ($articulos as $index => $row) {
                ++$index;
                echo "
                    <tr>
                        <td>$index</td>
                        <td>" . $row->getCodigo() . "</td>
                        <td>" . $row->getNombre() . "</td>
                        <td>" . $row->getPrecio() . "</td>
                        <td>" . $row->getFechaElaboracion() . "</td>
                        <td>" . $row->getFechaVencimiento() . "</td>
                    </tr>
                ";
            }
        ?>
    </tbody>
</table>
