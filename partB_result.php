<?php
  $winename = $_GET["winename"];
  $winery_name = $_GET["winery_name"];
  $region_id = $_GET["region_id"];
  $variety_id = $_GET["grape_variety_id"];
  $year_lower_bound = $_GET["year_lower_bound"];
  $year_higher_bound = $_GET["year_higher_bound"];
  $cost_lower_bound = $_GET["cost_lower_bound"];
  $cost_higher_bound = $_GET["cost_higher_bound"];
  $min_num_in_stock = $_GET["min_num_in_stock"];
  $min_num_ordered = $_GET["min_num_ordered"];
 /*
  print_r($_GET);
  echo "winename:".$winename."</br>" ;
  echo "winery_name:".$winery_name."</br>" ;
  echo "region_id:".$region_id."</br>" ;
  echo "grape_variety_id:".$variety_id."</br>" ;
  echo "year_lower_bound:".$year_lower_bound."</br>" ;
  echo "year_higher_bound:".$year_higher_bound."</br>" ;
  echo "cost_lower_bound:".$cost_lower_bound."</br>" ;
  echo "cost_higher_bound:".$cost_higher_bound."</br>" ;
  echo "min_num_ordered:".$min_num_ordered."</br>";
  echo "min_num_in_stock:".$min_num_in_stock."</br>";
  */
   $db_connection = mysql_connect('yallara.cs.rmit.edu.au:51355', 'winestore', '123');
   mysql_select_db("winestore", $db_connection);
   
   $search_statement = "SELECT  wine.wine_name,grape_variety.variety,wine.year,winery.winery_name,region.region_name,inventory.cost,sum(items.qty) qty,sum(items.price)
						FROM wine,wine_variety,grape_variety,winery,region,inventory,items
						WHERE wine.wine_id = wine_variety.wine_id 
						AND wine_variety.variety_id = grape_variety.variety_id 
						AND  wine.winery_id = winery.winery_id
						AND region.region_id = winery.region_id
						AND wine.wine_id = inventory.wine_id
						AND wine.wine_id = items.wine_id ";
		
    $winename_restriction = " AND wine.wine_name LIKE \"%$winename%\" ";
	
	$winery_name_restriction = " AND winery.winery_name LIKE \"%$winery_name%\" ";
	
	$region_id_restriction = " AND region.region_id = $region_id ";
	
	$grape_variety_id_restriction = " AND grape.variety_id = $variety_id ";
	
	$year_lower_bound_restriction = " AND wine.year >= $year_lower_bound ";
	$year_higher_bound_restriction = " AND wine.year <= $year_higher_bound ";
	
	$cost_lower_bound_restriction = " AND inventory.cost >= $cost_lower_bound ";
	$cost_higher_bound_restriction = " AND inventory.cost <= $cost_higher_bound ";
	
	$min_num_ordered_restriction = " HAVING qty >= $min_num_ordered ";
	
	$min_num_in_stock_restriction = " AND inventory.on_hand >=$min_num_in_stock" ;	
	
	if($winename != '')
    {
	 $search_statement = $search_statement.$winename_restriction;
	}
	if($winery_name != '')
    {
	 $search_statement = $search_statement.$winery_name_restriction;
	}
	if($region_id != '')
    {
	 $search_statement = $search_statement.$region_id_restriction;
	}	
	if($grape_variety_id != '')
    {
	 $search_statement = $search_statement.$grape_variety_id_restriction;
	}	
	if($year_lower_bound != '')
    {
	 $search_statement = $search_statement.$year_lower_bound_restriction;
	}	
	if($year_higher_bound != '')
    {
	 $search_statement = $search_statement.$year_higher_bound_restriction;
	}
    if($cost_lower_bound != '')
    {
	 $search_statement = $search_statement.$cost_lower_bound_restriction;
	}
    if($cost_higher_bound != '')
    {
	 $search_statement = $search_statement.$cost_higher_bound_restriction;
	}
	if($min_num_in_stock !='')
	{
	$search_statement = $search_statement.$min_num_in_stock_restriction;
	}
	
	$search_statement = $search_statement." GROUP BY wine.wine_id ";
	
	if($min_num_ordered !='')
	{
	$search_statement = $search_statement.$min_num_ordered_restriction;
	}
	
	$search_statement = $search_statement." ORDER BY wine.wine_name,grape_variety.variety,wine.year ";
	
	$search_statement = $search_statement." LIMIT 5 ";
	
    $result = mysql_query($search_statement, $db_connection);
	
	//echo $search_statement."</br>";
	
	if(!$result) {
        echo "wrong search statement </br>";
        exit;
    }
  
  
?>


<html>
<head>
<title>result</title>
</head>
<body>
    <div id="main">

      <div class="caption">result</div>
      <div id="icon">&nbsp;</div>
		
        <table width="100%"  border="3" cellspacing="0" cellpadding="0" align="center">         
		   <tr>
		   <td> wine name </td> 
		   <td> grape variety </td>
		   <td> year </td>
		   <td> winery name </td>
		   <td> region </td>
		   <td> price </td>
		   <td> sold </td>
		   <td> revenue </td>
		   </tr>
		  
		  <?php
             $row = mysql_fetch_row($result);
		     if(!$row)echo "no record match your search criteria ";
			 
			do 
			{
			  echo "<tr>";
			 // print_r($row);
			if($row)
			{
				foreach($row as $value)
				{
					echo  "<td> $value </td>";
				}
			}	
			  //echo  "<br> </br>"
			  echo "</tr>"; 
			}while($row = mysql_fetch_row($result))
           ?>
          
        </table>  
      
      
	  
	  </br>
  
	  
</body>
</html>

<?php
    mysql_close( $db_connection);
    echo error_get_last();
?>