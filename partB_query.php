<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html>
<head>
   <title>query System</title>
   
    <script type="text/javascript"> 
    /*
    function is_number(text)
    { 
	  var pattern_number = new RegExp("\d*"); 
	  if(pattern_number.test(text) == false)
	  {
	     alert(text + "is not a number");
		 return false;
	  }
	  
	  return true;
	}	
	*/
	function validate_form(thisform)
	{	
	     var pattern_number = new RegExp("^[0-9]*$");
	   
		// alert(""+thisform.cost_lower_bound.value);
		 
		 if(pattern_number.test(thisform.cost_lower_bound.value) == false)
	     {
	     alert(thisform.cost_lower_bound.value + " is not a number");
		 return false;
	     }
		 
		 if(pattern_number.test(thisform.cost_higher_bound.value) == false)
	     {
	     alert(thisform.cost_higher_bound.value + " is not a number");
		 return false;
	     }
		 
		 if(pattern_number.test(thisform.min_num_in_stock.value) == false)
	     {
	     alert(thisform.min_num_in_stock.value + " is not a number");
		 return false;
	     }
		 
		 if(pattern_number.test(thisform.min_num_ordered.value) == false)
	     {
	     alert(thisform.min_num_ordered.value + " is not a number");
		 return false;
	     }
		  
		  /*
		  if(is_number(thisform.cost_lower_bound.value) == false){return false;}
		  
		 
		  if(is_number(thisform.cost_higher_bound.value) == false){return false;}
		  
		  if(is_number(thisform.min_num_in_stock.value) == false){return false;}
		  
		  if(is_number(thisform.min_num_ordered.value) == false){return false;}
		*/
		  if(parseInt(thisform.year_lower_bound.value) > parseInt(thisform.year_higher_bound.value))
		  {
		   alert("lower bound year should lower than higher bound year ");
		   return false;
		  }
		  
		  if(parseInt(thisform.cost_lower_bound.value) > parseInt(thisform.cost_higher_bound.value))
		  {
		   alert("lower bound price should lower than higher bound price ");
		   return false;
		  }
       
		
		
		
		//document.write("test!!");
		
		//alert("test");
		//alert("11"+cost_lower_bound + " "+cost_higher_bound + " "+min_num_in_stock + " "+min_num_in_stock + " " + min_num_ordered + " ");
		//alert(""+thisform.cost_lower_bound.value);
		
		return true;
		
	}
	
	</script>

</head>
<?php
    $db_connection = mysql_connect('yallara.cs.rmit.edu.au:51535', 'winestore', '123');
	
	mysql_select_db("winestore", $db_connection);
	
	$show_region_query = "select * from region;";
	$show_grape_query = "select * from grape_variety;";
	$show_year_query = "select distinct year from wine order by year";
	
	
	
	$result_region = mysql_query($show_region_query, $db_connection);
	$result_grape = mysql_query($show_grape_query, $db_connection);	
	$result_year = mysql_query($show_year_query, $db_connection);
	
	$years = array();
	
	$i = 0;
	while($row = mysql_fetch_row($result_year))
	{
	  $years[$i] = $row[0];
	  $i++;
	}
?>

<body>
    <div id="main">

      <div class="caption">search page</div>
      <div id="icon">&nbsp;</div>
      <form action="partB_result.php" method="get" name="searchform" onsubmit = "return validate_form(this)">
        <table  border="0" cellspacing="0" cellpadding="0" align="center">
          <tr><td colspan="2" align="left">winename:<input class="text" name="winename" type="text" /></td></tr>
		  <tr><td colspan="2" align="left">winery name:<input class="text" name="winery_name" type="text" /></td></tr>
		  <tr>
		  <td colspan="2" align="left">region:
		  <select value="region_id" name = "region_id" id = "region_id" >
			<?php
			while($row = mysql_fetch_row($result_region)) 
			{
				  $region_id = $row[0];
				  $region_name = $row[1];
				  echo "<option value=\"".$region_id."\"> ".$region_name." </option>";
			}
            ?>
		  </select>
		  </td>
		  </tr>
		  
		  <tr><td colspan="2" align="left">grape:
		  <select value="grape_variety_id" name="grape_variety_id" id="grape_variety_id" >
			<?php
			while($row = mysql_fetch_row($result_grape)) 
			{
				  $variety_id = $row[0];
				  $variety = $row[1];
				  echo "<option value=\"".$variety_id."\"> ".$variety." </option>";
			}
            ?>
		  </select>
		  </td>
		  </tr>
		  
        <tr>
		  <td colspan="1" align="left">year_lower_bound:
		  <select value="year_lower_bound" name="year_lower_bound" id = "year_lower_bound" >
			<?php
			for($i = 0;$i<count($years);$i++)
				  echo "<option value=\"".$years[$i]."\"> ".$years[$i]." </option>";
            ?>
		  </select>
		  
		  </td>
		  <td colspan="1" align="left">year_upper_bound:
		  <select value="year_higher_bound" name="year_higher_bound" id="year_higher_bound" >
			<?php
			for($i = 0;$i<count($years);$i++)
				  echo "<option value=\"".$years[$i]."\"> ".$years[$i]." </option>";
			
            ?>
		  </select>
		  </td>
		</tr>
		  <tr><td colspan="1" align="left">cost(lower bound):<input class="text" name="cost_lower_bound" type="text" /></td>
		      <td colspan="1" align="left">cost(higher bound):<input class="text" name="cost_higher_bound" type="text" /></td></tr>
		  <tr><td colspan="1" align="left">minium number in stock:<input class="text" name="min_num_in_stock" type="text" /></td>
		      <td colspan="1" align="left">minium number ordered :<input class="text" name="min_num_ordered" type="text" /></td></tr>  
			  
		  
		  <tr><td colspan="2" align="center"><input class="text" type="submit" name="search" value="search" /></td></tr>
          
        </table>  
      </form>
	  </br>  	  
</body>
</html>

<?php
    mysql_close( $db_connection);
    echo error_get_last();
?>