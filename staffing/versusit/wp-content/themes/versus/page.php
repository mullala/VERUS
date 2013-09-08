<?php get_header(); ?>
        <div id="wrapper_content">
            <div id="content">
                <?php require_once('left_side.php');?>
                <div id="middle_content">
                    <div class="content_experience">
					 <?php 
					$url=get_post_permalink();
					$pageid = url_to_postid( $url );
					$page_data = get_page( $pageid );
					?>	
                <h2><?php echo $page_data->post_title;?></h2>
                <?php echo apply_filters('the_content', $page_data->post_content);?>                 
                    </div>
                </div>
                <?php require_once('right_side.php');?>
            </div>
        </div>    
    </div>
<?php get_footer();?>