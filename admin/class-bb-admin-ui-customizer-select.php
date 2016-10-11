<?php

/**
 * BHF_Customize_Select setup
 *
 * @since 1.2
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	class BHF_Customize_Select extends WP_Customize_Control {

		private $all_posts = array();
		private $args = array();

		public $type = 'bhf_pages';


		public function __construct( $manager, $id, $args = array(), $options = array() ) {

			$this->args = $args;

			$this->all_posts = array();

			$atts = array(
				'post_type'      => array(
					'fl-builder-template',
					'page'
				),
				'posts_per_page' => 200,
				'cache_results'  => true
			);

			$query = new WP_Query( $atts );

			if ( $query->have_posts() ) {

				while ( $query->have_posts() ) {
					$query->the_post();
					$title = get_the_title();
					$ID    = get_the_id();

					$this->all_posts[ get_post_type() ][ $ID ] = $title;
				}

			}

			parent::__construct( $manager, $id, $args );
		}


		/**
		 * Render the control's content.
		 */
		public function render_content() {

			?>
			<label>
   			 <span class="customize-control-title">
   				 <?php echo esc_html( $this->label ); ?>
   			 </span>
   			  <span class="description customize-control-description">
   				 <?php echo esc_html( $this->description ); ?>
   			 </span>
				<?php

				echo '<select name="' . $this->id . '" ' . $this->get_link() . '>';
				echo '<option value="">' . $this->label . '</option>';

				foreach ( $this->all_posts as $post_type => $posts ) {
					echo '<optgroup label="' . ucwords( str_replace( "-", " ", $post_type ) ) . '">';

					foreach ( $posts as $id => $post_name ) {
						echo '<option value="' . $id . '" ' . selected( $id, $this->value() ) . ' >' . $post_name . '</option>';
					}

					echo '</optgroup>';
				}

				echo '</select>';

				?>
			</label>
			<?php

		}
	}

}


