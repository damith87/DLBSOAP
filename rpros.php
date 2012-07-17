<?php
function rpros($lottertyId,$lotteryDate,$drawNumber)
{
require_once("config/dbase.php");
$test=new database;

if (empty($lotteryDate) && empty($drawNumber))
{
$row=$test->querySR("
select * from janajayaresult
order by resdate desc
LIMIT 1
");
}
elseif(empty($lotteryDate))
{
$row=$test->querySR("
select * from janajayaresult
where lno=".$drawNumber);
}
elseif(empty($drawNumber))
{
$row=$test->querySR("
SELECT * FROM `janajayaresult`
where resdate='".$lotteryDate."'
LIMIT 1");
}
else return "Unable to process your request";


	


if ($test->error=="E-x000" && $test->count==1)
{
	return "Lottery No: ".$row['lno']." Lottery Date: ".$row['resdate']."\nWinning numbers are ".$row["no1"]."-".$row["no2"]."-".$row["no3"]."-".$row["no4"]." and the bonus number is ".$row["bonus"].".";
}
elseif($test->count==0)
{
	return "Sorry! no results found.";
}
else
{
	return "Sorry! We are unable to process your request at this moment. Ref: ".$test->error;
}
}
?>