<?php

?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <div class="form-group has-feedback has-feedback-left">
        <label class="control-label sr-only"><?php echo __('SØG','FaaborgMuseum'); ?></label>
        <input type="text" name="s" class="form-control" placeholder="" value="<?php echo get_search_query() ?>">
        <i class="form-control-feedback glyphicon glyphicon-search"></i>
    </div>
    <!--<input type="submit" class="search-submit" value="<?php echo __('SØG','FaaborgMuseum'); ?>" />-->
</form>

