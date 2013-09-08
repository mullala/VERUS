<?php get_header(); ?>
        <div id="wrapper_content">
            <div id="content">
				 <?php include(TEMPLATEPATH.'/left_side.php');?> 
                <div id="middle_content">
                    <div class="banner"><!--
                       <a href="<?php //bloginfo('url');?>/?page_id=28"><div class="banner_col">&nbsp;</div></a>-->
                       <a href="<?php bloginfo('url');?>/?page_id=31"><div class="banner_col">&nbsp;</div></a>
                       <a href="<?php bloginfo('url');?>/?page_id=33"><div class="banner_col">&nbsp;</div></a>
                       <a href="<?php bloginfo('url');?>/?page_id=35"><div class="banner_col">&nbsp;</div></a>
                       <a href="<?php bloginfo('url');?>/?page_id=37"><div class="banner_col_last">&nbsp;</div></a>
                    </div>
                    <div class="lower_middle_content">
                    	<p><?php echo of_get_option('footer_editor', 'no entry'); ?></p>
                    </div>
                </div>
				<?php include(TEMPLATEPATH.'/right_side.php');?>
            </div>
        </div>    
    </div>
	      <?php get_footer();?>

