<?php 
global $wpdb;
if(isset($_POST['save']))
	{ 
	$included_stat_user=array();
		$myrows = get_authorlist();
		foreach($myrows as $myuser)
		{	
			
			if(isset($_POST[$myuser->user_nicename]))
			{
			$included_stat_user[]=$myuser->user_nicename;
			}
		}
		if(count($included_stat_user)>100){$err_msg=true;reset_stat_options();}else{	update_option('included_stat_user', $included_stat_user);}
	
	update_option('holyday',$_POST['holyday']);	
	}

if(isset($_POST['reset']))
	{
	reset_stat_options(); #reset_stat_options() Decleared on plugin main file
	}

echo "<div style=\"width: 100%; min-width:1010px; padding-left: 10px;\" class=\"wrap\">";
echo "<div style=\"width: 800px; float:left;\">";
    author_report_header();
$err_msg=false;
echo "<h2>Report Options</h2>";
if($err_msg==true){echo '<div style="color:#ff0000; font-weight:bold;">You Can not Select More Than 3 Author</div>';}
echo '<div style="color:#0000cc; font-weight:bold;">Select user to be showed</div>';
$included_stat_user = get_option('included_stat_user');
$holyday=get_option('holyday'); if(!$holyday)$holyday="Sun";
if (!is_array($included_stat_user)){$included_stat_user=reset_stat_options();} #reset_stat_options() Decleared on plugin main file.
	
	$myrows = get_authorlist();
	
	echo "<form action=\"#\"  method=\"post\" >";
	echo "<table class=\"widefat\">";
	echo "<thead><tr><th>Included User</th><th>User Id</th><th>Nick Name</th><th>Login</th><th>Level</th><th>eMail</th></tr></thead>";
	foreach($myrows as $myuser)
	{	
		
		echo "<tr "; if($myuser->level<2)echo " style=\"color:#CCCCCC;\""; echo ">";
		echo "<td><input type=\"checkbox\" name=\"".$myuser->user_nicename."\""; if(in_array($myuser->user_nicename,$included_stat_user)){echo " checked=\"checked\"";} echo "\"> </td>";
		echo "<td>".$myuser->ID."</td>";
		echo "<td>".$myuser->user_nicename."</td>";
		echo "<td>".$myuser->user_login."</td>";
		echo "<td>".$myuser->level."</td>";
		echo "<td>".$myuser->user_email."</td>";
		echo "</tr>";
	}

	echo "</table>";

	echo "Select Your Weekly Holyday : ";
	echo "<select name=\"holyday\">";
	echo "<option value=\"Sun\" "; echo ($holyday=='Sun')? "selected=\"selected\">Sunday</option>":">Sunday</option>";
	echo "<option value=\"Mon\" "; echo ($holyday=='Mon')? "selected=\"selected\">Monday</option>":">Monday</option>";
	echo "<option value=\"Tue\" "; echo ($holyday=='Tue')? "selected=\"selected\">Tuesday</option>":">Tuesday</option>";
	echo "<option value=\"Wed\" "; echo ($holyday=='Wed')? "selected=\"selected\">Wednesday</option>":">Wednesday</option>";
	echo "<option value=\"Thu\" "; echo ($holyday=='Thu')? "selected=\"selected\">Thursday</option>":">Thursday</option>";
	echo "<option value=\"Fri\" "; echo ($holyday=='Fri')? "selected=\"selected\">Friday</option>":">Friday</option>";
	echo "<option value=\"Sat\" "; echo ($holyday=='Sat')? "selected=\"selected\">Saturday</option>":">Saturday</option>"; 
	echo "</select><br>";
	
	
	echo "<input type=\"submit\" name=\"save\" value=\"Save\" class=\"button\">";
	echo "<input type=\"submit\" name=\"reset\" value=\"Reset\" class=\"button\">";
	echo "</form>";
echo "</div>";

    include_once(WPAR_PLUGIN_PATH."wp-author-report-sidebar.php");
	echo '<div style="clear:both"></div>';
echo "</div>";

//print_r($included_stat_user);

//print_r(get_authorlist());

#Update on 14 March 2015
?>