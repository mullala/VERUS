<?php get_header(); ?>

        <div id="wrapper_content">

            <div id="content">

				 <?php include(TEMPLATEPATH.'/left_side.php');?> 

                <div id="middle_content">

    <div id="sliderFrame">
        <div id="slider">
            <a href="software-engineering-development/"><img src="wp-content/uploads/2013/09/software-engeneering.jpg" alt="#htmlcaption1" /></a>
            <a href="it-infrastructure-networkin/"><img src="wp-content/uploads/2013/09/it-infrastructure.jpg" alt="#htmlcaption2">slide 2</a>
            <a href="ui-ux-web-dev-desig/">
                <b data-src="wp-content/uploads/2013/09/ui-ux-web-development.jpg" data-alt="#htmlcaption3">Image Slider</b>
            </a>
            <a href="quality-assuranc/"><img src="wp-content/uploads/2013/09/quality-assurance.jpg" alt="#htmlcaption4">slide 4</a>
            <a href="cyber-security/"><img src="wp-content/uploads/2013/09/cyber-security.jpg" alt="#htmlcaption5">slide 4</a>
            <a href="expertise/"><img src="wp-content/uploads/2013/09/it-management.jpg" alt="#htmlcaption6">slide 4</a>
        </div>
        <!--thumbnails-->
        <div id="thumbs">
            <div class="thumb"><img src="wp-content/uploads/2013/09/iMac.png" /></div>
            <div class="thumb"><img src="wp-content/uploads/2013/09/usb.png" /></div>
            <div class="thumb"><img src="wp-content/uploads/2013/09/iPhone4.png" /></div>
            <div class="thumb"><img src="wp-content/uploads/2013/09/star-medal-gold-red.png" /></div>
            <div class="thumb"><img src="wp-content/uploads/2013/09/padlock-closed.png" /></div>
            <div class="thumb"><img src="wp-content/uploads/2013/09/settings.png" /></div>

        </div>
        <!--captions-->
        <div style="display: none;">
            <div id="htmlcaption1">
                <div class="cap">Software Engineering & Development</div>
            </div>
            <div id="htmlcaption2">
                <div class="cap cap2">IT Infrastructure & Networking</div>
            </div>
            <div id="htmlcaption3">
                <div class="cap cap3">UI/UX/WEB Development & Design</div>
            </div>
            <div id="htmlcaption4">
                <div class="cap cap4">Quality Assurance</div>
            </div>
            <div id="htmlcaption5">
                <div class="cap cap5">Cyber Security</div>
            </div>
            <div id="htmlcaption6">
                <div class="cap cap6">IT Management</div>
            </div>
        </div>
    </div>


<!--
                    <div class="banner">

                       <a href="<?php bloginfo('url');?>/?page_id=4"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=7"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=9"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=13"><div class="banner_col">&nbsp;</div></a>

                       <a href="<?php bloginfo('url');?>/?page_id=67"><div class="banner_col">&nbsp;</div></a>
                       
                       <a href="<?php bloginfo('url');?>/?page_id=15"><div class="banner_col_last">&nbsp;</div></a>

                    </div>
-->
                    <div class="lower_middle_content">

                    	<p><?php echo of_get_option('footer_editor', 'no entry'); ?></p>

                    </div>

                </div>

				<?php include(TEMPLATEPATH.'/right_side.php');?>

            </div>

        </div>    

    </div>

	      <?php get_footer();?>