<!-- CONTAINER -->
<?php
	$llorix_one_header_title = get_theme_mod('parallax_one_header_title','Simple, Reliable and Awesome.');
	$llorix_one_header_subtitle = get_theme_mod('parallax_one_header_subtitle','Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
	$llorix_one_header_button_text = get_theme_mod('parallax_one_header_button_text','GET STARTED');
	$llorix_one_header_button_link = get_theme_mod('parallax_one_header_button_link','#');
	$llorix_one_enable_move = get_theme_mod('paralax_one_enable_move');
	$llorix_one_first_layer = get_theme_mod('paralax_one_first_layer', llorix_one_get_file('/images/background1.png'));
	$llorix_one_second_layer = get_theme_mod('paralax_one_second_layer',llorix_one_get_file('/images/background2.png'));
	if(!empty($llorix_one_header_title) || !empty($llorix_one_header_subtitle) || !empty($llorix_one_header_button_text)){
?>

<?php
	if( !empty($llorix_one_enable_move) && $llorix_one_enable_move ) {
		
		echo '<ul id="parallax_move">';


			if ( empty($llorix_one_first_layer) && empty($llorix_one_second_layer) ) {

				$llorix_one_header_image2 = get_header_image();
				echo '<li class="layer layer1" data-depth="0.10" style="background-image: url('.$llorix_one_header_image2.');"></li>';

			} else {

				if( !empty($llorix_one_first_layer) )  {
					echo '<li class="layer layer1" data-depth="0.10" style="background-image: url('.$llorix_one_first_layer.');"></li>';
				}
				if( !empty($llorix_one_second_layer) ) {
					echo '<li class="layer layer2" data-depth="0.20" style="background-image: url('.$llorix_one_second_layer.');"></li>';
				}

			}

		echo '</ul>';

	}
?>

	<div class="overlay-layer-wrap">
		<div class="container overlay-layer" id="parallax_header">

			<div class="row">
				<div class="col-md-12 intro-section-text-wrap">

					<!-- HEADING AND BUTTONS -->
					<?php 
					if(!empty($llorix_one_header_title) || !empty($llorix_one_header_subtitle) || !empty($llorix_one_header_button_text)){?>
						<div id="intro-section" class="intro-section">

							<!-- WELCOM MESSAGE -->
							<?php
								if( !empty($llorix_one_header_title) ){
									echo '<h1 id="intro_section_text_1" class="intro white-text">'.esc_attr($llorix_one_header_title).'</h1>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<h1 id="intro_section_text_1" class="intro white-text paralax_one_only_customizer"></h1>';
								}
							?>


							<?php
								if( !empty($llorix_one_header_subtitle) ){
									echo '<h5 id="intro_section_text_2" class="white-text">'.esc_attr($llorix_one_header_subtitle).'</h5>';
								} elseif ( isset( $wp_customize )   ) {
									echo '<h5 id="intro_section_text_2" class="white-text paralax_one_only_customizer"></h5>';
								}
							?>

							<!-- BUTTON -->
							<?php
								if( !empty($llorix_one_header_button_text) ){
									if( empty($llorix_one_header_button_link) ){
										echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll"><span class="screen-reader-text">'.esc_html__('Header button label:','llorix-one').$llorix_one_header_button_text.'</span>'.$llorix_one_header_button_text.'</button>';
									} else {
										if(strpos($llorix_one_header_button_link, '#') === 0) {
											echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll" data-anchor="'.$llorix_one_header_button_link.'"><span class="screen-reader-text">'.esc_html__('Header button label:','llorix-one').$llorix_one_header_button_text.'</span>'.$llorix_one_header_button_text.'</button>';
										} else {
											echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll" onClick="parent.location=\''.esc_url($llorix_one_header_button_link).'\'"><span class="screen-reader-text">'.esc_html__('Header button label:','llorix-one').$llorix_one_header_button_text.'</span>'.$llorix_one_header_button_text.'</button>';
										}
									}
								} elseif ( isset( $wp_customize )   ) {
									echo '<div id="intro_section_text_3" class="button"><div id="inpage_scroll_btn"><a href="" class="btn btn-primary standard-button inpage-scroll paralax_one_only_customizer"></a></div></div>';
								}
							?>
							<!-- /END BUTTON -->

						</div>
						<!-- /END HEADNING AND BUTTONS -->
					<?php
					}
					?>
				</div>
			</div>
			</div>
		</div>

<?php
	}
?>
