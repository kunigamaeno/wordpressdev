<?php
/**
 * The template for displaying the Search Form
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package fullbase
 */
 ?>
 <form class="search-light" role="search" method="get" action="<?php echo home_url(); ?>">

    <input type="text" placeholder="<?php esc_html_e('Search', 'fullbase'); ?>" name="s">

    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>

</form>
