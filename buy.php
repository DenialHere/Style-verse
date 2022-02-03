<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-02-28      Created the page
#Danial Gosse       2021-03-03      added the buy function
#Danial Gosse       2021-03-10      Updated generate html function to support
#                                   new argument
#Danial Gosse       2021-04-26      rewrote buy page to support new requirements
#
#Danial Gosse       2021-04-30      Fixed issues that occured after updating
#                                   the orders page
#Danial Gosse       2021-05-02      Fixed issues where it was accepting floats
#                                   as a valid quantity value
#                                   
#                                   
      //Defining constants of folder/file locations
      define("FOLDER_PHP", "PHP/");
      define("FOLDER_CSS", "CSS/");

      define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");
      require_once FILE_PHP_FUNCTIONS;

      //Generating starting HTML
      generateHtml("Buy", "style.css", "");
      
      //if the user is logged in show buy form
      if (isset(($_SESSION["customer_uuid"]))){
      //Creating new products object
      $products = new products();
      //Setting error messages to null
      $errorProductUuid = null;
      $errorComment = null;
      $errorQuantity = null;
      $errorQuantity = null;
      
      //if the user clicks on buy
      if (isset(($_POST["buy"]))){
          if (isset(($_POST["product"]))){
              //protect user entered data from injection
              $productUuid =  trim(htmlspecialchars($_POST["product"]));
              $PurchaseQuantity =  trim(htmlspecialchars($_POST["quantity"]));
              $comment = trim(htmlspecialchars($_POST["comments"]));
            //Validation
            if ($productUuid == ""){
                //Saving error message to be displayed later
                $errorProductUuid = "The product code cannot be empty. ";
            }
            if (mb_strlen($comment) >  COMMENT_MAX_LENGTH){
                //Saving error message to be displayed later
                $errorComment = "The maximum length of comments is 200 characters. ";
            }
            if (!is_numeric($PurchaseQuantity) ||  floor($PurchaseQuantity) != $PurchaseQuantity || $PurchaseQuantity <= 0 || $PurchaseQuantity > QUANTITY_MAX_VALUE){
                //Saving error message to be displayed later
                $errorQuantity = "The quantity must be greater than 0, less than 100 and not be a decimal.";
            }
            if($errorProductUuid == null && $errorComment == null && $errorQuantity == null) {
                //If all validation passes create a new product object
                $product = new product();
                //Load the product
                $product->load($productUuid);
                //Get the price of the product to be used for calculations
                $price = $product->getProductPrice();
                //Calculating all totals and rounding them
                $subtotal = round(($price * $PurchaseQuantity), 2);
                $taxes = round((($price * $PurchaseQuantity) * TAX_RATE - $subtotal), 2);
                $total = round(($price * $PurchaseQuantity) * TAX_RATE, 2);
                //Creating a new purchase object and saving all the data we got
                $purchase = new purchase("", $_SESSION["customer_uuid"], $productUuid, $PurchaseQuantity, $comment, $subtotal , $taxes, $total);
                $purchase->save();
                //redirecting to the orders page
                header("location:orders.php");
            }      
          }
      }
      ?>

    <h2 class="center">Choose a product:</h2>
    <div class="mar-top just-cent">
        <form class="buy-grid grid" method="post" action="buy.php">
              <label class="">Product code: <span class="red">*</span></label>
              <select name="product" class="mar-btm">  
    <?php
      //Grabbing each item in our product table and placing them in a select
      foreach($products->items as $product){ 
        echo '<option value="' . $product->getProductUuid() . '">' . $product->getProductCode() . " - " . $product->getProductDescription() . " (" . $product->getProductPrice() . '$) ' .'</option>';
        }
        ?>
            </select>
                <span class="red mar-btm mar-top">
                <?php
                //Display error if one exists
                if (isset($errorProductUuid)){
                   echo '</br>'. $errorProductUuid; 
                }
                ?>
                </span>
              <br />
              <label class="">Comments:</label>
              <input class="mar-btm" type="text" name="comments" value="<?php if (isset($comment)){ echo $comment;} ?>">
               <span class="red">
                <?php
                //Display error if one exists
                if (isset($errorComment)){
                   echo '<br />'. $errorComment; 
                }
                ?>
                </span>
              <br />
              <label class="">Quantity: <span class="red">*</span></label>
              <input class="" type="text" name="quantity" value="<?php if (isset($PurchaseQuantity)){ echo $PurchaseQuantity;} ?>">
              <span class="red grid" >
              <?php
                //Display error if one exists
                if (isset($errorQuantity)){
                   echo '<br />'. $errorQuantity; 
                }
                ?>
              </span>
              <br />
              <input class="btn-buy mar-btm" type="submit" value="Buy" name="buy">
          </form>
    </div>
<?php
      }
      else {
          //If the user is not logged in display a login form
          ?>
        <h1 class="center">Please login to make a purchase</h1>
          <?php
          generateLogin();
      }
      
      
      endHtml();
?>