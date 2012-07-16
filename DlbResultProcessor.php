<?php


function GetResultsFromDb($LotteryId,$LotteryDate,$LotteryDraw,$ApiAuthKey)
{
	if(empty($LotteryId) || empty($LotteryDate) || empty($LotteryDraw) || empty($ApiAuthKey))
	{
	return "Invalid Request. Please Try Again";
	}
	require_once("DlbDbConnector.php");
	$con=mysql_connect($server,$user,$pass);
	$db=mysql_select_db($db,$con);
	$sql="select * from janajayaresult where lno=".$LotteryId;
	$res=mysql_query($sql,$con);
	$count=mysql_num_rows($res);
	if (!$res)
	{
	return "Unable to process your request at this moment - x0001";
	}
	if($count==0)
	{
	return "Sorry No Results found";
	}
	else
	$row=mysql_fetch_assoc($res);
	return "Janajaya ".$row["lno"]." ".$row["resdate"]." Results: ".$row["no1"]."-".$row["no2"]."-".$row["no3"]."-".$row["no4"]." and the bonus number is ".$row["bonus"];
}


?>

