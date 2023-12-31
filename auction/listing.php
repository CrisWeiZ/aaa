<?php include_once("header.php")?>
<?php require("utilities.php")?>

<?php
  // Connect to the database first
$con = mysqli_connect('localhost', 'panisa', '987654', 'Fashionswap');
if (!$con) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}

$item_id = $_GET['item_id'];
$query = "SELECT Auction.*, Count_Bid.numBid
          FROM Auction 
          LEFT JOIN (SELECT auctionID, COUNT(1) as numBid FROM Bid GROUP BY auctionID) Count_Bid 
          ON Auction.auctionID = Count_Bid.auctionID
          WHERE Auction.auctionID = '$item_id'";

// Execute the query
$result = mysqli_query($con, $query);
if (!$result) {
    die('Error making select user query: ' . mysqli_error($con));
}

// Fetch the results
$row = mysqli_fetch_array($result);
$item_id = $row['auctionID'];
$title = $row['itemName'];
$description = $row['details'];
$current_price = $row['startPrice'];
$num_bids = isset($row['numBid']) ? $row['numBid'] : 0;
$end_time = $row['endTime'];


// This uses a function defined in utilities.php
print_listing_li($item_id, $title, $description, $current_price, $num_bids, $end_time);


// Close the database connection
mysqli_close($con);

  // TODO: Note: Auctions that have ended may pull a different set of data,
  //       like whether the auction ended in a sale or was cancelled due
  //       to lack of high-enough bids. Or maybe not.
  
  // Calculate time to auction end:
  $now = new DateTime();
  
  if ($now < $end_time) {
    $time_to_end = (date_diff($now, $end_time));
    $time_remaining = ' (in ' . display_time_remaining($time_to_end) . ')';
  }
  
  // TODO: If the user has a session, use it to make a query to the database
  //       to determine if the user is already watching this item.
  //       For now, this is hardcoded.
  $has_session = true;
  $watching = false;
?>

<?php
$con = mysqli_connect('localhost', 'panisa', '987654', 'Fashionswap');
if (!$con) {
    die('Error connecting to the database: ' . mysqli_connect_error());
}

$query = "SELECT Auction.*, COALESCE(MAX(Bid.bidPrice), 0) AS CurrentBidPrice
          FROM Auction 
          LEFT JOIN Bid
          ON Auction.auctionID = Bid.auctionID
          WHERE Auction.auctionID = '$item_id'
          GROUP BY Auction.auctionID";

$result = mysqli_query($con, $query);
if (!$result) {
    die('Error making select user query: ' . mysqli_error($con));
}

$auctions = [];

while($row = mysqli_fetch_array($result))
{
  $item_id = $row['auctionID'];
  $current_price = $row['CurrentBidPrice'];
  
}

mysqli_close($con);

?>

<div class="container">

<div class="row"> <!-- Row #1 with auction title + watch button -->
  <div class="col-sm-8"> <!-- Left col -->
    <h2 class="my-3"><?php echo($title); ?></h2>
  </div>
  <div class="col-sm-4 align-self-center"> <!-- Right col -->
<?php
  /* The following watchlist functionality uses JavaScript, but could
     just as easily use PHP as in other places in the code */
  if ($now < date_create($end_time)):
?>
    <div id="watch_nowatch" <?php if ($has_session && $watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-outline-secondary btn-sm" onclick="addToWatchlist()">+ Add to watchlist</button>
    </div>
    <div id="watch_watching" <?php if (!$has_session || !$watching) echo('style="display: none"');?> >
      <button type="button" class="btn btn-success btn-sm" disabled>Watching</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeFromWatchlist()">Remove watch</button>
    </div>
<?php endif /* Print nothing otherwise */ ?>
  </div>
</div>

<div class="row"> <!-- Row #2 with auction description + bidding info -->
  <div class="col-sm-8"> <!-- Left col with item info -->

    <div class="itemDescription">
    <?php echo($description); ?>
    </div>

  </div>

  <div class="col-sm-4"> <!-- Right col with bidding info -->

    <p>
    <?php 
    $end_time_obj = date_create($end_time);
    if ($now > $end_time_obj): ?>
        This auction ended <?php echo(date_format($end_time_obj, 'j M H:i')) ?>
        <!-- TODO: Print the result of the auction here? -->
    <?php else: ?>
        <!-- Auction ends in -->
        <?php 
        $time_to_end = date_diff($now, $end_time_obj);
        $time_remaining = display_time_remaining($time_to_end);
        ?>
        <p>Auction ends in <?php echo date_format($end_time_obj, 'j M H:i') . ' (' . $time_remaining . ')'; ?></p>
        <p class="lead">Current bid: £<?php echo(number_format($current_price, 2)); ?></p>

    <!-- Bidding form -->
    <form method="POST" action="place_bid.php">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">£</span>
        </div>
	    <input type="number" class="form-control" name= "bid" id="bid">
      </div>
      <button type="submit" class="btn btn-primary form-control">Place bid</button>
    </form>
<?php endif ?>

  
  </div> <!-- End of right col with bidding info -->

</div> <!-- End of row #2 -->






<?php include_once("footer.php")?>


<script> 
// JavaScript functions: addToWatchlist and removeFromWatchlist.

function addToWatchlist(button) {
  console.log("These print statements are helpful for debugging btw");

  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'add_to_watchlist', arguments: [<?php echo($item_id);?>]},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_nowatch").hide();
          $("#watch_watching").show();
        }
        else {
          var mydiv = document.getElementById("watch_nowatch");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Add to watch failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func

function removeFromWatchlist(button) {
  // This performs an asynchronous call to a PHP function using POST method.
  // Sends item ID as an argument to that function.
  $.ajax('watchlist_funcs.php', {
    type: "POST",
    data: {functionname: 'remove_from_watchlist', arguments: [<?php echo($item_id);?>]},

    success: 
      function (obj, textstatus) {
        // Callback function for when call is successful and returns obj
        console.log("Success");
        var objT = obj.trim();
 
        if (objT == "success") {
          $("#watch_watching").hide();
          $("#watch_nowatch").show();
        }
        else {
          var mydiv = document.getElementById("watch_watching");
          mydiv.appendChild(document.createElement("br"));
          mydiv.appendChild(document.createTextNode("Watch removal failed. Try again later."));
        }
      },

    error:
      function (obj, textstatus) {
        console.log("Error");
      }
  }); // End of AJAX call

} // End of addToWatchlist func
</script>