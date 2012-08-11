<?php
  $winename = $_GET["winename"];
  $winery_name = $_GET["winery_name"];
  $region_id = $_GET["region_id"];
  $grape_variety_id = $_GET["grape_variety_id"];
  $year_lower_bound = $_GET["year_lower_bound"];
  $year_upper_bound = $_GET["year_upper_bound"];
  $cost_lower_bound = $_GET["cost_lower_bound"];
  $cost_higher_bound = $_GET["cost_higher_bound"];
  $min_num_in_stock = $_GET["min_num_in_stock"];
  $min_num_ordered = $_GET["min_num_ordered"];
 
  print_r($_GET);
  echo "winename:".$winename."\n" ;
  echo "winery_name:".$winery_name."\n" ;
  echo "region_id:".$region_id."\n" ;
  echo "grape_variety_id:".$grape_variety_id."\n" ;
  echo "year_lower_bound:".$year_lower_bound."\n" ;
  echo "year_upper_bound:".$year_upper_bound."\n" ;
  echo "cost_lower_bound:".$cost_lower_bound."\n" ;
  echo "cost_higher_bound:".$cost_higher_bound."\n" ;
  echo "min_num_ordered:".$min_num_ordered."\n";
  echo "min_num_in_stock:".$min_num_in_stock."\n";
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
		
    $winename_restriction = " AND wine.winename LIKE %$winename% ";
	
	$winery_name_restriction = " AND winery.winery_name LIKE %$winery_name%";
	
	$region_id_restriction = " AND region.region_id = $region_id ";
	
	$grape_variety_id_restriction = " AND grape.grape_variety_id = $grape_variety_id ";
	
	$year_lower_bound_restriction = " AND wine.year >= $year_lower_bound ";
	$year_higher_bound_restriction = " AND wine.year <= $year_higher_bound ";
	
	$cost_lower_bound_restriction = " AND inventory.cost >= $cost_lower_bound_restriction ";
	$cost_higher_bound_restriction = " AND inventory.cost <= $cost_higher_bound_restriction ";
	
	$min_num_ordered_restriction = " HAVING qty >= $min_num_ordered ";
	
	$min_num_in_stock_restriction = " AND inventory.on_hand >=$min_num_in_stock" ;	
	
	if($winename != '')
    {
	 $query = $query.$winename_restriction;
	}
	if($winery_name != '')
    {
	 $query = $query.$winery_name_restriction;
	}
	if($region_id != '')
    {
	 $query = $query.$region_id_restriction;
	}	
	if($grape_variety_id != '')
    {
	 $query = $query.$grape_variety_id_restriction;
	}	
	if($year_lower_bound != '')
    {
	 $query = $query.$year_lower_bound_restriction;
	}	
	if($year_higher_bound != '')
    {
	 $query = $query.$year_higher_bound_restriction;
	}
    if($cost_lower_bound != '')
    {
	 $query = $query.$cost_lower_bound_restriction;
	}
    if($cost_higher_bound != '')
    {
	 $query = $query.$cost_higher_bound_restriction;
	}
	if($min_num_in_stock !='')
	{
	$query = $query.$min_num_in_stock_restriction
	}
	
	$query = $query." GROUP BY wine.wine_id";
	
	if($min_num_ordered !='')
	{
	$query = $query.$min_num_ordered_restriction;
	}
	
	$query." ORDER BY wine.wine_name,grape_variety.variety,wine.year ";
	
    
  
  
?>