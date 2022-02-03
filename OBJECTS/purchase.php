<?php

#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-26      Created purchase class
#Danial Gosse       2021-04-30      Added load function
#                                   
#Danial Gosse       2021-05-02      Fixed issues where it was accepting floats
#                                   as a valid quantity value

require_once 'connection.php';

class purchase{
    private $purchase_uuid = "";
    private $customer_uuid = "";
    private $product_uuid = "";
    private $purchase_quantity = 0;
    private $comments = "";
    private $subtotal = 0.00;
    private $tax_amount = 0.00;
    private $grand_total = 0.00;
    private $create_date = "";
    private $last_update_date = "";
    
    function __construct($purchase_uuid = "", $customer_uuid = "", $product_uuid = "", $purchase_quantity = 0, $comments = "", $subtotal = 0, $tax_amount = 0, $grand_total = 0) 
   {
       //Passing parameters to their setters for verification and setting them
       //to this object
       if ($purchase_quantity != 0){
       $this->setPurchaseUuid($purchase_uuid);
       $this->setCustomerUuid($customer_uuid);
       $this->setProductUuid($product_uuid);
       $this->setPurchaseQuantity($purchase_quantity);
       $this->setComments($comments);
       $this->setSubtotal($subtotal);
       $this->setTaxAmount($tax_amount);
       $this->setGrandTotal($grand_total);
       
       }
    }
    
    function save()
    {
        global $connection;
  
        $sqlQuery = "CALL insert_purchase(:customer_uuid, :product_uuid, :purchase_quantity, :comments, :subtotal, :tax_amount, :grand_total);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":customer_uuid", $this->customer_uuid);
        $PDOStatment->bindparam(":product_uuid", $this->product_uuid);
        $PDOStatment->bindparam(":purchase_quantity", $this->purchase_quantity);
        $PDOStatment->bindparam(":comments", $this->comments);
        $PDOStatment->bindparam(":subtotal", $this->subtotal);
        $PDOStatment->bindparam(":tax_amount", $this->tax_amount);
        $PDOStatment->bindparam(":grand_total", $this->grand_total);
        $PDOStatment->execute();
        return true;  


    }
    function load($purchase_uuid)
     {
        global $connection;
        
        $sqlQuery = "CALL select_one_purchase(:purchase_uuid);";
        $PDOStatment = $connection->prepare($sqlQuery);
        $PDOStatment->bindparam(":purchase_uuid", $purchase_uuid);
        $PDOStatment->execute();
        
        if ($row = $PDOStatment->fetch()){
            $this->purchase_uuid = $row["purchase_uuid"];
            $this->customer_uuid = $row["customer_uuid"];
            $this->product_uuid = $row["product_uuid"];
            $this->purchase_quantity = $row["purchase_quantity"];
            $this->comments = $row["comments"];
            $this->subtotal = $row["subtotal"];
            $this->tax_amount = $row["tax_amount"];     
            $this->grand_total = $row["grand_total"];
            return true;
        }
     }
     
    function delete($purchase_uuid)
    {
        global $connection;
        $sqlQuery = "CALL delete_purchase(:purchase_uuid);";
        $PDOStatment = $connection->prepare($sqlQuery);
        
        $PDOStatment->bindparam(":purchase_uuid", $purchase_uuid);
        $PDOStatment->execute();
        
    }
    
    //Setters
    //We dont have to validate the setters for uuids because sql generates them
    //for us
    //Error messages are sent on the page itself
    public function setPurchaseUuid($purchase_uuid)
    {
            $this->purchase_uuid = $purchase_uuid;  
    }
    public function setCustomerUuid($customer_uuid)
    {
          $this->customer_uuid = $customer_uuid;  
        
    }
    public function setProductUuid($product_uuid)
    {
          $this->product_uuid = $product_uuid; 
        
    }
    public function setPurchaseQuantity($purchase_quantity)
    {
        if($purchase_quantity < QUANTITY_MAX_VALUE && $purchase_quantity > 0 && floor($purchase_quantity) == $purchase_quantity)
        {
          $this->purchase_quantity = $purchase_quantity;  
        }
    }
    public function setComments($comments)
    {
        if(mb_strlen($comments) <= COMMENT_MAX_LENGTH)
        {
          $this->comments = $comments;  
        }
    }
    public function setSubtotal($subtotal)
    {
          $this->subtotal = $subtotal;  
    } 
    public function setTaxAmount($tax_amount)
    {
          $this->tax_amount = $tax_amount;  
    }
    public function setGrandTotal($grand_total)
    {
          $this->grand_total = $grand_total;  
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
    public function getPurchaseUuid(){
        return $this->purchase_uuid; 
    }
    public function getCustomerUuid(){
        return $this->customer_uuid; 
    }
    public function getComments(){
        return $this->comments; 
    }
    public function getSubtotal(){
        return $this->subtotal; 
    }
    public function getTaxAmount(){
        return $this->tax_amount; 
    }
    public function getGrandTotal(){
        return $this->grand_total; 
    }
     public function getPurchaseQuantity(){
        return $this->purchase_quantity; 
    }
    public function getCreateDate(){
          return $this->create_date; 
    }
    public function getLastUpdateDate(){
          return $this->last_update_date; 
    }
    
}