<?php
#Revision history:
#DEVELOPER          DATE            COMMENTS         
#Danial Gosse       2021-02-28      Created the page.
#
#Danial Gosse       2021-03-03      Added constants for images
#
#Danial Gosse       2021-03-09      Added additonal comments
#
#Danial Gosse       2021-03-10      Fixed malformed html
#
#Danial Gosse       2021-04-21      Added requirements to customer objects
#

      //Defining constants of folder/file locations
      define("FOLDER_PHP", "PHP/");
      define("FOLDER_CSS", "CSS/");
      define("FILE_PHP_FUNCTIONS", FOLDER_PHP . "PHP-functions.php");
      require_once FILE_PHP_FUNCTIONS;
      
      //Generating starting HTML
      generateHtml("Home", "style.css", "");
      //Generating a random number from 1-5 to determine which ad will be shown
      $ad = rand(1,5);
      
?>

    <div class="container-home grid just-cent border">
        <img class="fashion_pic" src="<?php echo FOLDER_IMAGES ?>fashion_1.jpg" alt="Fashion model 1"/>
        <h1 class="center">At style verse style comes first
            <p class="text">
            We take pride in not only making the most stylish clothes, but also the most comfortable. 
            We source the the highest quality fabrics so you not only look great in our clothes but also feel just as great.
            </p>
        </h1>
        <img class="fashion_pic" src="<?php echo FOLDER_IMAGES ?>fashion_2.jpg" alt="Fashion model 2"/>
        
    </div>

    <?php
    //Generating a random ad
    generateAd($ad);
    //Ending Html
    endHtml();


