<?php
global g5; 
list($bo_table, $category) = explode("|", $bo_table);
if($category) {
    $cat = explode(",", $category);
    $cats = " AND ca_name IN('".implode("', '", $cat)."') ";
}
//코드 추가



//$sql = " select * from {$tmp_write_table} where wr_is_comment = 0 order by wr_num limit 0, {$rows} "; 라인을 찾아


$sql = " select * from {$tmp_write_table} where wr_is_comment = 0".$cats." order by wr_num limit 0, {$rows} ";

//수정하면 카테고리를 지정해 노출할 수 있다.

 //메인 페이지에서

<?php echo latest("스킨", "게시판|카테고리1,카테고리2", 5, 25); ?>
//게시판 아이디 | 카테고리를 구분해서 넣고 함수를 호출
?>
