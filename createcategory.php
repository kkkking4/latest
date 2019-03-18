 
function CategoryAdd($ca_name, $bo_table){
    if($ca_name){
        $row = sql_fetch(" select bo_category_list from g5_board where bo_table = '".$bo_table."' ");
        $cut = explode("|", $row['bo_category_list']);
        if(count($cut) == 0)
  $add_category = $ca_name;
        else
  $add_category = $row['bo_category_list']."|".$ca_name;
        if(!in_array($ca_name, $cut)){
            sql_query(" update g5_board set bo_category_list = '".$add_category."' where bo_table = '".$bo_table."' ");
        }
    }
}
 
