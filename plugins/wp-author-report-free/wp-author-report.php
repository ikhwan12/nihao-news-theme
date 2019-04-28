<?php
/*
Plugin Name: WP Author Report Free
Plugin URI: https://wpdeveloper.net/plugin/wp-author-report/
Description: WP Author Report is the only productivity plugin for WordPress which will generate detail report how authors are working.
Version: 1.0.7
License: GNU General Public License (GPL)
Author: WP Developer
Author URI: https://wpdeveloper.net/
Contributors: Asif2BD, oneTarek
Min WP Version: 2.5.0
Max WP Version: 4.8

*/


define("WPAR_PLUGIN_VERSION","1.0.7");
define("WPAR_PLUGIN_SLUG",plugin_basename( __FILE__ ));
define("WPAR_PLUGIN_URL",plugins_url("",__FILE__ ));#without trailing slash (/)
define("WPAR_PLUGIN_PATH",plugin_dir_path(__FILE__)); #with trailing slash (/)
define("WPAR_LICENSE_OPTION_NAME","wp_author_report_licence");
define("WPAR_PLUGIN_ID",24);

function add_author_report()

{ 
add_menu_page( "Work Report of Authors", "Author Report", 'manage_options', WPAR_PLUGIN_SLUG, 'author_report', WPAR_PLUGIN_URL."/css/images/icon.ico");
add_submenu_page( WPAR_PLUGIN_SLUG,"Authors Report Plugin Options", "Report options", 'manage_options', dirname(__FILE__)."/wp-author-report-options.php");
}

add_action('admin_menu', 'add_author_report'); 

	function author_report_admin_enqueue_scripts()
	{
		if(strpos($_SERVER['REQUEST_URI'], 'wp-author-report')) #to ensure that current plugin page is being shown.
		{

		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		$jquery_css_base = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.css';
		wp_enqueue_style ( 'jquery-ui-standard-css', $jquery_css_base );	
			
		}   
	}
add_action( 'admin_enqueue_scripts', 'author_report_admin_enqueue_scripts' );


function author_report_header()
{?>
<!--
<img src="<?php echo WPAR_PLUGIN_URL ?>/css/images/title-banner-free.png" align="top" /> By <a class='button-primary' href="https://wpdeveloper.net" target="_blank">WPDeveloper.net</a>  <a class='button-primary' href="https://wpdeveloper.net/plugin/wp-author-report/" target="_blank">Plugin Homepage</a>  <a  class='button-primary' style="color:#FFF600;" href="http://wordpress.org/support/view/plugin-reviews/wp-author-report-free" target="_blank">Rate This Plugin</a>

-->
<?php 
echo "Author Report Beta Version by: Ikhwan M. Iqbal"; 
?>
<!--
<div style="margin-top:20px;">

<a href="admin.php?page=wp-author-report-free/wp-author-report-upgrade.php"><img src="<?php echo WPAR_PLUGIN_URL ?>/css/images/header-banner-free-with-price.png" /></a>
</div>
-->
<?php
}#end author_report_header()

function author_report()

{

global $wpdb;

$holyday=get_option('holyday'); if(!$holyday)$holyday="Sun";

$included_stat_user = get_option('included_stat_user');
if (!is_array($included_stat_user)){$included_stat_user=reset_stat_options();} elseif(!count($included_stat_user)){$included_stat_user=reset_stat_options();}
if(count($included_stat_user)>100){$tincluded_stat_user=$included_stat_user; unset($included_stat_user); $included_stat_user=array(); for($i=0; $i<=1; $i++){$included_stat_user[]=$tincluded_stat_user[$i];} update_option('included_stat_user',$included_stat_user);}

	if(isset($_GET['aid']) && $_GET['aid']!="") {$aid=$_GET['aid']; $aname=$_GET['aname'];} else {$aid=1; $aname="Admin";}

	if(isset($_GET['actionto'])){$actionto=$_GET['actionto'];}else{$actionto="all";}

	if(isset($_GET['show'])){$show=$_GET['show'];}else{$show="report";}

	if(isset($_GET['report_style'])){$report_style=$_GET['report_style'];}else{$report_style="daily";}

	if(isset($_GET['period_style'])){$period_style=strtolower($_GET['period_style']);}else{$period_style="month to date";}

	switch($period_style)

	{

		case "today":

			{

			$sdate=date("Y-m-d");

			$edate=date("Y-m-d");

			break;

			}

		case "last seven days":

			{

			$sdate=sevenDaysAgo(date("Y-m-d"));

			$edate=date("Y-m-d");

		

			break;

			}

		case "month to date":

			{

			$firstOfMonth=firstOfMonth();

			$lastOfMonth=date("Y-m-d");

			$sdate=$firstOfMonth;

			$edate=$lastOfMonth;

			break;

			}
		case "last month":

			{

			$firstOfMonth=firstOfLastMonth();

			$lastOfMonth=lastOfLastMonth();

			$sdate=$firstOfMonth;

			$edate=$lastOfMonth;

			break;

			}
		case "specific date range":

			{

			if(isset($_GET['fromdate']))

				{

				$sdate=$_GET['fromdate'];

				$edate=$_GET['todate'];

				if(strtotime($sdate)>strtotime($edate)){ $tmp=$sdate; $sdate=$edate; $edate=$tmp; unset($tmp); } # if start date is bigger than end date swape two date.

				}

				else

				{

				$firstOfMonth=firstOfMonth();

				$lastOfMonth=date("Y-m-d");

				$sdate=$firstOfMonth;

				$edate=$lastOfMonth;	

				}

			break;

			}

	

	}# end of switch $period_style

	

	





		$mainedate=$edate;

		$eymarr=nextyearmonth($edate);

		$eyearmonth=$eymarr['Y-F'];

		$edate=nextdate($edate);  #nextdate() is an user Define Function

	$actionlink=get_bloginfo('url')."/wp-admin/index.php?page=".WPAR_PLUGIN_SLUG;

echo "<div style=\"width: 100%; min-width:1010px; padding-left: 10px;\" class=\"wrap\">";
	echo "<div style=\"width: 800px; float:left;\">";
	author_report_header();
	
	$myrows = get_authorlist();

	

	echo "<table class=\"widefat\">";

	echo "<thead><tr><th>User Id</th><th>Nick Name</th><th>Login</th><th>Level</th><th>eMail</th></tr></thead>";

	$userlist=array();

	

	foreach($myrows as $myuser)

	{	

		

		if(in_array($myuser->user_nicename,$included_stat_user))

		{

			echo "<tr "; if($myuser->level<2)echo " style=\"color:#CCCCCC;\""; echo ">";

			echo "<td>".$myuser->ID."</td>";

			echo "<td>".$myuser->user_nicename."</td>";

			echo "<td>".$myuser->user_login."</td>";

			echo "<td>".$myuser->level."</td>";

			echo "<td>".$myuser->user_email."</td>";

			$userlist[$myuser->ID]=ucfirst($myuser->user_nicename);

			echo "</tr>";

		}



	}

	echo "</table>";



	?>



	<table class="widefat" style="margin:10px 0px;"><tr><td>

	<form action="<?php echo $actionlink;?>" method="get">

		<input type="hidden" name="page" value="<?php echo WPAR_PLUGIN_SLUG ?>" />

		<select name="aid">

		<?php foreach($userlist as $uid=>$uname){echo "<option value=\"".$uid."\""; if($uid==$aid){ echo " selected=\"selected\"";$aname=$uname;} echo ">".$uname."</option>\n";} ?>

		</select>

		<input type="hidden" name="aname" value="<?php echo $aname;?>" />

		<input type="radio" name="actionto" value="single" <?php echo($actionto=="single")?"checked=\"checked\"":"";?> /> Show Selected Author 

		<input type="radio" name="actionto" value="all"  <?php echo($actionto=="all")?"checked=\"checked\"":"";?>/> Show All Author

		&nbsp;|&nbsp;

		<input type="radio" name="report_style" value="daily" <?php echo($report_style=="daily")?"checked=\"checked\"":"";?> />Daily 

		<input type="radio" name="report_style" value="monthly" <?php echo($report_style=="monthly")?"checked=\"checked\"":"";?> />Monthly 

		&nbsp;|&nbsp;

		<input type="radio" name="show" value="report" <?php echo($show=="report")?"checked=\"checked\"":"";?>  />  Report 

		<input type="radio" name="show" value="title" <?php echo($show=="title")?"checked=\"checked\"":"";?>  /> Post Title

		

		<br />

		<br />



From : <input class="datefield" id="fromdate" name="fromdate" readonly="readonly" type="text" value="<?php echo $sdate;?>" style="background:url(<?php echo WPAR_PLUGIN_URL ?>/css/images/calendar.gif) right no-repeat; cursor:pointer" >

	   <input style="border:none; font-size:10px;" size="35" id="fromdate2" readonly="readonly" type="text" value="<?php echo date("l, d F, yy",strtotime($sdate)); ?>" />

  To : <input  class="datefield" id="todate" name="todate" readonly="readonly" type="text" value="<?php echo $mainedate;?>" style="background:url(<?php echo WPAR_PLUGIN_URL ?>/css/images/calendar.gif) right no-repeat; cursor:pointer" >

  	   <input style="border:none; font-size:10px;" size="35" id="todate2" readonly="readonly" type="text" value="<?php echo date("l, d F, yy",strtotime($mainedate)); ?>" />

	<br />

		<div style="margin-top:10px;">

		<input type="submit" name="period_style" value="Today" class="button" size="20" style="width:130px;" />

		<input type="submit" name="period_style" value="Last Seven Days" class="button" size="20" style="width:130px;" />

		<input type="submit" name="period_style" value="Month to Date" class="button" size="20" style="width:130px;" />
		<input type="submit" name="period_style" value="Last Month" class="button" size="20" style="width:130px;" />
		<input type="submit" name="period_style" value="Specific Date Range" class="button" size="20" style="width:130px;" />

		</div>	

	</form>



	<style type="text/css">
	  .odd{ background:#f8f8f8;}

	  .zero{color:#CCCCCC;}
	  .datefield{ width:150px;}
	</style> 


	<script src="<?php echo WPAR_PLUGIN_URL ?>/js/jquery.printElement.min.js" type="text/javascript"></script>

	<!-- Alternet source  https://github.com/erikzaadi/jQueryPlugins/raw/master/jQuery.printElement/jquery.printElement.js -->

	<script type="text/javascript">

	jQuery(function() {

		jQuery( "#fromdate" ).datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: "yy-mm-dd",

			defaultDate: '<?php echo $sdate;?>',
			altField: "#fromdate2",

			altFormat: "DD, d MM, yy"

		});


		jQuery( "#todate" ).datepicker({

			changeMonth: true,

			changeYear: true,

			dateFormat: "yy-mm-dd",

			defaultDate: '<?php echo $mainedate;?>',

			altField: "#todate2",

			altFormat: "DD, d MM, yy"

		});	

	});

	</script>



	<script type="text/javascript">



       jQuery(document).ready(function($) {

         $("#PopupandLeaveopen").click(function() {

             printElem({ leaveOpen: true, printMode: 'popup' , pageTitle: '<?php bloginfo('name'); ?>'});

         });
		 /*fixing dtpicker not displaying */
			//$('#ui-datepicker-div').css('clip', 'auto');
			$('#ui-datepicker-div').removeClass('ui-helper-hidden-accessible');
		/*end of fixing dtpicker not displaying */		 

     });



 function printElem(options)

	 {

	 jQuery('#toPrint').printElement(options);

	 }

    </script>

	</td></tr></table>

	<?php 
	
	echo "<h3>";if($actionto=="single"){ echo "Report For <span style=\"color:#CC6600\">".$aname."</span> "; }else{ echo "Report of <span style=\"color:#CC6600\">All Authors</span>";} echo "&nbsp; &nbsp; From <span style=\"color:#CC6600\">$sdate</span> to <span style=\"color:#CC6600\">$mainedate</span></h3>";

	//$myrows = $wpdb->get_results( "SELECT * FROM wp_posts  where post_author='$aid' and post_status='publish'" );

	if($show=="title")

	{

		if($actionto=="single")

			{

			$myrows = $wpdb->get_results( "SELECT * FROM wp_posts  where post_author='$aid' and post_status='publish' and post_date BETWEEN '$sdate' AND '$edate' ORDER BY post_date ASC");

			}

			else

			{

			$myrows = $wpdb->get_results( "SELECT * FROM wp_posts  where post_status='publish' and post_date BETWEEN '$sdate' AND '$edate' ORDER BY post_date ASC");

			}

		$total=count($myrows);

		echo "Total Post=".$total;

		echo "<table class=\"widefat\">";

		$odd=true;

		foreach($myrows as $row)

		{

		echo "<tr "; if($odd==true){echo "class=\"odd\"";} echo ">"; #for even odd row style

			echo "<td>".date('Y-M-d',strtotime($row->post_date))."</td><td><strong>".$userlist[$row->post_author]."</strong></td><td>".$row->post_title."</td>";

			echo "<td>["; edit_post_link('edit', '', '',$row->ID); echo "] [<a href=\"".get_permalink($row->ID)."\" target=\"_blank\">Visit</a>] ".get_post_meta($row->ID,"views",true)." Views </td>";

		echo "</tr>";

		$odd=!$odd;

		}

		echo "</table>";

	}





#Start All user Report ------------------

	if($show=="report")

	{

		if($actionto=="single"){unset($userlist); $userlist=array($aid=>$aname);}

		$total_author=count($userlist);

		$userTotalCountList=array();

		?>

		<input type="button" value="Print This Report" id="PopupandLeaveopen" class="button" />

		<?php 

		switch($report_style)
	
		{

			case "daily":

			{

		

			echo "<table class=\"widefat\" id=\"toPrint\">";

			echo "<tr><td colspan=\"".($total_author+3)."\" style=\"text-align:center; font-weight:bold; color:#FC9F1B; font-size:18px; background:#ffffff \" >Authors Report of ".get_bloginfo('name')."</td></tr>";

				$tmpdate=$sdate;

				$grandTotal;

				$numberofDay;

				$odd=true;	

				while($tmpdate!=$edate)

				{	

					$numberofDay=$numberofDay+1;

					$numberofMonthDay=$numberofMonthDay+1;

					$tmpdateinfo=dateinfo($tmpdate);

					if($runningMonth!=$tmpdateinfo['mt']){$monthStart=true;}

					if($monthStart==true)

						{ 

						echo "<tr><td colspan=\"".($total_author+3)."\" style=\"text-align:center; font-weight:bold; color:#990000; font-size:18px; background:#eeffee repeat-x url(".WPAR_PLUGIN_URL."/css/images/white-grad.png) \" >".$tmpdateinfo['mt']."  ".$tmpdateinfo['y']."</td></tr>";

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>Date</td>";

						foreach($userlist as $uid=>$uname){echo "<td>".$uname."</td>";}

						echo "<td>Total</td>";
						echo '<td id="totalStar" title="Total Posts By All Authors">Total*</td>';

						echo "</tr>\n";

						$monthStart=false;

						$runningMonth=$tmpdateinfo['mt'];

						$odd=false;

						}

					#echo "<tr>"; 

					echo "<tr "; echo "style=\"";if($odd==true){echo "background:#f8f8f8;";} if($tmpdateinfo['dt']==$holyday){echo " color:#ff0000;";}  echo "\">"; #for even odd row style and week holyday color

					echo "<td>".$tmpdateinfo['d']; if($tmpdateinfo['dt']==$holyday){echo " ".$tmpdateinfo['dt'];} echo "</td>"; #Trac Week Holyday

					foreach($userlist as $uid=>$uname)

					{

					$myrows = $wpdb->get_results( "SELECT count(*) as total FROM wp_posts  where post_author='$uid' and post_status='publish' and date(post_date)='$tmpdate'");

					echo "<td "; if($myrows[0]->total==0 && $tmpdateinfo['dt']!=$holyday){echo " style=\"color:#CCCCCC;\"";} echo ">".$myrows[0]->total."</td>";

					$daytotal=$daytotal+$myrows[0]->total;

					$userMonthlyCountList[$uid]=$userMonthlyCountList[$uid]+$myrows[0]->total;

					$userTotalCountList[$uid]=$userTotalCountList[$uid]+$myrows[0]->total;

					}

					echo "<td>".$daytotal."</td>";
					$_daytotal=$wpdb->get_var("SELECT count(*) as total FROM wp_posts  where post_status='publish' and date(post_date)='$tmpdate'");
					echo "<td>".$_daytotal."</td>";

					echo "</tr>\n";

					$monthTotal=$monthTotal+$daytotal;
					$_monthTotal=$_monthTotal+$_daytotal;

					$grandTotal=$grandTotal+$daytotal;
					$_grandTotal=$_grandTotal+$_daytotal;

					$daytotal=0;

					$odd=!$odd;

					$tmpdate=nextdate($tmpdate);

					$tmpdateinfo=dateinfo($tmpdate);

					if($runningMonth!=$tmpdateinfo['mt']){$monthStart=true;}

					if($monthStart==true || $tmpdate==$edate)

						{ 

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>Sub Total</td>";

						foreach($userMonthlyCountList as $uid=>$count){echo "<td>".$count."</td>";}

						echo "<td>".$monthTotal."</td>";
						echo "<td>".$_monthTotal."</td>";

						echo "</tr>";

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>AVG/$numberofMonthDay Days</td>";

						foreach($userMonthlyCountList as $uid=>$count){echo "<td>".round(($count/$numberofMonthDay),2)."</td>";}

						echo "<td>".round(($monthTotal/$numberofMonthDay),2)."</td>";
						echo "<td>".round(($_monthTotal/$numberofMonthDay),2)."</td>";
						

						echo "</tr>";

						unset($userMonthlyCountList); $userMonthlyCountList=array(); # Delete and create new

						unset($monthTotal); $monthTotal=0;  # Delete and create new

						$numberofMonthDay=0;

						}

				}

		

		

				#Grand Total

				echo "<tr style=\"text-align:left; font-weight:bold; color:#990000; font-size:18px; background:#eeffee;\">";

				echo "<td>Grand Total</td>";

				foreach($userTotalCountList as $uid=>$count){echo "<td>".$count."</td>";}

				echo "<td>".$grandTotal."</td>";
				echo "<td>".$_grandTotal."</td>";

				echo "</tr>";

				#Grand Average

				echo "<tr style=\"text-align:left; font-weight:bold; color:#990000; font-size:18px; background:#eeeeff;\">";

				echo "<td>Average/$numberofDay days</td>";

				foreach($userTotalCountList as $uid=>$count){echo "<td>".round(($count/$numberofDay),2)."</td>";}

				echo "<td>".round(($grandTotal/$numberofDay),2)."</td>";
				echo "<td>".round(($_grandTotal/$numberofDay),2)."</td>";

				echo "</tr>";

				#Authors Name

				echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

				echo "<td>Authors</td>";

				foreach($userlist as $uid=>$uname){echo "<td>".$uname."</td>";}

				echo "<td>Total</td>";
				echo "<td>Total*</td>";

				echo "</tr>\n";

			echo "</table>";

			break;

			}#end of case "daily" -----------------------------------------------------------------------------------------------

			case "monthly":

			{

			echo "<table class=\"widefat\" id=\"toPrint\">";

				$tmpdate=$sdate;

				$sdateinfo=dateinfo($sdate);

				//$symarr=$nextyearmonth($sdate);

				$tmpyear=$sdateinfo['y'];

				$tmpmonth=$sdateinfo['F'];

				$tmpyearmonth=$tmpyear."-".$tmpmonth;

				$grandTotal;

				$numberofMonth;

				$odd=true;	

				while($tmpyearmonth!=$eyearmonth)

				{	

					$numberofMonth=$numberofMonth+1;

					$numberofYearMonth=$numberofYearMonth+1;

					if($runningYear!=$tmpyear){$yearStart=true;}

					if($yearStart==true)

						{ 

						echo "<tr><td colspan=\"".($total_author+3)."\" style=\"text-align:center; font-weight:bold; color:#990000; font-size:18px; background:#eeffee\" >".$tmpyear."</td></tr>";

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>Date</td>";

						foreach($userlist as $uid=>$uname){echo "<td>".$uname."</td>";}

						echo "<td>Total</td>";
						echo '<td id="totalStar" title="Total Posts By All Authors">Total*</td>';

						echo "</tr>\n";

						$yearStart=false;

						$runningYear=$tmpyear;

						$odd=false;

						}

					#echo "<tr>"; 

					echo "<tr "; if($odd==true){echo "style=\"background:#f8f8f8;\"";} echo ">"; #for even odd row style;

					echo "<td>".$tmpmonth."</td>"; #Trac Week Holyday

					foreach($userlist as $uid=>$uname)

					{

					$myrows = $wpdb->get_results( "SELECT count(*) as total FROM wp_posts  where post_author='$uid' and post_status='publish' and monthname(post_date)='$tmpmonth' and year(post_date)='$tmpyear'");

					echo "<td "; if($myrows[0]->total==0){echo " style=\"color:#CCCCCC;\"";} echo ">".$myrows[0]->total."</td>";
					

					$monthTotal=$monthTotal+$myrows[0]->total;
					$_monthTotal = $wpdb->get_var( "SELECT count(*) FROM wp_posts  where  post_status='publish' and monthname(post_date)='$tmpmonth' and year(post_date)='$tmpyear'");

					$userYearlyCountList[$uid]=$userYearlyCountList[$uid]+$myrows[0]->total;

					$userTotalCountList[$uid]=$userTotalCountList[$uid]+$myrows[0]->total;

					}

					echo "<td>".$monthTotal."</td>";
					echo "<td>".$_monthTotal."</td>";

					echo "</tr>\n";

					$yearTotal=$yearTotal+$monthTotal;
					$_yearTotal=$_yearTotal+$_monthTotal;

					$grandTotal=$grandTotal+$monthTotal;
					$_grandTotal=$_grandTotal+$_monthTotal;

					$monthTotal=0; $_monthTotal=0;

					$odd=!$odd;

					

					

					$tym=nextyearmonth($tmpyearmonth);

					$tmpyearmonth=$tym['Y-F'];

					$tmpyear=$tym['Y'];

					$tmpmonth=$tym['F'];

									

					$tmpdateinfo=dateinfo($tmpdate);

					

					if($runningYear!=$tmpyear){$yearStart=true;}

					if($yearStart==true || $tmpyearmonth==$eyearmonth)

						{ 

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>Sub Total</td>";

						foreach($userYearlyCountList as $uid=>$count){echo "<td>".$count."</td>";}

						echo "<td>".$yearTotal."</td>";
						echo "<td>".$_yearTotal."</td>";

						echo "</tr>";

						echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

						echo "<td>AVG/$numberofYearMonth Month</td>";

						foreach($userYearlyCountList as $uid=>$count){echo "<td>".round(($count/$numberofYearMonth),2)."</td>";}

						echo "<td>".round(($yearTotal/$numberofYearMonth),2)."</td>";
						echo "<td>".round(($_yearTotal/$numberofYearMonth),2)."</td>";

						echo "</tr>";

						unset($userMonthlyCountList); $userMonthlyCountList=array(); # Delete and create new

						unset($monthTotal); $monthTotal=0;  # Delete and create new

						$numberofYearMonth=0;

						}

				}

		

		

				#Grand Total

				echo "<tr style=\"text-align:left; font-weight:bold; color:#990000; font-size:18px; background:#eeffee;\">";

				echo "<td>Grand Total</td>";

				foreach($userTotalCountList as $uid=>$count){echo "<td>".$count."</td>";}

				echo "<td>".$grandTotal."</td>";
				echo "<td>".$_grandTotal."</td>";

				echo "</tr>";

				#Grand Average

				echo "<tr style=\"text-align:left; font-weight:bold; color:#990000; font-size:18px; background:#eeeeff;\">";

				echo "<td>Average/$numberofMonth Month</td>";

				foreach($userTotalCountList as $uid=>$count){echo "<td>".round(($count/$numberofMonth),2)."</td>";}

				echo "<td>".round(($grandTotal/$numberofMonth),2)."</td>";
				echo "<td>".round(($_grandTotal/$numberofMonth),2)."</td>";

				echo "</tr>";

				#Authors Name

				echo "<tr style=\"text-align:left; font-weight:bold; color:#009900; font-size:18px; background:#eeeeee\">";

				echo "<td>Authors</td>";

				foreach($userlist as $uid=>$uname){echo "<td>".$uname."</td>";}

				echo "<td>Total</td>";
				echo "<td>Total*</td>";
				

				echo "</tr>\n";

			echo "</table>";

			break;

			}#end of case "monthly"------------------------------------------------------------------------------------------------



		}#end of switch($report_style)		

	}#end of if($show=="report")

#End All user Report ------------------

	echo '<div style="margin-top:10px;">* Total posts of all authors including all other authors whose are not being shown in current report.</div>';
	echo "<h5>Today is ".date("l , d , F ,Y")."</h5>";
	

	echo '<div style="width:728px; height:90px; margin:10px auto;">
			<iframe name="resize" id="resize"  src="https://wpdeveloper.net/ads?size=728x90&bgcolor=ffffff&ref_plugin_id='.WPAR_PLUGIN_ID.'" width="728" height="90" scrolling="no" frameborder="0"></iframe>
	</div>';

	echo "<br><br><br>";

	//echo "Contributors: <a href=\"http://asif2bd.info\" title=\"M. Asif Rahman\" target=\"_blank\" >Asif2BD</a> and <a href=\"http://onetarek.com\" title=\"Md. Jahidul Islam\"  target=\"_blank\">oneTarek</a> : Powered By <a href=\"https://wpdeveloper.net\"  target=\"_blank\">WPDeveloper</a>";

	echo "</div>";

    include_once(WPAR_PLUGIN_PATH."wp-author-report-sidebar.php");
	echo '<div style="clear:both"></div>';
echo "</div>";

}  # end of Function author_stat()







#-------------------------------------USER DEFINED FUNCTIONS --------------------------------

function nextdate($date)

	{

	$timestamp=strtotime($date);

 	return date('Y-m-d', strtotime('1 day',$timestamp));

	}



function prevdate($date)

	{

	$timestamp=strtotime($date);

 	return date('Y-m-d', strtotime('-1 day',$timestamp));

	}

function sevenDaysAgo($date)

	{

	$timestamp=strtotime($date);

 	return date('Y-m-d', strtotime('-6 day',$timestamp));

	}

function nextyearmonth($date)

	{

	$yminfo=array();

	$timestamp=strtotime($date);

	$yminfo['Y']= date('Y', strtotime('1 month',$timestamp));

	$yminfo['F']= date('F', strtotime('1 month',$timestamp));

	$yminfo['Y-F']= $yminfo['Y']."-".$yminfo['F'];

	return $yminfo;

	}

function dateinfo($date)

	{

	$dinfo=array();

	$timestamp=strtotime($date);

	$dinfo['y']=date('Y',$timestamp);

	$dinfo['m']=date('m',$timestamp);

	$dinfo['F']=date('F',$timestamp);

	$dinfo['d']=date('d',$timestamp);

	$dinfo['dt']=date('D',$timestamp); # Like Fri, Sat, Sun, etc

	$dinfo['mt']=date('F',$timestamp);

	return $dinfo;

	}



function firstOfMonth()

	{

	return date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));

	}

function firstOfLastMonth()
{
return date("Y-m-d", strtotime('-1 month', strtotime(firstOfMonth().' 00:00:00')));
}




function lastOfMonth()

	{

	return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));

	}

function lastOfLastMonth()
{
return date("Y-m-d", strtotime('-1 day', strtotime(firstOfMonth().' 00:00:00')));
}



function reset_stat_options()

	{

	global $wpdb;

	$included_stat_user= array();

	$myrows = $wpdb->get_results( "SELECT * FROM wp_usermeta  where meta_key='wp_user_level' and meta_value BETWEEN 2 and 10" );

		foreach($myrows as $row)

		{	
		$myuser = $wpdb->get_row( "SELECT * FROM wp_users  where ID='$row->user_id'" );
		$included_stat_user[]=$myuser->user_nicename;
		break;

		}

	

	update_option('included_stat_user', $included_stat_user);

	update_option('holyday','Sun');

	return $included_stat_user;

	}



function get_authorlist()

	{

global $wpdb;

	$myrows1 = $wpdb->get_results( "SELECT DISTINCT(post_author) as user_id FROM wp_posts WHERE post_status='publish'",ARRAY_A);

	$myrows2 = $wpdb->get_results( "SELECT user_id FROM wp_usermeta  where meta_key='wp_user_level' and meta_value BETWEEN 2 and 10",ARRAY_A );

	$myrows3=array_merge($myrows1,$myrows2);

	$tmpuserlist=array();

	foreach ($myrows3 as $row)

	{

	$tmpuserlist[]=$row['user_id'];

	}

	$myusers=array_unique($tmpuserlist);

	$userlist=array();

	foreach($myusers as $user_id)

	{

	$myuser = $wpdb->get_row( "

	SELECT wp_users.ID,wp_users.user_login,wp_users.user_nicename,wp_users.user_email,wp_usermeta.meta_value as level FROM wp_users, wp_usermeta 

	WHERE wp_users.ID=$user_id AND wp_usermeta.user_id=wp_users.ID AND wp_usermeta.meta_key='wp_user_level'

	

	" );

	//echo $myuser->ID." - ".$myuser->user_login." - ".$myuser->user_nicename." - ".$myuser->user_email." - ".$myuser->level."<br>";

	$userlist[]=$myuser;

	}

//print_r($userlist);

return $userlist;

	}

function autrp_setting_links($links, $file) {
    static $autrp_setting;
    if (!$autrp_setting) {
        $autrp_setting = plugin_basename(__FILE__);
    }
    if ($file == $autrp_setting) {
        $autrp_settings_link = '<a href="admin.php?page=wp-author-report/wp-author-report-options.php">Settings</a>';
        array_unshift($links, $autrp_settings_link);
    }
    return $links;
}
add_filter('plugin_action_links', 'autrp_setting_links', 10, 2);	

#-----------------------------------------------SOME COMMON FUNCTION FOR ALL PLUGINS BY WPDEVELOPER.NET--------------------------------------------------
if(!function_exists('wpdev_get_host'))
{
	function wpdev_get_host($Address)
	{
	   $parseUrl = parse_url(trim($Address)); 
	   $host=trim($parseUrl['host'] ? $parseUrl['host'] : array_shift(explode('/', $parseUrl['path'], 2))); 
	   return str_ireplace('www.', '', trim($host));
	} 
}

if(!function_exists('wpdev_get_current_host'))
{
	function wpdev_get_current_host()
	{
	   return str_ireplace('www.', '', trim($_SERVER['HTTP_HOST']));
	} 
}

include_once('wpdev-dashboard-widget.php');
require_once("wp-author-report-upgrade.php");
#---END SOME COMMON FUNCTION FOR ALL PLUGINS BY WPDEVELOPER.NET-----------

/* Display a notice that can be dismissed */

add_action('admin_notices', 'wpar_admin_notice');

function wpar_admin_notice() {
if ( current_user_can( 'install_plugins' ) )
   {
     global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
     if ( ! get_user_meta($user_id, 'wpar_ignore_notice') ) {
        echo '<div class="updated"><p>';
        printf(__('<strong>[Notice]</strong> <strong>WP Author Report Free</strong> version will now provide reports for <strong>2 Authors</strong> for free. If you need support for more Author we have made the <a title="WP Author Report Pro" href="https://wpdeveloper.net/go/WPAR-Pro" target="_blank">Pro Packages</a> affordable for all level of user. Use Coupon "<a title="WP Author Report Coupon" href="https://wpdeveloper.net/go/WPAR-Pro" target="_blank"><strong>WPARPro</strong></a>" for 20 percent Discount, only for you! | <a href="%1$s">[Hide Offer]</a>'), '?wpar_nag_ignore=0');
        echo "</p></div>";
     }
    }
}

add_action('admin_init', 'wpar_nag_ignore');

function wpar_nag_ignore() {
     global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['wpar_nag_ignore']) && '0' == $_GET['wpar_nag_ignore'] ) {
             add_user_meta($user_id, 'wpar_ignore_notice', 'true', true);
     }
}
?>