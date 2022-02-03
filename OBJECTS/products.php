<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-26      Created products class
#  
require_once 'connection.php';
require_once 'collection.php';
require_once 'product.php';

class products extends collection
{
    function __construct() {
        global $connection;
        $sqlQuery = "CALL select_all_products;";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->execute();
        
        while ($row = $PDOStatment->fetch()){
            $product = new product($row["product_uuid"], $row["product_code"], 
                    $row["product_description"], $row["product_price"], 
                    $row["product_cost_price"], $row["create_date"], 
                    $row["last_update_date"]);
            $this->add($row["product_uuid"], $product);

        }
    }
}