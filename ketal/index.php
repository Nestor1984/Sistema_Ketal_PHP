<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ketal</title>
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <section id='content-menu'>
            <h1>Menú principal</h1>

            <nav>
                <ul>
                    <li class='transicion'>
                        <a href="./index.php?page=articulo">
                            <img src="./assets/icons/icon-articulo.png" alt="Artículo">
                            <span>Artículo</span>
                        </a>
                    </li>
                    <li class='transicion'>
                        <a href="./index.php?page=cliente">
                            <img src="./assets/icons/icon-cliente.png" alt="Cliente">    
                            <span>Cliente</span>
                        </a>
                    </li>
                    <li class='transicion'>
                        <a href="./index.php?page=proveedor">
                            <img src="./assets/icons/icon-proveedor.png" alt="Proveedor">    
                            <span>Proveedor</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <section id='content-logo'>
                <img src="./assets/icons/icon-logo.png" alt="Logo" />
            </section>
        </section>

        <section id='content-pages'>
            <?php
                if (empty($_GET['page']))
                    include "./pages/home/home.php";
                else
                    include "./pages/{$_GET['page']}/{$_GET['page']}.php";
            ?>
        </section>
    </body>
</html>