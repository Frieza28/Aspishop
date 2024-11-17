<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // ligaçã base de dados
    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);
    if ($db) {

        // criar query numa string
        $query = "SELECT c.name as cat_id, p.id, p.name, p.description, p.price, p.old_price, p.image, p.visible FROM products as p inner join categories as c on (p.cat_id = c.id)";

        // Verificar se o parâmetro cat_id foi fornecido na requisição
        $categoryId = isset($_GET['cat_id']) ? mysqli_real_escape_string($db, $_GET['cat_id']) : null;

        // Adicionar cláusula WHERE apenas se cat_id for igual a '3'
        if ($categoryId === '3') {
            $query .= " WHERE p.old_price IS NOT NULL";
        } elseif ($categoryId !== null) {
            $query .= " WHERE c.id = '$categoryId'";
        }

        // executar a query
        if (!($result = @mysqli_query($db, $query)))
            showerror($db);

        // vai buscar o resultado da query

        $nrows = mysqli_num_rows($result);
        $products = [];
        for ($i = 0; $i < $nrows; $i++)
            $products[$i] = mysqli_fetch_assoc($result);

        // allow cross-origin requests (CORS)
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
        // convert to JSON
        $productsJSON = json_encode(utf8ize($products));
        echo $productsJSON;

        // fechar a ligaçãbase de dados
        mysqli_close($db);
    } // end if
}

// allow cross-origin requests (CORS)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Authorization, Origin, User-Token, X-Requested-With, Content-Type");
}

function utf8ize($d)
{
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_object($d)) {
        foreach ($d as $k => $v) {
            $d->$k = utf8ize($v);
        }
    } else if (is_string($d)) {
        return utf8_encode($d);
    }
    return $d;
}
?>
