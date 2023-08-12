<?php get_header(); ?>

<div class="single-top" style="background-color: <?php echo get_field('head-color'); ?>;">
	<div class="page-container">
		<div class="text-row">
			<div class="text-col">
				<div class="logo-brand">
					<?php echo get_the_post_thumbnail($item->ID); ?>
				</div>
				<div class="rating-brand">
					<span class="rating-title"><?php the_title(); ?> review:</span>
					<div class="stars">
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<span class="icon-star">★</span>
						<div class="stars-color" style="width: <?php echo get_field('rating'); ?>%;">
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
							<span class="icon-star">★</span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-col">
				<h1 class="single-h1"><?php the_title(); ?></h1>
				<span class="single-bonus"><?php echo get_field('bonus'); ?></span>
				<div class="single-buttons">
					<button onclick="document.location='<?php echo get_field('link'); ?>'" class="btn-offer single">Claim</button>
					<button onclick="document.location='<?php echo get_field('link'); ?>'" class="link-site single">visit the website</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="single-content">
	<div class="page-container">
		<?php echo get_field('content'); ?>
	</div>
</div>
<div class="single-columns">
	<div class="page-container">
		<div class="text-row">
			<div class="single-col-left">
				<div class="single-title">
					<h2>Betway overview</h2>
					<div class="line"></div>
				</div>
				<div class="single-author">
					<div class="single-author__left">
						<img loading="lazy" width="52" height="52" src="<?php echo get_field('img-author'); ?>" alt="<?php echo get_field('name-author'); ?>">
						<span><?php echo get_field('name-author'); ?></span>
					</div>
					<div class="single-author__text">
						<?php echo get_field('overview-author'); ?>
					</div>
				</div>
				<div class="score-block">
				    <div class="single-subtitle">
				        <h3>Betway score</h3>
                        <div class="line"></div>
				    </div>
				    <div class="score-wrapper">
				        <div class="pros-block">
				            <?php
                                $pros = get_field('pros');
                                $minuses = get_field('minuses');
                            ?>
                            <?php if ($pros) { ?>
                                <ul class="pros">
                                    <?php echo $pros; ?>
                                </ul>
                            <?php } ?>
		                    <?php if ($minuses) { ?>
                                 <ul class="minuses">
                                     <?php echo $minuses; ?>
                                 </ul>
                            <?php } ?>
				        </div>
				        <?php
                            $bonusOffer = get_field('bonus-offer');
                            $bettingVariety = get_field('betting-variety');
                            $mobExperience = get_field('mobile-experience');
                            $payOptions = get_field('payment-options');
                            $betExperience = get_field('betting-experience');
                            $support = get_field('support');
                            $summary = get_field('summary');
                        ?>
				        <div class="review-block">
				            <?php if ($bonusOffer) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Bonus offer</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $bonusOffer; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $bonusOffer; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($bettingVariety) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Betting variety</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $bettingVariety; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $bettingVariety; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($mobExperience) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Mobile experience</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $mobExperience; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $mobExperience; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($payOptions) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Payment options</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $payOptions; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $payOptions; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($betExperience) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Betting experience</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $betExperience; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $betExperience; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($support) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Support</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $support; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $support; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($summary) { ?>
                                <div class="review-item">
                                    <div class="review-item__left">
                                        <span>Summary</span>
                                    </div>
                                    <div class="review-item__right">
                                        <div class="stars">
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <span class="icon-star">★</span>
                                            <div class="stars-color" style="width: <?php echo $summary; ?>%;">
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                                <span class="icon-star">★</span>
                                            </div>
                                        </div>
                                        <div class="review-score"><?php echo $summary; ?>/100</div>
                                    </div>
                                </div>
                            <?php } ?>
				        </div>
				    </div>
				</div>
				<div class="screen-block">
                    <div class="single-subtitle">
                        <h3>Betway screenshots</h3>
                        <div class="line"></div>
                    </div>
                    <div class="company-screenshots lightgallery">
                        <a href="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" class="company-screenshots__item">
                            <img loading="lazy" src="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" alt="screenshot one">
                            <div class="thumbnails-back"></div>
                        </a>
                        <a href="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" class="company-screenshots__item">
                            <img loading="lazy" src="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" alt="screenshot one">
                            <div class="thumbnails-back"></div>
                        </a>
                        <a href="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" class="company-screenshots__item">
                            <img loading="lazy" src="https://bubnovseo.ru/wp-content/uploads/2022/04/betway-test.jpg" alt="screenshot one">
                            <div class="thumbnails-back"></div>
                        </a>
                    </div>
                </div>
                <div class="card-single">
                    <div class="card-single__open">
                        <div class="card-single__title">Betway quick facts</div>
                        <?php
                            $website = get_field('website');
                            $webLink = get_field('web-link');
                            $deposit = get_field('deposit');
                            $betting = get_field('betting');
                            $provider = get_field('provider');
                            $sup = get_field('sup');
                            $gameType = get_field('game-type');
                            $withdrawal = get_field('withdrawal-methods');
                            $casinoGame = get_field('casino-game');
                            $apps = get_field('apps');
                            $owner = get_field('owner');
                            $year = get_field('year');
                            $headquarters = get_field('headquarters');
                        ?>
                        <div class="card-single__content">
                            <div class="card-single__col">
                                <?php if ($website) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Website</span>
                                        <?php if ($webLink) { ?>
                                            <a href="<?php echo $webLink; ?>" rel="nofollow" target="_blank"><?php echo $website; ?></a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if ($deposit) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Deposit methods</span>
                                        <span><?php echo $deposit; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($betting) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Betting functions</span>
                                        <span><?php echo $betting; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($provider) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Casino provider</span>
                                        <span><?php echo $provider; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($sup) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Support</span>
                                        <span><?php echo $sup; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($year) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Support</span>
                                        <span><?php echo $year; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-single__col">
                                <?php if ($gameType) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Game Types</span>
                                        <span><?php echo $gameType; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($withdrawal) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Withdrawal methods</span>
                                        <span><?php echo $withdrawal; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($casinoGame) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Casino game types</span>
                                        <span><?php echo $casinoGame; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($apps) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Apps</span>
                                        <span><?php echo apps; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($owner) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Owner</span>
                                        <span><?php echo $owner; ?></span>
                                    </div>
                                <?php } ?>
                                <?php if ($headquarters) { ?>
                                    <div class="card-single__item">
                                        <span class="item-title">Headquarters</span>
                                        <span><?php echo $headquarters; ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-single__show">
                       <div class="single-icon__arrow" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/img/arrow-white.svg)"></div>
                    </div>
                </div>
                <div class="card-single__text">
                    <?php echo the_content(); ?>
                </div>
			</div>
			<div class="single-col-right">
			    <?php
			        $imgFirst = get_field('img-first');
			        $firstAlt = get_field('first-alt');
			        $firstTitle = get_field('first-title');
			        $firstDescription = get_field('first-descr');
			    ?>
			    <?php if ($firstTitle) { ?>
                    <div class="sidebar-block">
                        <div class="sidebar-wrapper">
                           <div class="sidebar-image">
                               <img loading="lazy" src="<?php echo $imgFirst; ?>" alt="<?php echo $firstAlt; ?>">
                           </div>
                           <div class="sidebar-text">
                                <span><?php echo $firstTitle; ?></span>
                                <p><?php echo $firstDescription; ?></p>
                           </div>
                        </div>
                    </div>
			    <?php } ?>
                <?php
                    $secondImage = get_field('second-image');
                    $secondAlt = get_field('second-alt');
                    $secondTitle = get_field('second-title');
                    $secondDescription = get_field('second-descr');
                    $secondTitleImg = get_field('second-title-img');
                ?>
                <?php if ($secondTitle) { ?>
                    <div class="sidebar-block">
                        <div class="sidebar-wrapper">
                            <div class="sidebar-text">
                                <h3><?php echo $secondTitle; ?></h3>
                                <p><?php echo $secondDescription; ?></p>
                            </div>
                           <div class="sidebar-image">
                               <img loading="lazy" width="690" height="690" src="<?php echo $secondImage; ?>" alt="<?php echo $secondAlt; ?>">
                               <span><?php echo $secondTitleImg; ?></span>
                           </div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                    $firstFact = get_field('first-fact');
                    $secondFact = get_field('second-fact');
                    $thirdFact = get_field('third-fact');
                    $factFour = get_field('fact-four');
                    $factFive = get_field('fact-five');
                ?>
                <?php if ($firstFact || $secondFact || $thirdFact || $factFour || $factFive) { ?>
                    <div class="sidebar-block">
                        <div class="sidebar-title">
                            <span>Facts about Betway</span>
                            <div class="line"></div>
                        </div>
                        <div class="sidebar-wrapper">
                            <div class="sidebar-text">
                                <?php if ($firstFact) { ?>
                                    <p class="facts"><b>Accepts Indian Players:</b> <?php echo $firstFact; ?></p>
                                <?php } ?>
                                <?php if ($secondFact) { ?>
                                    <p class="facts"><b>Accepts Indian Rupees:</b> <?php echo $secondFact; ?></p>
                                <?php } ?>
                                <?php if ($thirdFact) { ?>
                                    <p class="facts"><b>Established:</b> <?php echo $thirdFact; ?></p>
                                <?php } ?>
                                <?php if ($factFour) { ?>
                                    <p class="facts"><b>Headquarters:</b> <?php echo $factFour; ?></p>
                                <?php } ?>
                                <?php if ($factFive) { ?>
                                    <p class="facts"><b>Services:</b> <?php echo $factFive; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                    $depMethods = get_field('dep-methods');
                ?>
                <?php if ($depMethods) { ?>
                    <div class="sidebar-block">
                        <div class="sidebar-title">
                            <span>Betway Deposit & Withdrawal Methods</span>
                            <div class="line"></div>
                        </div>
                        <div class="sidebar-wrapper">
                            <div class="sidebar-text">
                                <p class="facts"><b>Betway accepts the following deposit methods:</b></p>
                                <?php echo $depMethods; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                 <?php
                    $vidjetNews = get_field('vidjet-news');
                    if ($vidjetNews) {
                        echo $vidjetNews;
                    }
                ?>
                <?php
                    $vidjetBetting = get_field('vidjet-betting');
                    if ($vidjetBetting) {
                        echo $vidjetBetting;
                    }
                ?>
			</div>
		</div>
	</div>
</div>
<div class="hide-block" style="background-color: <?php echo get_field('head-color'); ?>;">
    <div class="page-container">
        <div class="hide-block__top">
            <div class="hide-block__logo">
                <?php echo get_the_post_thumbnail($item->ID); ?>
            </div>
            <div class="hide-block__rating">
                <span class="hide-block__title"><?php the_title(); ?> review</span>
                <div class="stars">
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <span class="icon-star">★</span>
                    <div class="stars-color" style="width: <?php echo get_field('rating'); ?>%;">
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                        <span class="icon-star">★</span>
                    </div>
                </div>
            </div>
            <div class="hide-block__text">
                <span class="hide-block__title"><?php the_title(); ?> sportbonus</span>
                <span class="hide-block__bonus"><?php echo get_field('bonus'); ?></span>
            </div>
            <div class="hide-block__btn">
                <button onclick="document.location='.get_field('link').'" class="btn-offer">Claim</button>
            </div>
        </div>
    </div>
</div>

<?php get_sidebar(); ?>

<?php get_footer('single'); ?>
