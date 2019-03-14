<?php if ($is_admin) { ?>
    <div class="write_div">
        <input type="checkbox" name="wr_11" value="1" <?php echo ($write['wr_11'] == "1") ? "checked" : "";?>> <label for="wr_11"> 최신인기 </label>&nbsp;
        <input type="checkbox" name="wr_12" value="1" <?php echo ($write['wr_12'] == "1") ? "checked" : "";?>> <label for="wr_12"> 추천 </label>
	</div>
<?php } ?>
