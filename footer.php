<footer class="site-footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-6">
                <?php 
                wp_nav_menu( array(
                    'theme_location'  => 'footer',
                    'depth'           => 1,
                    'container'         => false,
                    'menu_class'      => 'footer-nav'
                ) );
                ?>
                <p class="copyright"><?php _e('Copyright &copy 2022 All rights reserved.', 'industry-dive'); ?></p>
            </div>
            <div class="col col-6">
                <div class="subscribe-footer text-right">
                    <h4><?php esc_html_e('Sign up for our newsletter', 'industry-dive'); ?></h4>
                    <button class="btn btn-white btn-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 485.2 485.2"><g><path class="st0" d="M485.2,363.9c0,10.6-3,20.5-7.8,29.2L324.2,221.7L475.8,89.1c5.9,9.4,9.4,20.3,9.4,32.2L485.2,363.9   L485.2,363.9z M242.6,252.8L453.5,68.3c-8.7-4.7-18.4-7.6-28.9-7.6H60.7c-10.5,0-20.3,2.9-28.9,7.6L242.6,252.8z M301.4,241.6   l-48.8,42.7c-2.9,2.5-6.4,3.7-10,3.7c-3.6,0-7.1-1.2-10-3.7l-48.8-42.7L28.7,415.2c9.3,5.8,20.2,9.3,32,9.3h363.9   c11.8,0,22.7-3.5,32-9.3L301.4,241.6z M9.4,89.1C3.6,98.4,0,109.4,0,121.3v242.6c0,10.6,3,20.5,7.8,29.2L161,221.6L9.4,89.1z"/></g></svg><span><?php esc_html_e('Subscribe', 'industry-dive'); ?></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>