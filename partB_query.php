<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>query System</title>
</head>
<?php
    $db_connection = mysql_connect('yallara.cs.rmit.edu.au:51355', 'winestore', '123');
	
	mysql_select_db("winestore", $db_connection);
	
	$show_region_query = "select * from region;";
	
	$show_grape_query = "select * from grape_variety;";
	
	$show_year_query = "select distinct year from wine";
	
	$result_region = mysql_query($show_region_query, $dbconn);
	
	$result_grape =  mysql_query($show_grape_query, $dbconn);
	
	$result_year =
?>

<body>
    <div id="main">

      <div class="caption">query</div>
      <div id="icon">&nbsp;</div>
      <form action="represent.php" method="post" name="queryform">
        <table width="100%">
          <tr><td colspan="2" align="center">winename:<input class="text" name="winename" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">winery name:<input class="text" name="winery_name" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">region:
		  <select value="region_name"  >
			<?php
			while($row = mysql_fetch_row($result_region)) 
			{
				  $region_id = $row[0];
				  $region_name = $row[1];
				  echo "<option value=".$region_id."> ".$region_name." </option>";
			}
            ?>
		  </select>
		  </td></tr>
		  
		  <tr><td colspan="2" align="center">grape:
		  <select value="grape_name"  >
			<?php
			while($row = mysql_fetch_row($result_grape)) 
			{
				  $variety_id = $row[0];
				  $variety = $row[1];
				  echo "<option value=".$variety_id."> ".$variety." </option>";
			}
            ?>
		  </select>
		  </td></tr>
		  
		  <tr><td colspan="2" align="center">name(optional):<input class="text" name="NAME" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">address(optional):<input class="text" name="ADDRESS" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">city(optional):<input class="text" name="CITY" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">state(optional):<input class="text" name="STATE" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">zip(optional):<input class="text" name="ZIP" type="text" /></td></tr>
		  <tr><td colspan="2" align="center">cvv(optional):<input class="text" name="CVV" type="text" /></td></tr>
		  
		  
          <tr><td colspan="2" align="center"><input class="text" type="submit" name="submit" value="pay" /></td></tr>
        </table>  
      </form>
      
	  &nbsp;<a href="client.php">back</a></br>
      &nbsp;<a href="logoutClient.php">Logout</a>
	  </br>
        
	   
	   
   
	  
	  
</body>
</html>