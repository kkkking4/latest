
<?php
// $bo_tables 테이블들 사이 콤마(,) 단위로 구분해서 넣을 것, 콤마 사이에 공백 없이 (ex aaa,bbb,)
function latest_all($skin_dir='', $bo_tables, $rows=10, $subject_len=40, $cache_time=1, $options='')
{

    global $g5;

    if (!$skin_dir) $skin_dir = 'basic';

    if(preg_match('#^theme/(.+)$#', $skin_dir, $match)) {
        if (G5_IS_MOBILE) {
            $latest_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            if(!is_dir($latest_skin_path))
                $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        } else {
            $latest_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/latest/'.$match[1];
            $latest_skin_url = str_replace(G5_PATH, G5_URL, $latest_skin_path);
        }
        $skin_dir = $match[1];
    } else {
        if(G5_IS_MOBILE) {
            $latest_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/latest/'.$skin_dir;
        } else {
            $latest_skin_path = G5_SKIN_PATH.'/latest/'.$skin_dir;
            $latest_skin_url  = G5_SKIN_URL.'/latest/'.$skin_dir;
        }
    }

        $list = array();
        $sql_common = " from {$g5['board_new_table']} a  where find_in_set(a.bo_table, '{$bo_tables}')";
        $sql_common .= " and a.wr_id = a.wr_parent ";
        $sql_order = " order by a.bn_id desc ";
        $sql = " select a.* {$sql_common} {$sql_order} limit 0, {$rows}";

        $result = sql_query($sql);
        
        for ($i=0; $row=sql_fetch_array($result); $i++) {

            $sql = " select * from {$g5['board_table']} where bo_table = '{$row['bo_table']}' ";

          

            $board = sql_fetch($sql);

            $tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
            $row2 = sql_fetch(" select * from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");



            $list[$i] = $row2;
            $list[$i] = get_list($row2, $board, $latest_skin_url, $subject_len);
            $list[$i]['bo_subject'] = $row['bo_subject'];
            $list[$i]['bo_table'] = $row['bo_table'];
        }

    ob_start();
    include $latest_skin_path.'/latest.skin.php';
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}
?>
