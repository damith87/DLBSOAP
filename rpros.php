<?php
function rpros($lottertyId,$lotteryDate,$drawNumber)
{
require_once("config/dbase.php");
$test=new database;
$type="janajayaresult"; //Fail Safe Default table
   switch (strtoupper($lottertyId)) {
      case "JJ":
        $type="janajayaresult";
        break;
      case "JY":
        $type="jayodaresult";
        break;
      case "NJ":
        $type="niyathajayaresult";
        break;
      case "SF":
        $type="sanidawasanaresult";
      case "DF":
        $type="sanwardanawasanares";
        break;
      case "SB":
        $type="superballresult";
        break;
      default:
      return ("Sorry invalid lottery name '".$type."' please try again."); 
      } 

if (empty($lotteryDate) && empty($drawNumber))
{
$row=$test->querySR("
select * from ".$type." where status=1 
order by resdate desc
LIMIT 1
");
}
elseif(empty($lotteryDate))
{
$row=$test->querySR("
select * from ".$type."
where status=1 and lno=".$drawNumber);
}
elseif(empty($drawNumber))
{
$row=$test->querySR("
SELECT * FROM ".$type."
where status=1 and resdate='".$lotteryDate."'
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

