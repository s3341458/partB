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
	
	
	
	$result_region = mysql_query($show_region_query, $db_connection);
	
	$result_grape = mysql_query($show_grape_query, $db_connection);
	
	$result_year = mysql_query($show_year_query, $db_connection);
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
		  
        <tr>
		  <td colspan="1" align="center">year_lower_bound:
		  <select value="year_lower_bound"  >
			<?php
			while($row = mysql_fetch_row($result_year)) 
			{
				  $year = $row[0];
				  echo "<option value=".$year."> ".$year." </option>";
			}
            ?>
		  </select>
		  
		  </td>
		  <td colspan="1" align="center">year_upper_bound:
		  <select value="year_upper_bound"  >
			<?php
			reset($result_year);
			while($row = mysql_fetch_row($result_year)) 
			{
				  $year = $row[0];
				  echo "<option value=".$year."> ".$year." </option>";
			}
            ?>
		  </select>
		  </td>
		</tr>
		  <tr><td colspan="1" align="center">cost(lower bound):<input class="text" name="cost_lower_bound" type="text" /></td>
		      <td colspan="1" align="center">cost(higher bound):<input class="text" name="cost_higher_bound" type="text" /></td></tr>
		  
		  <tr><td colspan="2" align="center"><input class="text" type="submit" name="query" value="query" /></td></tr>
          
        </table>  
      </form>
      
	  
	  </br>
        
	   
	   
   
	  
	  
</body>
</html>