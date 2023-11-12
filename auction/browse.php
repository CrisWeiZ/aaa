<?php include_once("header.php")?>
<?php require("utilities.php")?>


<div class="container">

<h2 class="my-3">Browse listings</h2>




<div id="searchSpecs">
<!-- When this form is submitted, this PHP page is what processes it.
     Search/sort specs are passed to this page through parameters in the URL
     (GET method of passing data to a page). -->

<form method="get" action="browse.php">
  <div class="row">
    <div class="col-md-5 pr-0">
      <div class="form-group">
        <label for="keyword" class="sr-only">Search keyword:</label>
	    <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text bg-transparent pr-0 text-muted">
              <i class="fa fa-search"></i>
            </span>
          </div>
          <input type="text" value="<?= isset($_GET["keyword"]) ? $_GET["keyword"] : '' ?>" name="keyword" class="form-control border-left-0" id="keyword" placeholder="Search for anything">

          
        </div>
      </div>
    </div>
    <div class="col-md-3 pr-0">
          <div class="form-group">
              <label for="cat" class="sr-only">Search within:</label>
              <select class="form-control" name="cat" id="cat">
                  <option value="">All Categories</option>
                  <option value="Woman Tops" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Tops") echo "selected"; ?>>Woman Tops</option>
                  <option value="Woman Outerwears" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Outerwears") echo "selected"; ?>>Woman Outerwears</option>
                  <option value="Woman Pants and Jeans" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Pants and Jeans") echo "selected"; ?>>Woman Pants and Jeans</option>
                  <option value="Woman Dress and Jumpsuit" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Dress and Jumpsuit") echo "selected"; ?>>Woman Dress and Jumpsuits</option>
                  <option value="Woman Shoes" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Shoes") echo "selected"; ?>>Woman Shoes</option>
                  <option value="Woman Accessories" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Accessories") echo "selected"; ?>>Woman Accessories</option>
                  <option value="Woman Skirts" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Woman Skirts") echo "selected"; ?>>Woman Skirts</option>
                  <option value="Man Tops" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Man Tops") echo "selected"; ?>>Man Tops</option>
                  <option value="Man Outerwears" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Man Outerwears") echo "selected"; ?>>Man Outerwears</option>
                  <option value="Man Pants and Jeans" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Man Pants and Jeans") echo "selected"; ?>>Man Pants and Jeans</option>
                  <option value="Man Shoes" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Man Shoes") echo "selected"; ?>>Man Shoes</option>
                  <option value="Man Accessories" <?php if(isset($_GET["cat"]) && $_GET["cat"] == "Man Accessories") echo "selected"; ?>>Man Accessories</option>
              </select>
          </div>
    </div>
    <div class="col-md-3 pr-0">
      <div class="form-inline">
          <label class="mx-2" for="order_by">Sort by:</label>
          <select class="form-control" name="order_by" id="order_by">
              <option value="pricelow" <?= isset($_GET["order_by"]) && $_GET["order_by"] == "pricelow" ? "selected" : "" ?>>Price (low to high)</option>
              <option value="pricehigh" <?= isset($_GET["order_by"]) && $_GET["order_by"] == "pricehigh" ? "selected" : "" ?>>Price (high to low)</option>
              <option value="date" <?= isset($_GET["order_by"]) && $_GET["order_by"] == "date" ? "selected" : "" ?>>Soonest expiry</option>
          </select>
      </div>

    </div>
    <div class="col-md-1 px-0">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>
</form>
</div> <!-- end search specs bar -->


  


<?php
  // Retrieve these from the URL 
  // TODO: Define behavior if a keyword/category/order_by has not been specified.
  
  if (!isset($_GET['keyword'])) {
    echo '<p class="text-danger">*No keyword specified*</p>';
  }
  else {
    $keyword = $_GET['keyword'];
  }

  if (!isset($_GET['cat'])) {
    echo '<p class="text-danger">*No category specified*</p>';
  }
  else {
    $category = $_GET['cat'];
  }
  
  if (!isset($_GET['order_by'])) {
    echo '<p class="text-danger">*No ordering method specified*</p>';
  }
  else {
    $ordering = $_GET['order_by'];
  }
  
  if (!isset($_GET['page'])) {
    $curr_page = 1;
  }
  else {
    $curr_page = $_GET['page'];
  }



  /* TODO: Use above values to construct a query. Use this query to 
     retrieve data from the database. (If there is no form data entered,
     decide on appropriate default value/default query to make. */
  
  $results_per_page = 10; // for pagination
  $num_results = 0; // Initialize the counter, used later for pagination
  $offset = $results_per_page * ($curr_page-1); //for pagination
  $query = "SELECT Auction.*, Count_Bid.numBid
            FROM Auction 
            LEFT JOIN (select auctionID, count(1) as numBid from Bid group by auctionID) Count_Bid 
            ON Auction.auctionID = Count_Bid.auctionID WHERE 1=1";
  //Base queries: Left join Auction table and Count_Bid table (created to count no. of bid from Bid table)
  if(isset($keyword)) {
    $query = $query . " AND (Auction.itemName like '%$keyword%' OR Auction.details like '%$keyword%')";
  }

  if(isset($category) && $category != '') {
    $query = $query . " AND Auction.cName = '$category'";
  } 

  if(isset($ordering)) {
    if($ordering == 'pricehigh') {
      $query = $query . " ORDER BY Auction.startPrice DESC";
    }
    else if($ordering == 'pricelow') {
      $query = $query . " ORDER BY Auction.startPrice";
    }
    else if($ordering == 'date') {
      $query = $query . " ORDER BY AuctionendTime";
    }
    
  }
  //If statements to add additional queries depending on results from form

  
  $con = mysqli_connect('localhost', 'panisa', '987654', 'Fashionswap');
  $result = mysqli_query($con,$query)
  or die('Error making select user query'.mysqli_connect_error());

  $i = 1; //row counter to iterate through and assign page to it
  while ($row = mysqli_fetch_array($result))
  {   
      $num_results++; // Increment the counter for each row.
      if($i >= $offset+1 && $i <= $offset+$results_per_page) { //e.g. if($i >= 11 && $i <= 20)
        $item_id = $row['auctionID'];
        $title = $row['itemName'];
        $description = $row['details'];
        $current_price = $row['startPrice'];
        $num_bids = 0;
        if(isset($row['numBid'])) {
          $num_bids = $row['numBid'];
        }
        $end_date = $row['endTime'];
        // This uses a function defined in utilities.php
        print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date);
      }
      $i++;
      
  }
  
  // To show no matching result after searching
  if($num_results === 0){
    echo 'No matching result';
  }
   
  
  // TODO: Calculate me for real > $num_results incremented through while loop
  $max_page = ceil($num_results / $results_per_page);

  mysqli_close($con);


?>

<div class="container mt-5">

<!-- DONE ABOVE - TODO: If result set is empty, print an informative message. Otherwise... -->

<ul class="list-group">
<!-- DONE ABOVE- print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_date); -->
    
<!-- DONE ABOVE- TODO: Use a while loop to print a list item for each auction listing
     retrieved from the query -->


</ul>

<!-- Pagination for results listings -->
<nav aria-label="Search results pages" class="mt-5">
  <ul class="pagination justify-content-center">
  
<?php

  // Copy any currently-set GET variables to the URL.
  $querystring = "";
  foreach ($_GET as $key => $value) {
    if ($key != "page") {
      $querystring .= "$key=$value&amp;";
    }
  }
  
  $high_page_boost = max(3 - $curr_page, 0);
  $low_page_boost = max(2 - ($max_page - $curr_page), 0);
  $low_page = max(1, $curr_page - 2 - $low_page_boost);
  $high_page = min($max_page, $curr_page + 2 + $high_page_boost);
  
  if ($curr_page != 1) {
    echo('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page - 1) . '" aria-label="Previous">
        <span aria-hidden="true"><i class="fa fa-arrow-left"></i></span>
        <span class="sr-only">Previous</span>
      </a>
    </li>');
  }
    
  for ($i = $low_page; $i <= $high_page; $i++) {
    if ($i == $curr_page) {
      // Highlight the link
      echo('
    <li class="page-item active">');
    }
    else {
      // Non-highlighted link
      echo('
    <li class="page-item">');
    }
    
    // Do this in any case
    echo('
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . $i . '">' . $i . '</a>
    </li>');
  }
  
  if ($curr_page != $max_page) {
    echo('
    <li class="page-item">
      <a class="page-link" href="browse.php?' . $querystring . 'page=' . ($curr_page + 1) . '" aria-label="Next">
        <span aria-hidden="true"><i class="fa fa-arrow-right"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </li>');
  }
?>

  </ul>
</nav>


</div>



<?php include_once("footer.php")?>