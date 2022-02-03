<?php

#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-26      Created product class
#                                   


require_once 'connection.php';

class product{
    private $product_uuid = "";
    private $product_code = "";
    private $product_description = "";
    private $product_price = 0;
    private $product_cost_price = 0;
    private $create_date = "";
    private $last_update_date = "";
    
    function __construct($product_uuid = "", $product_code = "", $product_description = "", $product_price = 0, $product_cost_price = 0) 
   {
       //Passing parameters to their setters for verification and setting them
       //to this object
       if ($product_code != ""){
       $this->setProductUuid($product_uuid);
       $this->setProductCode($product_code);
       $this->setProductDescription($product_description);
       $this->setProductPrice($product_price);
       $this->setProductCostPrice($product_cost_price);
       }
    }
    
     function load($product_uuid)
     {
        global $connection;
        
        $sqlQuery = "CALL select_one_product(:product_uuid);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":product_uuid", $product_uuid);
        $PDOStatment->execute();
        
        if ($row = $PDOStatment->fetch()){
            $this->product_uuid = $row["product_uuid"];
            $this->product_code = $row["product_code"];
            $this->product_description = $row["product_description"];
            $this->product_price = $row["product_price"];
            $this->product_cost_price = $row["product_cost_price"];
            $this->create_date = $row["create_date"];
            $this->last_update_date = $row["last_update_date"];     
            return true;
        }
        
    } 
     function save()
    {
        global $connection;
  
        $sqlQuery = "CALL insert_prdouct(:product_code, :product_description, :product_price, :product_cost_price);";
        $PDOStatment = $connection->prepare($sqlQuery);

        $PDOStatment->bindparam(":product_code", $this->product_code);
        $PDOStatment->bindparam(":product_description", $this->product_description);
        $PDOStatment->bindparam(":product_price", $this->product_price);
        $PDOStatment->bindparam(":product_cost_price", $this->product_cost_price);
        $PDOStatment->execute();
        return true;  


    }
    function delete($product_uuid)
    {
        global $connection;
        $sqlQuery = "CALL delete_product(:product_uuid);";
        $PDOStatment = $connection->prepare($sqlQuery);
        
        $PDOStatment->bindparam(":product_uuid", $product_uuid);
        $PDOStatment->execute();
        
    }
    
    //Setters
    public function setProductUuid($product_uuid)
    {
          $this->product_uuid = $product_uuid;  
    }
    public function setProductCode($product_code)
    {
          $this->product_code = $product_code;  
    }
    public function setProductDescription($product_description)
    {
          $this->product_description = $product_description;  
    }
    public function setProductPrice($product_price)
    {
        if (is_numeric($product_price) && $product_price > 0 && $product_price < PRODUCT_PRICE_MAX_VALUE)
        {
          $this->product_price = $product_price;  
        }
    }
    public function setProductCostPrice($product_cost_price)
    {
        //if we do not enter a cost price set the value to ""
        if ($product_cost_price == "" || $product_cost_price == null){
            $this->product_cost_price = "";
        }
        else if (is_numeric($product_cost_price) && $product_cost_price > 0 && $product_cost_price < PRODUCT_COST_MAX_VALUE)
        {
          $this->product_cost_price = $product_cost_price;  
        }
    }
     public function setCreateDate($create_date)
    {
          $this->create_date = $create_date;  
    }
    public function setLastUpdateDate($last_update_date)
    {
          $this->last_update_date = $last_update_date;  
    } 
    
    //Getters
    public function getProductUuid(){
        return $this->product_uuid; 
    }
    public function getProductCode(){
        return $this->product_code; 
    }
    public function getProductDescription(){
        return $this->product_description; 
    }
     public function getProductPrice(){
        return $this->product_price; 
    }
     public function getProductCostPrice(){
        return $this->product_cost_price; 
    }
     public function getCreateDate(){
        return $this->create_date; 
    }
     public function getLastUpdateDate(){
        return $this->last_update_date; 
    }
    
    
    
    
}
