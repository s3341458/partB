<?php
  $winename = $_GET["winename"];
  $winery_name = $_GET["winery_name"];
  $region_id = $_GET["region_name"];
  $grape_id = $_GET["grape_name"];
  $year_lower_bound = $_GET["year_lower_bound"];
  $year_upper_bound = $_GET["year_upper_bound"];
  $cost_lower_bound = $_GET["cost_lower_bound"];
  $cost_higher_bound = $_GET["cost_higher_bound"];
  
  print_r($_GET);
  echo "winename:".$winename."\n" ;
  echo "winery_name:".$winery_name."\n" ;
  echo "region_name:".$region_name."\n" ;
  echo "grape_name:".$grape_name."\n" ;
  echo "year_lower_bound:".$year_lower_bound."\n" ;
  echo "year_upper_bound:".$year_upper_bound."\n" ;
  echo "cost_lower_bound:".$cost_lower_bound."\n" ;
  echo "cost_higher_bound:".$cost_higher_bound."\n" ;
  

  
?>