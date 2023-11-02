<?php include_once("header.php")?>

<div class="container my-5">

<?php

// This function takes the form data and adds the new auction to the database.
$con=$mysqli_connect('localhost:8888','root','','Fashionswap')
    or die('Error connecting to MySQL server'.mysqlerror());
/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */
if(isset($POST['bidListForm'])){
   $auctionTitle = $_POST['auctionTitle']; 
   $insert="insert into 'Auction' (AuctionID) values ('$auctionTitle')";
   $result=mysqli_query($con,$insert);

  // if($result){

  // }
}

/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */


/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */
            

// If all is successful, let user know.
if($result){
echo('<div class="text-center">Auction successfully created! <a href="FIXME">View your new listing.</a></div>');
}

?>

</div>


<?php include_once("footer.php")?>