<?php
	session_start();

//Connect to the booksales database
	$connection = mysqli_connect("localhost", "root", "", "booksales");
	if (!$connection) {
		echo "Cannot connect to MySQL. ", mysqli_connect_error($connection);
		exit();
	}
//Get records from the Books table
 	$query = "SELECT * From books ORDER BY book_isbn";
	$result = mysqli_query($connection, $query);
	if (!$result) {
		echo "Select from books failed. ", mysqli_error($connection);
		exit();
	}
//Inialize the session variables
	$_SESSION["onfile"] = NULL;
	$_SESSION["shop"] = NULL
?>

<!DOCTYPE html>
<html>
   <head>
   		<meta charset="utf-8">
		<title>Book List and Selection</title>
		<link rel= "stylesheet" type= "text/css" href= "/booksales/booksales.css"/>
		<script language="JavaScript" type= "text/javascript"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
			   <h1 id="logo"><img src="/booksales/quicksteps_logo17.jpg"/>  QuickSteps Books</h1>
			   <h1 id="title">Book Selection and Sales</h1>

			</div> <!-- id="header" -->
			<div id="hnav">
				<table width="400" border="0" cellspacing="2" cellpadding="2">
  				  <tr>
			        <td><a href="/booksales/index.php">Home</a> </td>
			        <td><a href="/booksales/index.php">About</a> </td>
			        <td><a href="/booksales/index.php">Support</a> </td>
			        <td><a href="/booksales/index.php">Maintain</a> </td>
  		    	  </tr>
				</table>

			</div> <!-- id="hnav" -->

			<div id="main">
				<h1 id="maintitle">Books List</h1>
				<p id="mainpara">Choose a book and click Purchase.</p>

				<!-- Book List -->
				<table width="850" border="1" frame="void" rules="all" cellspacing="1" cellpadding="2">
					<!-- Display the column headings -->
				    <tr>
				        <th class="list" width="180">Book Cover</th>
						<th class="list" width="40">Book ISBN</th>
				        <th class="list" width="150">Book Title</th>
						<th class="list" width="80">Book Author</th>
				        <th class="list" width="340">Book Description</th>
						<th class="list" width="20">Book Price</th>
						<th class="list" width="40">&nbsp</th>
				   </tr>

				   <!-- Loop through and display the books (first Book retrieved above). -->
				   <?php while ( $bookrow = mysqli_fetch_assoc($result) ) {  ?>

				   <tr>
						<td><img src="<?php echo $bookrow ['book_image']; ?>" width="140" height="112"></td>
				   		<td align="center"><?php echo $bookrow ['book_isbn']; ?></td>
						<td><?php echo $bookrow ['book_title']; ?></td>
						<td><?php echo $bookrow ['book_author']; ?></td>
						<td><?php echo $bookrow ['book_descr']; ?> &nbsp </td>
						<td align="right">$<?php echo number_format($bookrow ['book_price'],0,'.',','); ?>&nbsp</td>
						<td><a href="signin.php?bookisbn=<?php echo $bookrow ['book_isbn']; ?>">Purchase</a></td>
				   </tr>
			   	   <?php } ?>
			</table>

				<p class="red">&nbsp</p>
			</div> <!-- id="main" -->
			<div id="footer">
				<p id="copyright">
					Copyright &copy:2008 -
					<?php
						 date_default_timezone_set('America/Vancouver');
						 echo date('Y');
					?>
					Matthews Technology
				</p>
				<p id="contact">
					 <a href="mailto:info@matthewstechnology.com">Contact us by clicking here.</a>
				</p>
			</div> <!-- id="footer" -->
		</div> <!-- id="wrapper" -->
	</body>
</html>

