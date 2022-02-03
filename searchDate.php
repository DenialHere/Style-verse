<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-04-30      Made this page generate a table with the
#                                   list of all the purchases inside it
#Danial Gosse       2021-05-01      Commented code plus protected from sql inject
#                                   

//Defing constants
define("FOLDER_PHP", "PHP/");
define("FOLDER_CSS", "CSS/");
define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");

require_once FILE_PHP_FUNCTIONS;

header('Content-type: text/plain');

if(isset($_POST["year"]))
{   
    //Creating a new customer object and loading the current logged in user
    $customer = new customer();
    $customer->load($_POST["username"]);
    //saving the year and protecting from sql injection
    $searchedYear = htmlspecialchars($_POST["year"]);
    //Creating a new purchases object and passing the customer uuid and year
    $purchases = new purchases($customer->getUuid(), $searchedYear);
    
    //If there is more than 0 orders display the results
    if ($purchases->count() > 0){
    ?>
    <!--Generating table headers-->
    <table class="mar-btm">
                <tr>
                    <th>Delete:</th>
                    <th>Product code:</th>
                    <th>First Name:</th>
                    <th>Last Name:</th>
                    <th>City:</th>
                    <th>Comment:</th>
                    <th>Price:</th>
                    <th>Quantity:</th>
                    <th>Subtotal:</th>
                    <th>Taxes:</th>
                    <th>Grand total:</th>
                </tr>
    <?php
    
    
    foreach ($purchases->items as $purchase)
    {
        //Creating a new product and loading the product
        $product = new product();
        $product->load($purchase->getProductUuid());
        //Displaying the information of each purchase
        echo '<tr><td><form method="post" action="orders.php"> <input class="btn-buy mar-btm" type="submit" name="delete" value="Delete"> '
        . '<input type="hidden" name="purchaseUuid" value="' .$purchase->getPurchaseUuid() . '"> </form></td><td>' .
                $product->getProductCode() . '</td> <td>' . $customer->getFirstName() . '</td> <td>' . $customer->getLastName() . "</td> <td>". 
                $customer->getCity() . "</td><td>" . $purchase->getComments() . "</td><td>" . $product->getProductPrice() . "$ </td><td>" .
                $purchase->getPurchaseQuantity() . "</td><td>" . $purchase->getSubtotal() . "$ </td><td>" . $purchase->getTaxAmount() . "$ </td><td>" .
                $purchase->getGrandTotal() . "$</td></tr>";

    }
    //Closing the table
    echo "</table>";  
}
//If there is no orders display this message
else {
    ?>
                <h2> No orders yet :(</h2>
                <img src="<?php echo FOLDER_IMAGES . EMPTY_PICTURE; ?>" alt="Empty">
                <br>
                <a href="buy.php"><h2>Place an order now</h2></a>
    <?php
}
}
