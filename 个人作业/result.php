<html>
<head>
</head>
<body>
<?php

$dbhost = 'localhost';  //mysql服务器主机地址
$dbuser = 'root';      //mysql用户名
$dbpass = '';//mysql用户名密码

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
	if(! $conn )
	{
		die('Could not connect: ' . mysqli_error());
	}
mysqli_select_db( $conn,"stiterm" );
mysqli_query($conn,"set names 'utf8'");

$getting = $_POST['inputing'];


mysqli_select_db( $conn,"searchingweb" );
mysqli_query($conn,"set names 'utf8'");

$sql = "SELECT * FROM chineseweb WHERE passage REGEXP '$getting'";
$huoqu = mysqli_query($conn, $sql);

echo "<table border='1'; align='center'><tr><th><span>结果</span></th></tr>";

while ($row = mysqli_fetch_array($huoqu, MYSQLI_ASSOC)) {
	echo "<tr>";
	echo "<td>".$row['passage']."</td>";
	echo "</tr>";
}
mysqli_close($conn);
?>
</body>
</html>