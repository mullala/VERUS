<?php get_header(); ?>

        <div id="wrapper_content">

            <div id="content">

				 <?php include(TEMPLATEPATH.'/left_side.php');?> 

                <div id="middle_content">

                    <div class="banner">

                       <a href="<?php bloginfo('url');?>/?page_id=4"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=7"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=9"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=13"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=67"><div class="banner_col">&nbsp;</div></a>
                       
                       <a href="<?php bloginfo('url');?>/?page_id=15"><div class="banner_col_last">&nbsp;</div></a>

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



