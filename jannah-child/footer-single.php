<?php
/**
 * The template for displaying the footer
 *
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly


do_action( 'TieLabs/after_main_content' );

echo '<div class="footer-single">';
TIELABS_HELPER::get_template_part( 'templates/footer' );
echo '</div>';

?>

		</div><!-- #tie-wrapper /-->

		<?php get_sidebar( 'slide' ); ?>

	</div><!-- #tie-container /-->
</div><!-- .background-overlay /-->

<?php wp_footer(); ?>

</body>
</html>
