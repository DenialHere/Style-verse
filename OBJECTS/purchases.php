<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-26      Created products class
#Danial Gosse       2021-04-30      Updated the constructor
#  
require_once 'connection.php';
require_once 'collection.php';
require_once 'customer.php';
require_once 'purchase.php';
require_once 'products.php';
require_once 'product.php';

class purchases extends collection
{
    function __construct($customer_uuid, $date = "") 
    {
        global $connection;
        $sqlQuery = "CALL filter_purchase(:customer_uuid, :date);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":customer_uuid", $customer_uuid);
        $PDOStatment->bindparam(":date", $date);
        $PDOStatment->execute();
        
        while($row = $PDOStatment->fetch()){
            $purchase = new purchase($row["purchase_uuid"],$row["customer_uuid"],  $row["product_uuid"], $row["purchase_quantity"], $row["comments"],
                    $row["subtotal"], $row["tax_amount"], $row["grand_total"]);
            $this->add($row["purchase_uuid"], $purchase);
            

        }    

    }
    
} 
