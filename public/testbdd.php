<h1>Test BDD</h1>
<?php
$DB_HOST="ct01.afpa-balma.fr";
$DB_PORT="3306";
$DB_DATABASE="td_projet_23530_test";
$DB_USERNAME="td_projet_23530_test";
$DB_PASSWORD="YgTu55mRrJcebxG0";
try{
$db = new PDO('mysql:host='.$DB_HOST.';port='.$DB_PORT.';dbname='.$DB_DATABASE, $DB_USERNAME, $DB_PASSWORD);
var_dump($db);
}
catch(Exception $e){
        echo $e->getMessage();
}
?>
