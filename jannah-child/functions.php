<?php

	function tie_logo(){

		$header_layout = tie_get_option( 'header_layout', 3 );

		$logo_args  = tie_logo_args();
		$logo_style = '';

		extract( $logo_args );

		// Logo URL
		$logo_url = ! empty( $logo_url ) ? $logo_url : home_url( '/' );

		// Logo Title
		$logo_title_attr = ! empty( $logo_title ) ? esc_attr( strip_tags( $logo_title ) ) : '';

		// Logo Margin
		if( $logo_margin_top || $logo_margin_bottom ){

			$logo_style   = array();
			$logo_style[] = $logo_margin_top    ? "margin-top: {$logo_margin_top}px;"       : '';
			$logo_style[] = $logo_margin_bottom ? "margin-bottom: {$logo_margin_bottom}px;" : '';

			$logo_style = 'style="'. join( ' ', array_filter( $logo_style ) ) .'"';
		}

		// Logo Type : Title
		if( $logo_type == 'title' ){

			$logo_class  = 'text-logo';
			$logo_output = apply_filters( 'TieLabs/Logo/text_logo', '<div class="logo-text">'. $logo_title .'</div>', $logo_title );
		}

		// Logo Type : Image
		else{

			$logo_size 	= '';
			$logo_class	= 'image-logo';

			// Logo Width and Height
			if( $logo_width && $logo_height ){

				$logo_size = 'width="'. esc_attr( $logo_width ) .'" height="'. esc_attr( $logo_height ) .'"';

				// ! Full Width Logo
				if( tie_get_option( 'full_logo' ) && $header_layout != 1 && $header_layout != 4 ){

				}
				else{
					$height_important = ( $logo_height < 60 ) ? ' !important' : '';

					$logo_size .= ' style="max-height:'. esc_attr( $logo_height ) .'px'. $height_important .'; width: auto;"';
				}

			}

			$logo_srcset = esc_attr( $logo_img );

			// Logo Retina
			if( $logo_retina && $logo_retina != $logo_img ){
				$logo_srcset = esc_attr( $logo_retina ) .' 2x, '. esc_attr( $logo_img ) .' 1x';
			}

			$is_skin_switcher_active = tie_is_skin_switcher_active();

			$default_logo_id = ( $logo_inverted && $is_skin_switcher_active ) ? ' id="tie-logo-default"' : '';

			/* Future Updates
			 * Mobile Logo
			 * <source media="(min-width: 992px)" srcset="" data-srcset="'. $logo_inverted_srcset .'">
			 * <source media="(max-width: 991px)" srcset="http://localhost:8888/wp/wp-content/uploads/2020/01/hoodie_6_front.jpg 2x, http://localhost:8888/wp/wp-content/uploads/2020/01/hoodie_6_front.jpg 1x">
			 */

			$logo_output = '
				<picture'. $default_logo_id .' class="tie-logo-default tie-logo-picture">
					<source class="tie-logo-source-default tie-logo-source" srcset="'. $logo_srcset .'">
					<img loading="lazy" class="tie-logo-img-default tie-logo-img" src="'. esc_attr( $logo_img ) .'" alt="'. $logo_title_attr .'" '. $logo_size .' />
				</picture>
			';

			if( $logo_inverted && $is_skin_switcher_active ){

				$logo_inverted_srcset = esc_attr( $logo_inverted );

				// Logo Inverted Retina
				if( $logo_inverted_retina && $logo_inverted_retina != $logo_inverted ){
					$logo_inverted_srcset = esc_attr( $logo_inverted_retina ) .' 2x, '. esc_attr( $logo_inverted ) .' 1x';
				}

				/*
				$logo_output .= '
					<picture id="tie-logo-inverted">
						<source id="tie-logo-inverted-source" srcset="'. tie_lazyload_placeholder('wide') .'" data-srcset="'. $logo_inverted_srcset .'">
						<img id="tie-logo-inverted-img" src="'. tie_lazyload_placeholder('wide') .'" data-src="'. esc_attr( $logo_inverted ) .'" alt="'. esc_attr( $logo_title ) .'" '. $logo_size .' />
					</picture>
				';
				*/

				$logo_output .= '
					<picture id="tie-logo-inverted" class="tie-logo-inverted tie-logo-picture">
						<source class="tie-logo-source-inverted tie-logo-source" id="tie-logo-inverted-source" srcset="'. $logo_inverted_srcset .'">
						<img loading="lazy" class="tie-logo-img-inverted tie-logo-img" id="tie-logo-inverted-img" src="'. esc_attr( $logo_inverted ) .'" alt="'. $logo_title_attr .'" '. $logo_size .' />
					</picture>
				';
			}

		}

		?>

		<div id="logo" class="<?php echo esc_attr( $logo_class ) ?>" <?php echo ( $logo_style ) ?>>

			<?php do_action( 'TieLabs/Logo/before_link' ); ?>

			<a title="<?php echo esc_attr( $logo_title_attr ) ?>" href="<?php echo esc_url( apply_filters( 'TieLabs/Logo/url', $logo_url ) ) ?>">
				<?php
					do_action( 'TieLabs/Logo/before_img_text' );
					echo $logo_output;
					do_action( 'TieLabs/Logo/after_img_text' );
				?>
			</a>

			<?php do_action( 'TieLabs/Logo/after_link' ); ?>

		</div><!-- #logo /-->

		<?php
	}

	remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_excerpt', 'wpautop' );
    remove_filter( 'comment_text', 'wpautop' );

	add_action( 'wp_enqueue_scripts', 'style_theme' );
	function style_theme() {
		wp_enqueue_style( 'custom', get_stylesheet_directory_uri() . '/css/custom.css' );
		wp_enqueue_style( 'lightgallery', get_stylesheet_directory_uri() . '/css/lightgallery.css' );
	}

	add_action( 'wp_enqueue_scripts', 'my_scripts' );
	function my_scripts(){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array(), true, true );
		wp_enqueue_script( 'gallery', get_stylesheet_directory_uri() . '/js/gallery.js', array(), true, true );
		wp_enqueue_script( 'lightgallery', get_stylesheet_directory_uri() . '/js/lightgallery/lightgallery.min.js', array(), '1.4.1', true );
		wp_enqueue_script( 'thumbnail', get_stylesheet_directory_uri() . '/js/lightgallery/lg-thumbnail.min.js', array(), '1.2.0', true );
		wp_enqueue_script( 'fullscreen', get_stylesheet_directory_uri() . '/js/lightgallery/lg-fullscreen.min.js', array(), '1.2.0', true );
	}

	add_filter( 'excerpt_length', function(){
    	return 20;
    } );

	add_shortcode( 'bonus-card', 'bonus_shortcode' );
    function bonus_shortcode( $atts ){
    	global $post;
    	$rg = (object) shortcode_atts( [
    		'id' => null
    	], $atts );
    	if( ! $post = get_post( $rg->id ) )
    		return '';

        $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

    	$out = '
            <div class="bonus-card">
                <div class="bonus-top">
                    <div class="bonus-card__img">
                        <a href="'.esc_attr( $post->linkbonus ).'">
                            <img loading="lazy" src="'.$url.'" alt="'.get_the_title().'">
                        </a>
                    </div>
                    <div class="bonus-card__content">
                        <span class="bonus-card__title">Sport bonus:</span>
                        <span class="bonus-card__descr">'.esc_attr( $post->description ).'</span>
                    </div>
                    <a href="'.esc_attr( $post->linkbonus ).'" class="btn-offer bonus" rel="nofollow noopener">Claim</a>
                </div>
                <div class="bonus-bottom">
                    <span>Turnover: <strong>'.esc_attr( $post->turnover ).'</strong></span>
                    <span>Lowest odds: <strong>'.esc_attr( $post->odds ).'</strong></span>
                    <span>Bonus code: <strong>'.esc_attr( $post->code ).'</strong></span>
                </div>
            </div>
    	';

    	wp_reset_postdata();

    	return $out;
    }

    add_action( 'init', 'register_post_types' );
    function register_post_types() {
        register_post_type( 'News', [
            'label'  => null,
            'labels' => [
                'name'               => 'News',
                'singular_name'      => 'Новость',
                'add_new'            => 'Добавить новость',
                'add_new_item'       => 'Добавление новостей',
                'edit_item'          => 'Редактирование новостей',
                'new_item'           => 'Новая новость',
                'view_item'          => 'Смотреть новости',
                'search_items'       => 'Искать новости',
                'not_found'          => 'Не найдено',
                'not_found_in_trash' => 'Не найдено в корзине',
                'parent_item_colon'  => '',
                'menu_name'          => 'Новости',
            ],
            'description'         => '',
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'capability_type' 	  => 'post',
            'show_in_rest'        => null,
            'rest_base'           => null,
            'menu_position'       => null,
            'menu_icon'           => null,
            'hierarchical'        => false,
            'supports'            => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
            'taxonomies'          => [ 'category' ],
            'has_archive'         => true,
            'rewrite'             => true,
            'query_var'           => true,
            'hide_empty'          => true,
        ]);
    }

    add_shortcode( 'news-list', 'news_shortcode' );
    function news_shortcode() {
        $args = array(
            'post_type' => 'news',
            'orderby' => 'none',
            'posts_per_page' => '4'
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>BEST BETTING BONUSES FOR IPL 2022!</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="news-block">';
                echo '<div class="page-container">';
                    echo '<div class="news-row">';
                        while($query->have_posts()) : $query->the_post();
                            echo '<div class="news-col">';
                                echo '<div class="news-item">';
                                    echo '<a href="'.get_permalink().'" aria-label="'.get_the_title().'">';
                                        echo '<div class="news-image">';
                                           echo the_post_thumbnail();
                                        echo '</div>';
                                        echo '<div class="news-body">';
                                            echo '<span class="news-title">'.get_the_title().'</span>';
                                            echo '<span class="news-date">'.get_field( 'date' ).'</span>';
                                            echo '<p class="news-text">'.get_the_excerpt().'</p>';
                                        echo '</div>';
                                    echo '</a>';
                                echo '</div>';
                            echo '</div>';
                        endwhile;
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'betting-sites', 'betting_shortcode' );
    function betting_shortcode() {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'none',
            'posts_per_page' => '7'
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>Betting Sites</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="cards">';
                echo '<div class="page-container">';
                    while($query->have_posts()) : $query->the_post();
                        $category = get_field('category-brend');
                        $headColor = get_field('head-color');
                        $pros = get_field('pros');
                        $minuses = get_field('minuses');
                        $bonus = get_field('bonus');
                        $website = get_field('website');
                        $thirdFact = get_field('third-fact');
                        $factFour = get_field('fact-four');
                        $screenOne = get_field('screen-one');
                        $screenTwo = get_field('screen-two');
                        $screenThree = get_field('screen-three');
                        $screenFour = get_field('screen-four');
                        $screenFive = get_field('screen-five');
                        $screenSix = get_field('screen-six');
                        $fiveRating = get_field('rating');
                        $twenty = 20;
                        echo '<div class="card-item">';
                            echo '<div class="card-item__open">';
                                echo '<div class="card-item__left">';
                                    echo '<a href="'.get_permalink().'" style="background-color: '.get_field('head-color').'">';
                                        echo '<div class="card-item__logo">';
                                            echo the_post_thumbnail();
                                        echo '</div>';
                                        echo '<div class="card-item__rating">';
                                            echo '<div class="stars">';
                                                echo '<span class="icon-star">★</span>';
                                                echo '<span class="icon-star">★</span>';
                                                echo '<span class="icon-star">★</span>';
                                                echo '<span class="icon-star">★</span>';
                                                echo '<span class="icon-star">★</span>';
                                                echo '<div class="stars-color" style="width: '.get_field('rating').'%;">';
                                                    echo '<span class="icon-star">★</span>';
                                                    echo '<span class="icon-star">★</span>';
                                                    echo '<span class="icon-star">★</span>';
                                                    echo '<span class="icon-star">★</span>';
                                                    echo '<span class="icon-star">★</span>';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="card-item__value">';
                                                echo '<span>'.$fiveRating / $twenty.'</span> / 5';
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<span class="read-more">Read review</span>';
                                    echo '</a>';
                                echo '</div>';
                                echo '<div class="card-item__right">';
                                    echo '<div class="advantages">';
                                        echo '<div class="advantages-title">';
                                            echo '<h3>'.get_the_title().'</h3>';
                                            if ($headColor && $category) {
                                                echo '<div class="category-card" style="background-color: '.$headColor.'">';
                                                    echo '<div class="corner">';
                                                        echo '<div class="corner-filter"></div>';
                                                    echo '</div>';
                                                    echo '<span>'.$category.'</span>';
                                                echo '</div>';
                                            }
                                        echo '</div>';
                                        echo '<div class="advantages-descr">';
                                            if ($pros) {
                                                echo '<ul class="pros">';
                                                    echo $pros;
                                                echo '</ul>';
                                            }
                                            if ($minuses) {
                                                echo '<ul class="minuses">';
                                                    echo $minuses;
                                                echo '</ul>';
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="card-bonus">';
                                        echo '<div class="card-bonus__block">';
                                            echo '<span class="card-bonus__title">Welcome Offer</span>';
                                            if ($bonus) {
                                                echo '<div class="card-bonus__text">'.$bonus.'</div>';
                                            }
                                            echo '<button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>';
                                            echo '<button onclick="document.location='.get_field('link').'" class="link-site">Go to website</button>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-item__hidden">';
                                echo '<div class="hidden-block">';
                                    echo '<div class="column-left">';
                                        echo '<div class="company-info">';
                                            echo '<div class="company-info__column">';
                                                if ($website) {
                                                    echo '<span>';
                                                        echo '<b>Website: </b>';
                                                        echo '<a href="'.get_field('link').'">'.$website.'</a>';
                                                    echo '</span>';
                                                }
                                                echo '<span>';
                                                   echo '<b>Owner: </b>';
                                                   echo the_title();
                                                echo '</span>';
                                            echo '</div>';
                                            echo '<div class="company-info__column">';
                                                if ($thirdFact) {
                                                    echo '<span><b>Founded:</b> '.$thirdFact.'</span>';
                                                }
                                                if ($factFour) {
                                                    echo '<span><b>Headquarters:</b> '.$factFour.'</span>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<div class="company-screenshots lightgallery">';
                                            if ($screenOne) {
                                                echo '<a href="'.$screenOne.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenOne.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                            if ($screenTwo) {
                                                echo '<a href="'.$screenTwo.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenTwo.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                            if ($screenThree) {
                                                echo '<a href="'.$screenThree.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenThree.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                            if ($screenFour) {
                                                echo '<a href="'.$screenFour.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenFour.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                            if ($screenFive) {
                                                echo '<a href="'.$screenFive.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenFive.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                            if ($screenSix) {
                                                echo '<a href="'.$screenSix.'" class="company-screenshots__item">';
                                                    echo '<img loading="lazy" width="122" height="71" src="'.$screenSix.'" alt="screenshot one">';
                                                    echo '<div class="thumbnails-back"></div>';
                                                echo '</a>';
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="column-right">';
                                        echo '<div class="author-block">';
                                            echo '<div class="author-title">';
                                                echo '<h4>Summary</h4>';
                                                echo '<div class="author-title__icon">';
                                                    echo '<span>Author: '.get_field('name-author').'</span>';
                                                    echo '<img loading="lazy" width="40" height="40" src="'.get_field('img-author').'" alt="Author">';
                                                echo '</div>';
                                            echo '</div>';
                                            echo '<div class="author-text">';
                                                echo get_field('overview-author');
                                                echo '<a href="'.get_field('img-author').'" class="read-full" style="background: url('.get_stylesheet_directory_uri().'/img/arrow-red.svg) no-repeat right">Read full review</a>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-item__show">';
                                echo '<img loading="lazy" class="show-btn" width="17" height="17" src="https://bubnovseo.ru/wp-content/themes/jannah-child/img/icon-down-arrow.svg" alt="Arrow down">';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                echo '</div>';
            echo '</div>';
            echo '<div class="more-sites">';
                echo '<a href="#" class="more-sites__link">MORE BETTING SITES</a>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'welcome-bonuses', 'welcome_shortcode' );
    function welcome_shortcode() {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'none',
            'posts_per_page' => '20'
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>Betting Sites with Welcome Bonuses</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="cards">';
                echo '<div class="page-container">';
                    echo '<div class="table-head">';
                        echo '<div class="table-title first">Rank</div>';
                        echo '<div class="table-title second">Bookmaker</div>';
                        echo '<div class="table-title third">Bonus</div>';
                        echo '<div class="table-title four">Turnover</div>';
                        echo '<div class="table-title five">Min odds</div>';
                        echo '<div class="table-title six"></div>';
                    echo '</div>';
                    echo '<div class="table-items">';
            	        while($query->have_posts()) : $query->the_post();
            	            $turnover = get_field('turnover');
            	            $tcs = get_field('tcs-apply');
                            echo '<div class="table-item">';
                                echo '<div class="table-colums">';
                                    echo '<div class="table-col count">'.get_field('number').'</div>';
                                    echo '<div class="table-middle">';
                                        echo '<div class="table-col logo">';
                                            echo '<a href="'.get_permalink().'">';
                                                echo '<img loading="lazy" width="35" height="35" src="'.get_field('img-min').'" alt="Betway min">';
                                                echo '<h3>'.get_the_title().'</h3>';
                                            echo '</a>';
                                        echo '</div>';
                                        echo '<div class="table-col bonus">';
                                            echo '<p>'.get_field('bonus').'</p>';
                                        echo '</div>';
                                        echo '<div class="table-col turn">';
                                            echo '<span class="mobile-text">Turnover: </span>';
                                            if ($turnover) {
                                                echo '<span class="turn-text"><strong>'.$turnover.'</strong> bonus amount</span>';
                                            } else {
                                                echo '<span class="turn-text">No requirements</span>';
                                            }
                                        echo '</div>';
                                        echo '<div class="table-col odds">';
                                            echo '<span class="mobile-text">Lowest odds: </span>';
                                            echo '<span>'.get_field('odds').'</span>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="table-col btn">';
                                        echo '<button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>';
                                        echo '<button onclick="document.location='.get_field('link').'" class="link-site">Go to website</button>';
                                    echo '</div>';
                                echo '</div>';
                                if ($tcs) {
                                    echo '<div class="table-terms">';
                                        echo '<p>'.$tcs.'</p>';
                                    echo '</div>';
                                }
                            echo '</div>';
            	        endwhile;
            	    echo '</div>';
            	echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'ultimate-guide', 'guide_shortcode' );
    function guide_shortcode() {
        ob_start();
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>Your Ultimate Guide to Betting Sites in India!</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            $contentText = get_field('guide');
            $grayCard = get_field('gray');
            echo '<div class="text-block">';
                echo '<div class="page-container">';
                    echo '<div class="text-row">';
                        if ($contentText && $grayCard) {
                            echo '<div class="text-col">'.$contentText.'</div>';
                            echo '<div class="text-col">';
                                echo '<div class="text-content">';
                                    echo '<div class="text-facts">'.$grayCard.'</div>';
                                echo '</div>';
                            echo '</div>';
                        } else if ($contentText) {
                            echo '<div class="text-col full">'.$contentText.'</div>';
                        } else {
                            echo '<div class="text-col full">';
                                echo '<div class="text-content">';
                                    echo '<div class="text-facts">'.$grayCard.'</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'popular-guide', 'popular_shortcode' );
    function popular_shortcode() {
        ob_start();
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>Some of our Most Popular Guides</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="links-block">';
                echo '<div class="page-container">';
                    echo '<ul class="text-row">';
                        echo wp_list_pages('include=17&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/cricket-icon.svg" alt="cricket icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                        echo wp_list_pages('include=14&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/ipl-icon.svg" alt="ipl 2021 icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                        echo wp_list_pages('include=311&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/green-square-icon.svg" alt="green square icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                        echo wp_list_pages('include=19&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/yellow-wallet-icon.svg" alt="yellow wallet icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                        echo wp_list_pages('include=309&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/football-green-icon.svg" alt="football icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                        echo wp_list_pages('include=307&title_li=&link_before=<div class="link-logo">
                          <img loading="lazy" width="40" height="40" src="'.get_stylesheet_directory_uri().'/img/icons/document-orange-icon.svg" alt="document icon">
                          </div>&link_after=<div class="arrow-link"></div>');
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'top-block', 'top_shortcode' );
    function top_shortcode() {
        ob_start();
        echo '<div class="main-back" style="background-image: url('.get_stylesheet_directory_uri().'/img/main-banner.jpeg);">';
            echo '<div class="page-container">';
                echo '<div class="back-wrapper">';
                    echo '<div class="back-column">';
                        echo '<div class="back-box">';
                            echo '<span class="back-title">'.get_field('top-title-main').'</span>';
                            echo '<span class="back-subtitle">'.get_field('subtitle-main').'</span>';
                            echo '<p class="back-descr">'.get_field('top-text-main').'</p>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="back-column">';
                        echo '<div class="back-box">';
                            echo '<ul class="back-item">';
                                echo wp_list_pages('include=17&title_li=&link_before=<div style="background-image: url('.get_stylesheet_directory_uri().'/img/icons/india-flag.svg)" class="back-item__img one"></div>
                                    &link_after=<div class="back-icon__arrow" style="background-image: url('.get_stylesheet_directory_uri().'/img/right-arrow-white.svg)"></div>');
                            echo '</ul>';
                            echo '<ul class="back-item">';
                                echo wp_list_pages('include=307&title_li=&link_before=<div style="background-image: url('.get_stylesheet_directory_uri().'/img/icons/icon-green.svg)" class="back-item__img two"></div>
                                    &link_after=<div class="back-icon__arrow" style="background-image: url('.get_stylesheet_directory_uri().'/img/right-arrow-white.svg)"></div>');
                            echo '</ul>';
                            echo '<ul class="back-item">';
                                echo wp_list_pages('include=321&title_li=&link_before=<div style="background-image: url('.get_stylesheet_directory_uri().'/img/icons/document-icon.svg)" class="back-item__img three"></div>
                                    &link_after=<div class="back-icon__arrow" style="background-image: url('.get_stylesheet_directory_uri().'/img/right-arrow-white.svg)"></div>');
                            echo '</ul>';
                            echo '<ul class="back-item">';
                                echo wp_list_pages('include=19&title_li=&link_before=<div style="background-image: url('.get_stylesheet_directory_uri().'/img/icons/cricket-icon.svg)" class="back-item__img four"></div>
                                    &link_after=<div class="back-icon__arrow" style="background-image: url('.get_stylesheet_directory_uri().'/img/right-arrow-white.svg)"></div>');
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'faq-block', 'faq_shortcode' );
    function faq_shortcode() {
        ob_start();
            echo '<div class="faq-block" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-back.png)">';
                echo '<div class="page-container">';
                    echo '<div class="page-title faq">';
                        echo '<h2>Frequently Asked Questions about Betting Sites</h2>';
                        echo '<p>'.get_field('subtitle-faq').'</p>';
                    echo '</div>';
                    $faqTitle = get_field('faq-title');
                    $faqAnswer = get_field('faq-answer');
                    $faqTitleTwo = get_field('faq-title-two');
                    $faqAnswerTwo = get_field('faq-answer-two');
                    $faqTitleThree = get_field('faq-title-three');
                    $faqAnswerThree = get_field('faq-answer-three');
                    $faqTitleFour = get_field('faq-title-four');
                    $faqAnswerFour = get_field('faq-answer-four');
                    $faqTitleFive = get_field('faq-title-five');
                    $faqAnswerFive = get_field('faq-answer-five');
                    $faqTitleSix = get_field('faq-title-six');
                    $faqAnswerSix = get_field('faq-answer-six');
                    $faqTitleSeven = get_field('faq-title-seven');
                    $faqAnswerSeven = get_field('faq-answer-seven');
                    $faqTitleEight = get_field('faq-title-eight');
                    $faqAnswerEight = get_field('faq-answer-eight');
                    echo '<div class="text-row">';
                        echo '<div class="text-col">';
                            if ($faqTitle && $faqAnswer) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 itemprop="name" class="faq-title__head">'.$faqTitle.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswer.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleThree && $faqAnswerThree) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleThree.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerThree.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleFive && $faqAnswerFive) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleFive.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerFive.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleSeven && $faqAnswerSeven) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleSeven.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerSeven.'</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                        echo '<div class="text-col">';
                            if ($faqTitleTwo && $faqAnswerTwo) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleTwo.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerTwo.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleFour && $faqAnswerFour) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleFour.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerFour.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleSix && $faqAnswerSix) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleSix.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerSix.'</div>';
                                echo '</div>';
                            }
                            if ($faqTitleEight && $faqAnswerEight) {
                                echo '<div class="faq-section" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">';
                                    echo '<div class="faq-title">';
                                        echo '<h3 class="faq-title__head" itemprop="name">'.$faqTitleEight.'</h3>';
                                        echo '<span class="faq-icon" style="background-image: url('.get_stylesheet_directory_uri().'/img/faq-arrow.svg)"></span>';
                                    echo '</div>';
                                    echo '<div class="faq-answer" itemscope itemprop="mainEntity" itemtype="https://schema.org/Answer">'.$faqAnswerEight.'</div>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'img-block', 'img_shortcode' );
    function img_shortcode() {
        ob_start();
            echo '<div class="page-title">';
                echo '<div class="page-container">';
                    echo '<h2>No. 1 Betting Site in India!</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="page-image">';
                echo '<div class="page-container">';
                    echo get_field('img-block');
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'card-block', 'card_shortcode' );
    function card_shortcode() {
        $idPost = get_field('id');
        $args = array(
            'post_type' => 'post',
            'post__in' => [$idPost]
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            while($query->have_posts()) : $query->the_post();
                $pros = get_field('pros');
                $turnover = get_field('turnover');
                echo '<div class="card-block">';
                    echo '<div class="page-container">';
                        echo '<div class="card-row">';
                            echo '<div class="card-col">';
                                echo '<a class="card-logo" href="'.get_permalink().'" style="background-color: '.get_field('head-color').'" aria-label="'.get_the_title().'">';
                                    echo the_post_thumbnail();
                                echo '</a>';
                                echo '<div class="stars">';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<span class="icon-star">★</span>';
                                    echo '<div class="stars-color" style="width:'.get_field('rating').'%;">';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                        echo '<span class="icon-star">★</span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-col-md">';
                                echo '<span class="card-col__rating">Our rating:</span>';
                                echo '<ul>';
                                  echo $pros;
                                echo '</ul>';
                            echo '</div>';
                            echo '<div class="card-col-md">';
                                echo '<div class="card-col__bonus">';
                                    echo '<div class="card-col__text">';
                                        echo '<span class="card-col__sport">Sport bonus:</span>';
                                        echo '<span class="card-col__descr">'.get_field('bonus').'</span>';
                                    echo '</div>';
                                    echo '<div class="card-col__bottom">';
                                        echo '<span>Turnover: ';
                                            if ($turnover) {
                                                echo '<strong>'.$turnover.' bonus amount</strong>';
                                            } else {
                                                echo '<strong>No requirements</strong>';
                                            }
                                        echo '</span>';
                                        echo '<span>Lowest odds: ';
                                            echo '<strong>'.get_field('odds').'</strong>';
                                        echo '</span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="card-col">';
                                echo '<div class="card-col__buttons">';
                                    echo '<button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>';
                                    echo '<a href="'.get_permalink().'" class="link-site">Read review</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            endwhile;
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'recent-news', 'recent_shortcode' );
    function recent_shortcode() {
        $args = array(
            'post_type' => 'news',
            'orderby' => 'none',
            'posts_per_page' => '8',
            'cat' => '7',
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="text-col">';
                echo '<div class="page-title">';
                    echo '<h2>Recent Betting Site Articles!</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
                echo '<div class="recent-items">';
                    while($query->have_posts()) : $query->the_post();
                        echo '<div class="recent-item">';
                            echo '<div class="recent-teaser">';
                                echo '<a href="'.get_permalink().'">';
                                    echo '<h3>'.get_the_title().'</h3>';
                                    echo '<p class="recent-text">'.get_the_excerpt().'</p>';
                                echo '</a>';
                            echo '</div>';
                            echo '<div class="recent-image">';
                                echo '<a href="'.get_permalink().'" aria-label="'.get_the_title().'">';
                                    echo the_post_thumbnail();
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'popular-news', 'popular_news_shortcode' );
    function popular_news_shortcode() {
        $args = array(
            'post_type' => 'news',
            'orderby' => 'none',
            'posts_per_page' => '3',
            'cat' => '8',
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="text-col">';
                echo '<div class="page-title">';
                    echo '<h2>Popular Articles about Betting Sites!</h2>';
                    echo '<div class="line"></div>';
                echo '</div>';
                echo '<div class="article-columns">';
                    while($query->have_posts()) : $query->the_post();
                        echo '<div class="article-col">';
                            echo '<div class="article-image">';
                                echo '<a href="'.get_permalink().'" aria-label="'.get_the_title().'">';
                                    echo the_post_thumbnail();
                                echo '</a>';
                            echo '</div>';
                            echo '<div class="article-teaser">';
                                echo '<a href="'.get_permalink().'">';
                                    echo '<h3>'.get_the_title().'</h3>';
                                    echo '<p class="recent-text">'.get_the_excerpt().'</p>';
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'top-list', 'top_list_shortcode' );
    function top_list_shortcode() {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'none',
            'posts_per_page' => '10'
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="top-list">';
                echo '<h2>🎖️ Top 10 Betting Sites in India!</h2>';
                echo '<p>Here are the best betting sites in India:</p>';
                echo '<ol>';
                    while($query->have_posts()) : $query->the_post();
                        $topDesc = get_field('top-desc');
                        if($topDesc) {
                         echo '<li>';
                            echo '<strong>'.get_the_title().'</strong>';
                            echo '<span> - '.$topDesc.'</span>';
                         echo '</li>';
                        }
                    endwhile;
                echo '</ol>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'min-welcome-bonuses', 'min_welcome_shortcode' );
    function min_welcome_shortcode() {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'none',
            'posts_per_page' => '10'
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="page-title">';
                echo '<h2>Betting Sites</h2>';
                echo '<div class="line"></div>';
            echo '</div>';
            echo '<div class="cards">';
                echo '<div class="table-items">';
                    while($query->have_posts()) : $query->the_post();
                        $turnover = get_field('turnover');
                        $tcs = get_field('tcs-apply');
                        echo '<div class="table-item">';
                            echo '<div class="table-colums">';
                                echo '<div class="table-col count">'.get_field('number').'</div>';
                                echo '<div class="table-middle">';
                                    echo '<div class="table-col logo">';
                                        echo '<a href="'.get_permalink().'">';
                                            echo '<img loading="lazy" width="35" height="35" src="'.get_field('img-min').'" alt="Betway min">';
                                            echo '<h3>'.get_the_title().'</h3>';
                                        echo '</a>';
                                    echo '</div>';
                                    echo '<div class="table-col bonus">';
                                        echo '<p>'.get_field('bonus').'</p>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="table-col btn">';
                                    echo '<button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>';
                                echo '</div>';
                            echo '</div>';
                            if ($tcs) {
                                echo '<div class="table-terms">';
                                    echo '<p>'.$tcs.'</p>';
                                echo '</div>';
                            }
                        echo '</div>';
                    endwhile;
                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'main-sidebar', 'sidebar_shortcode' );
    function sidebar_shortcode() {
        ob_start();
            $sidebarImage = get_field('sidebar-img');
            $sidebarAlt = get_field('sidebar-alt');
            $sidebarTitle = get_field('sidebar-title');
            $sidebarDescription = get_field('sidebar-description');
            echo '<div class="sidebar-block">';
                echo '<div class="sidebar-wrapper">';
                   echo '<div class="sidebar-image">';
                       echo '<img loading="lazy" width="690" height="388" src="'.$sidebarImage.'" alt="'.$sidebarAlt.'">';
                   echo '</div>';
                   echo '<div class="sidebar-text">';
                        echo '<span class="sidebar-text__main">'.$sidebarTitle.'</span>';
                        echo '<p>'.$sidebarDescription.'</p>';
                   echo '</div>';
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

    add_shortcode( 'main-sidebar-two', 'sidebar_shortcode_two' );
    function sidebar_shortcode_two() {
        ob_start();
            $sidebarTwoImage = get_field('sidebar-two-img');
            $sidebarTwoAlt = get_field('sidebar-two-alt');
            $sidebarTwoDescription = get_field('sidebar-two-description');
            echo '<div class="sidebar-block">';
                echo '<div class="sidebar-title">';
                    echo '<h3>MEET THE EDITOR</h3>';
                    echo '<div class="line"></div>';
                echo '</div>';
                echo '<div class="sidebar-wrapper">';
                    echo '<div class="sidebar-text">';
                        echo '<p>'.$sidebarTwoDescription.'</p>';
                    echo '</div>';
                    echo '<div class="sidebar-image">';
                       echo '<img loading="lazy" width="690" height="690" src="'.$sidebarTwoImage.'" alt="'.$sidebarTwoAlt.'">';
                   echo '</div>';
                echo '</div>';
            echo '</div>';
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
    }

     add_shortcode( 'main-sidebar-three', 'sidebar_shortcode_three' );
     function sidebar_shortcode_three() {
        $args = array(
            'post_type' => 'news',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'posts_per_page' => '10',
        );
        $query = new WP_Query( $args );
        ob_start();
        if ( $query->have_posts() ) {
            echo '<div class="sidebar-block">';
                echo '<div class="sidebar-title list">';
                    echo '<h3>OUR LATEST ARTICLES</h3>';
                    echo '<div class="line"></div>';
                echo '</div>';
                echo '<div class="recent-items">';
                    while($query->have_posts()) : $query->the_post();
                        echo '<div class="recent-item">';
                            echo '<div class="recent-image">';
                                echo '<a href="'.get_permalink().'" aria-label="'.get_the_title().'">';
                                    echo the_post_thumbnail();
                                echo '</a>';
                            echo '</div>';
                            echo '<div class="recent-teaser">';
                                echo '<a href="'.get_permalink().'">';
                                    echo '<h3>'.get_the_title().'</h3>';
                                echo '</a>';
                            echo '</div>';
                        echo '</div>';
                    endwhile;
                echo '</div>';
            echo '</div>';
        }
        wp_reset_postdata();
        $output = ob_get_clean();
        return $output;
     }

     add_shortcode( 'main-sidebar-four', 'sidebar_shortcode_four' );
     function sidebar_shortcode_four() {
         $args = array(
             'post_type' => 'post',
             'orderby' => 'none',
             'posts_per_page' => '10'
         );
         $query = new WP_Query( $args );
         ob_start();
         if ( $query->have_posts() ) {
             /*()echo '<div class="sidebar-block">';
                 echo '<div class="sidebar-title list">';
                     echo '<h3>OUR DETAILED GUIDES</h3>';
                     echo '<div class="line"></div>';
                 echo '</div>';
                 echo '<div class="page-list">';
                    echo wp_list_pages('title_li=&link_after=<div class="arrow-link"></div>&link_before=<div>'.get_the_post_thumbnail().'</div>');
                 echo '</div>';
             echo '</div>';*/
             echo '<div class="sidebar-block">';
                  echo '<div class="sidebar-title list">';
                      echo '<h3>Betting Sites</h3>';
                      echo '<div class="line"></div>';
                  echo '</div>';
                  echo '<div class="cards">';
                      echo '<div class="table-items">';
                          while($query->have_posts()) : $query->the_post();
                              $turnover = get_field('turnover');
                              $tcs = get_field('tcs-apply');
                              echo '<div class="table-item">';
                                  echo '<div class="table-colums">';
                                      echo '<div class="table-middle">';
                                          echo '<div class="table-col logo">';
                                              echo '<a href="'.get_permalink().'">';
                                                  echo '<img loading="lazy" width="35" height="35" src="'.get_field('img-min').'" alt="Betway min">';
                                                  echo '<h3>'.get_the_title().'</h3>';
                                              echo '</a>';
                                          echo '</div>';
                                          echo '<div class="table-col bonus">';
                                              echo '<p>'.get_field('bonus').'</p>';
                                          echo '</div>';
                                      echo '</div>';
                                      echo '<div class="table-col btn">';
                                          echo '<button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>';
                                      echo '</div>';
                                  echo '</div>';
                                  if ($tcs) {
                                      echo '<div class="table-terms">';
                                          echo '<p>'.$tcs.'</p>';
                                      echo '</div>';
                                  }
                              echo '</div>';
                          endwhile;
                      echo '</div>';
                  echo '</div>';
             echo '</div>';
         }
         wp_reset_postdata();
         $output = ob_get_clean();
         return $output;
     }






