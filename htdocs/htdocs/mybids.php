<?php include_once("header.php")?>
<?php require("utilities.php")?>

<div class="container">

<h2 class="my-3">My bids</h2>

<?php
  // This page is for showing a user the auctions they've bid on.
  // It will be pretty similar to browse.php, except there is no search bar.
  // This can be started after browse.php is working with a database.
  // Feel free to extract out useful functions from browse.php and put them in
  // the shared "utilities.php" where they can be shared by multiple files.
  
  
  // TODO: Check user's credentials (cookie/session).
  // 检查用户是否已登录
  if (!isset($_SESSION['userId'])) {
    // 如果用户未登录，显示消息并退出
    echo "<p>You must log in to view your bids.</p>";
    include_once("footer.php");
    exit();
}
  // TODO: Perform a query to pull up the auctions they've bidded on.
  // 连接到数据库
  require_once("db_config.php");
  // 执行查询以拉取用户出价的拍卖
  $userId = $_SESSION['userId'];
  $sql = "SELECT a.itemName, a.endTime, b.bidPrice FROM auction a JOIN bid b ON a.auctionID = b.auctionID WHERE b.userID = $userId ORDER BY b.bidDate DESC";
  $result = $conn->query($sql);
    
  // TODO: Loop through results and print them out as list items.
    
  ?>


<?php include_once("footer.php")?>