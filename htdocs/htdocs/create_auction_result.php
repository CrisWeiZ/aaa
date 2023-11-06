<?php include_once("header.php")?>


<div class="container my-5">

<?php

// This function takes the form data and adds the new auction to the database.

/* TODO #1: Connect to MySQL database (perhaps by requiring a file that
            already does this). */

            require_once("db_config.php"); //db_config.php already dose this


/* TODO #2: Extract form data into variables. Because the form was a 'post'
            form, its data can be accessed via $POST['auctionTitle'], 
            $POST['auctionDetails'], etc. Perform checking on the data to
            make sure it can be inserted into the database. If there is an
            issue, give some semi-helpful feedback to user. */
            
        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Extract and sanitize form data
            $title = mysqli_real_escape_string($connection, trim($_POST['title']));
            $details = mysqli_real_escape_string($connection, trim($_POST['details']));
            $category = mysqli_real_escape_string($connection, trim($_POST['category']));
            $start_price = mysqli_real_escape_string($connection, trim($_POST['start_price']));
            $reserve_price = isset($_POST['reserve_price']) && !empty($_POST['reserve_price']) ? mysqli_real_escape_string($connection, trim($_POST['reserve_price'])) : NULL;
            $end_date = mysqli_real_escape_string($connection, trim($_POST['end_date']));
        //使用 mysqli_real_escape_string 函数来清洗输入数据，以防止 SQL 注入攻击。
        //使用 trim 函数来去除用户输入的前后空白字符。
            
        // Initialize an array to store potential errors
            $errors = [];

        // Validate the input data
            if (empty($title)) {
                $errors[] = "The title of the auction cannot be empty.";
            }
            if (empty($details)) {
                $errors[] = "The details of the auction cannot be empty.";
            }
            if ($category == "Choose...") {
                $errors[] = "Please select a category for the auction.";
            }
            if (!is_numeric($start_price) || floatval($start_price) <= 0) {
                $errors[] = "The starting price must be a positive number.";
            }
            if ($reserve_price !== NULL && (!is_numeric($reserve_price) || floatval($reserve_price) <= 0)) {
                $errors[] = "The reserve price must be a positive number if provided.";
            }
            if (empty($end_date)) {
                $errors[] = "The end date of the auction cannot be empty.";
            } else {
                $end_date_time = strtotime($end_date);
                if ($end_date_time === false) {
                    $errors[] = "The end date format is invalid.";
                } else if ($end_date_time < time()) {
                    $errors[] = "The end date must be set in the future.";
                }
            }
        
        
        }


/* TODO #3: If everything looks good, make the appropriate call to insert
            data into the database. */
        if (empty($errors)) {
            // 准备SQL插入语句
            $query = "INSERT INTO auctions (title, details, cName, startPrice, reservePrice, endTime) VALUES ('$title', '$details', '$category', $start_price, $reserve_price, '$end_date')";


            // 执行插入操作
            if (mysqli_query($connection, $query)) {
                // 获取新创建的拍卖的ID
                $auctionID = mysqli_insert_id($connection);

                // If all is successful, let user know.
                echo('<div class="text-center">Auction successfully created! <a href="mylistings.php?id=' . $new_auction_id . '">View your new listing.</a></div>');
            } else {
                // If the query failed, display or log the error information
                echo "Database error: " . mysqli_error($connection);
            }
        }



// Close the database connection
mysqli_close($connection);
        
?>

</div>


<?php include_once("footer.php")?>