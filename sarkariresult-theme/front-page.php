<?php
/**
 * Front page — premium Sarkari Result portal layout.
 *
 * @package SarkariResult
 */

get_header();

$host = wp_parse_url( home_url(), PHP_URL_HOST );
$host = $host ? $host : 'sarkariresult.edu.pl';

$features = array(
	array( 'label' => 'RRB Group D Admit Card', 'class' => 'feature-tile--olive' ),
	array( 'label' => 'AIIMS NORCET 11 Online Form', 'class' => 'feature-tile--navy' ),
	array( 'label' => 'UPSSSC PET 2026 Online Form', 'class' => 'feature-tile--amber' ),
	array( 'label' => 'NICL Assistant Online Form', 'class' => 'feature-tile--wine' ),
	array( 'label' => 'IBPS Clerk (CSA) Online Form', 'class' => 'feature-tile--crimson' ),
	array( 'label' => 'ISRO ICRB Assistant Online Form', 'class' => 'feature-tile--forest' ),
	array( 'label' => 'RRB Section Controller Online Form', 'class' => 'feature-tile--plum' ),
	array( 'label' => 'RRB JE Online Application Form', 'class' => 'feature-tile--sky' ),
);

$states = array(
	'Andhra', 'Arunachal', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 'Gujarat', 'Haryana',
	'Himachal', 'Jharkhand', 'Karnataka', 'Kerala', 'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya',
	'Mizoram', 'Nagaland', 'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana',
	'Tripura', 'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Delhi', 'J&K', 'Ladakh', 'Puducherry',
);

$quals = array( '8th Pass', '10th Pass', '12th Pass', 'Graduate', 'PG', 'Engg. Dip', 'Engg. Deg', 'MBA', 'GNM / ANM', 'MCA', 'BALLB', 'ITI' );

$rrb = array( 'RRB ALP', 'Technician', 'NTPC', 'JE', 'Group D', 'Paramedical', 'RPF', 'Ministerial', 'Section Controller' );
?>

<main id="main">
	<section class="intro" id="home">
		<div class="container">
			<p class="intro__text">
				<strong><?php echo esc_html( $host ); ?> <?php esc_html_e( 'since 2016', 'sarkariresult' ); ?></strong> —
				<?php esc_html_e( 'Get the latest Sarkari Result, Govt Jobs, Online Form, Admit Card, Answer Key, Syllabus, Exam Pattern, Recruitment Notifications, Sarkari Notice, and Career Updates from across India.', 'sarkariresult' ); ?>
			</p>
			<div class="intro__actions">
				<span class="live-badge"><span class="live-badge__dot"></span>LIVE</span>
				<a class="btn btn--whatsapp" href="#">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0 0 12.04 2z"/></svg>
					<?php esc_html_e( 'Join WhatsApp Channel', 'sarkariresult' ); ?>
				</a>
			</div>
		</div>
	</section>

	<section class="quick-links" aria-label="<?php esc_attr_e( 'Trending updates', 'sarkariresult' ); ?>">
		<div class="container">
			<div class="quick-links__track">
				<?php foreach ( $features as $item ) : ?>
					<a href="#"><?php echo esc_html( $item['label'] ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="feature-grid" aria-label="<?php esc_attr_e( 'Featured notifications', 'sarkariresult' ); ?>">
		<div class="container">
			<div class="feature-grid__items">
				<?php foreach ( $features as $item ) : ?>
					<a class="feature-tile <?php echo esc_attr( $item['class'] ); ?>" href="#"><span><?php echo esc_html( $item['label'] ); ?></span></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="triple-cols" id="results">
		<div class="container">
			<div class="triple-cols__grid">
				<article class="list-panel">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Results', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'results',
							8,
							array(
								'SSC MTS Havaldar Result 2026',
								'HTET Result 2026',
								'UP Police Constable Result 2026',
								'UPSSSC AGTA Result 2026',
								'Bihar Board Result 2026',
								'CBSE Board Result 2026',
								'RRB NTPC Result 2026',
								'DSSSB Result 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="<?php echo esc_url( sre_cat_url( 'results', 'results' ) ); ?>"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>

				<article class="list-panel" id="admit-cards">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Admit Cards', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'admit-card',
							8,
							array(
								'UP Police Constable Admit Card 2026',
								'RRB Group D Admit Card 2026',
								'IAF AFCAT 2 Admit Card 2026',
								'SSC CGL Admit Card 2026',
								'IBPS Clerk Admit Card 2026',
								'CTET Admit Card 2026',
								'NDA Admit Card 2026',
								'UPSC CSE Admit Card 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="<?php echo esc_url( sre_cat_url( 'admit-card', 'admit-cards' ) ); ?>"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>

				<article class="list-panel" id="latest-jobs">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Latest Jobs', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'recruitment',
							8,
							array(
								'Rajasthan Safai Karmachari Recruitment 2026',
								'ISRO Assistant Recruitment 2026',
								'AIIMS NORCET 11 Notification 2026',
								'RRB ALP Recruitment 2026',
								'SSC CHSL Recruitment 2026',
								'Bank of Baroda Recruitment 2026',
								'India Post GDS Recruitment 2026',
								'Delhi Police Constable 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="<?php echo esc_url( sre_cat_url( 'recruitment', 'latest-jobs' ) ); ?>"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>
			</div>
		</div>
	</section>

	<section class="triple-cols" id="admission">
		<div class="container">
			<div class="triple-cols__grid">
				<article class="list-panel list-panel--alt">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Answer Keys', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'answer-key',
							6,
							array(
								'RRB ALP CBT 2 Answer Key 2026 [Out]',
								'SSC GD Answer Key 2026 [Out]',
								'UPSSSC PET Answer Key 2026',
								'IBPS PO Answer Key 2026',
								'CTET Answer Key 2026 (LIVE)',
								'NEET Answer Key 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="<?php echo esc_url( sre_cat_url( 'answer-key', 'admission' ) ); ?>"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>

				<article class="list-panel list-panel--alt">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Cut Offs', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'cut-off',
							6,
							array(
								'SSC GD Cut Off 2026 [Out]',
								'RRB NTPC Cut Off 2026',
								'IBPS Clerk Cut Off 2026',
								'UP Police Cut Off 2026',
								'SSC CGL Cut Off 2026',
								'CTET Cut Off 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="#"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>

				<article class="list-panel list-panel--alt">
					<header class="list-panel__head"><h2><?php esc_html_e( 'Admission', 'sarkariresult' ); ?></h2></header>
					<ul class="list-panel__list">
						<?php
						sre_list_category_posts(
							'admission',
							6,
							array(
								'DU Admission 2026',
								'JNU Admission 2026',
								'IGNOU Admission 2026',
								'Polytechnic Admission 2026',
								'B.Ed Admission 2026',
								'Nursing Admission 2026',
							)
						);
						?>
					</ul>
					<a class="list-panel__more" href="<?php echo esc_url( sre_cat_url( 'admission', 'admission' ) ); ?>"><?php esc_html_e( 'View More', 'sarkariresult' ); ?></a>
				</article>
			</div>
		</div>
	</section>

	<section class="rrb-grid" id="railway">
		<div class="container">
			<div class="section-label">
				<h2><?php esc_html_e( 'Railway Recruitment Board', 'sarkariresult' ); ?></h2>
				<p><?php printf( esc_html__( 'Quick access to popular RRB categories on %s', 'sarkariresult' ), esc_html( $host ) ); ?></p>
			</div>
			<div class="rrb-grid__items">
				<?php foreach ( $rrb as $label ) : ?>
					<a class="rrb-card" href="#">
						<span class="rrb-card__icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
						</span>
						<span><?php echo esc_html( $label ); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="states">
		<div class="container">
			<div class="states__banner"><h2><?php esc_html_e( 'State Wise Jobs', 'sarkariresult' ); ?></h2></div>
			<p class="states__desc"><?php printf( esc_html__( 'Job Search by States: Explore the latest State Government jobs, recruitment notifications, admit cards, results, and exam updates across all Indian states on %s.', 'sarkariresult' ), esc_html( $host ) ); ?></p>
			<div class="states__grid">
				<?php foreach ( $states as $state ) : ?>
					<a href="#"><?php echo esc_html( $state ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="qualify">
		<div class="container">
			<div class="section-label">
				<h2><?php esc_html_e( 'Jobs by Qualification', 'sarkariresult' ); ?></h2>
				<p><?php esc_html_e( 'Find government vacancies matching your education level', 'sarkariresult' ); ?></p>
			</div>
			<div class="qualify__grid">
				<?php foreach ( $quals as $q ) : ?>
					<a href="#"><?php echo esc_html( $q ); ?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="about-strip">
		<div class="container">
			<div class="content-block">
				<header class="content-block__head">
					<h2><?php printf( esc_html__( '%s – Latest Government Jobs, Results, Admit Card & Exam Updates', 'sarkariresult' ), esc_html( $host ) ); ?></h2>
				</header>
				<div class="content-block__body content-block__body--center">
					<p><?php
					echo wp_kses(
						sprintf(
							/* translators: %s: site host wrapped in strong */
							__( 'Welcome to %s — your trusted destination for the latest government job notifications, Sarkari results, admit cards, answer keys, syllabus, and exam updates from across India.', 'sarkariresult' ),
							'<strong>' . esc_html( $host ) . '</strong>'
						),
						array( 'strong' => array() )
					);
					?></p>
					<p><?php esc_html_e( 'We cover Railway Jobs, SSC Recruitment, Banking Jobs, Defence Jobs, Teaching Vacancies, UPSC Notifications, State PSC Jobs, and PSU Recruitment with clear eligibility, dates, and process details.', 'sarkariresult' ); ?></p>
					<p><?php esc_html_e( 'Stay informed with accurate, regularly updated information so you never miss an important Sarkari Naukri opportunity.', 'sarkariresult' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="info-blocks">
		<div class="container">
			<div class="content-block">
				<header class="content-block__head"><h2><?php esc_html_e( 'Latest Government Jobs', 'sarkariresult' ); ?></h2></header>
				<div class="content-block__body">
					<p><?php esc_html_e( 'Looking for the latest Sarkari Naukri? Check all new government recruitment notifications released by various departments, ministries, boards and organizations.', 'sarkariresult' ); ?></p>
					<p><strong><?php echo esc_html( $host ); ?></strong> <?php esc_html_e( 'provides detailed information about:', 'sarkariresult' ); ?></p>
					<ul class="premium-list">
						<li><?php esc_html_e( 'Recruitment Notification', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Number of Vacancies', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Educational Qualification', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Age Limit', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Application Fee', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Selection Process', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Exam Date', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Apply Online Link', 'sarkariresult' ); ?></li>
					</ul>
					<p><?php esc_html_e( 'Get the latest updates for Central Government Jobs, State Government Jobs, Railway Recruitment, Banking Jobs, SSC Jobs, Defence Recruitment and PSU Vacancies.', 'sarkariresult' ); ?></p>
				</div>
			</div>

			<div class="content-block">
				<header class="content-block__head"><h2><?php esc_html_e( 'Admit Card', 'sarkariresult' ); ?></h2></header>
				<div class="content-block__body">
					<p class="text-center"><?php printf( esc_html__( 'Download the latest Government Exam Admit Cards and Hall Tickets from %s.', 'sarkariresult' ), esc_html( $host ) ); ?></p>
					<p><?php esc_html_e( 'Get timely updates about:', 'sarkariresult' ); ?></p>
					<ul class="premium-list">
						<li><?php esc_html_e( 'Exam Date', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Admit Card Release Date', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Exam Centre Details', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Download Link', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Important Instructions', 'sarkariresult' ); ?></li>
					</ul>
					<p><?php esc_html_e( 'Stay prepared for upcoming examinations with the latest admit card notifications.', 'sarkariresult' ); ?></p>
				</div>
			</div>

			<div class="content-block">
				<header class="content-block__head"><h2><?php esc_html_e( 'Answer Key', 'sarkariresult' ); ?></h2></header>
				<div class="content-block__body">
					<p class="text-center"><?php esc_html_e( 'After appearing in competitive examinations, candidates can check the latest Answer Keys and Response Sheets.', 'sarkariresult' ); ?></p>
					<p><?php esc_html_e( 'We provide updates for:', 'sarkariresult' ); ?></p>
					<ul class="premium-list">
						<li><?php esc_html_e( 'Final Answer Keys', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Official Answer Keys', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Provisional Answer Keys', 'sarkariresult' ); ?></li>
						<li><?php esc_html_e( 'Objection Details', 'sarkariresult' ); ?></li>
					</ul>
				</div>
			</div>

			<div class="dual-info">
				<div class="content-block" id="syllabus">
					<header class="content-block__head"><h2><?php esc_html_e( 'Exam Syllabus & Pattern', 'sarkariresult' ); ?></h2></header>
					<div class="content-block__body">
						<p><?php esc_html_e( 'Prepare better with detailed Exam Syllabus, Exam Pattern and Selection Process information.', 'sarkariresult' ); ?></p>
						<p><?php esc_html_e( 'Find syllabus updates for popular exams including:', 'sarkariresult' ); ?></p>
						<ul class="premium-list">
							<li><?php esc_html_e( 'Railway Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'SSC Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'Banking Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'UPSC Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'State Government Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'Teaching Exams', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'Defence Exams', 'sarkariresult' ); ?></li>
						</ul>
					</div>
				</div>

				<div class="content-block">
					<header class="content-block__head"><h2><?php esc_html_e( 'Railway Jobs', 'sarkariresult' ); ?></h2></header>
					<div class="content-block__body">
						<p><?php esc_html_e( 'Railway recruitment is one of the most popular government job sectors in India. Get the latest updates related to:', 'sarkariresult' ); ?></p>
						<ul class="premium-list">
							<li>RRB Group D</li>
							<li>RRB NTPC</li>
							<li>RRB ALP</li>
							<li>RRB Technician</li>
							<li>RRB JE</li>
							<li><?php esc_html_e( 'Railway Apprentice', 'sarkariresult' ); ?></li>
							<li><?php esc_html_e( 'RPF Recruitment', 'sarkariresult' ); ?></li>
						</ul>
						<p><?php esc_html_e( 'Check Railway notification, eligibility, vacancy details, exam pattern and application process.', 'sarkariresult' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="about-faq" id="about">
		<div class="container">
			<div class="content-block">
				<header class="content-block__head"><h2><?php printf( esc_html__( 'About %s', 'sarkariresult' ), esc_html( $host ) ); ?></h2></header>
				<div class="content-block__body content-block__body--center">
					<p><strong><?php echo esc_html( $host ); ?></strong> <?php esc_html_e( 'is an independent information portal dedicated to government job updates, recruitment notifications, Sarkari results, admit cards, answer keys, and education schemes across India.', 'sarkariresult' ); ?></p>
					<p><?php esc_html_e( 'Our mission is to present clear, timely, and easy-to-verify updates so aspirants can track opportunities and prepare with confidence. We are not affiliated with any government department.', 'sarkariresult' ); ?></p>
				</div>
			</div>

			<div class="faq">
				<h2 class="faq__title"><?php esc_html_e( 'FAQs', 'sarkariresult' ); ?></h2>
				<div class="faq__list">
					<details class="faq__item" open>
						<summary><?php printf( esc_html__( 'What is %s?', 'sarkariresult' ), esc_html( $host ) ); ?></summary>
						<p><?php esc_html_e( 'It is an independent portal that publishes the latest Sarkari Result, government jobs, admit cards, answer keys, syllabus, and exam updates for candidates across India.', 'sarkariresult' ); ?></p>
					</details>
					<details class="faq__item">
						<summary><?php printf( esc_html__( 'Is %s an official government website?', 'sarkariresult' ), esc_html( $host ) ); ?></summary>
						<p><?php printf( esc_html__( 'No. %s is not an official government website. Always verify final details on the concerned official department or board website before applying.', 'sarkariresult' ), esc_html( $host ) ); ?></p>
					</details>
					<details class="faq__item">
						<summary><?php esc_html_e( 'How often is the website updated?', 'sarkariresult' ); ?></summary>
						<p><?php esc_html_e( 'We update the portal regularly with new recruitment notifications, results, admit cards, and related exam information as soon as reliable sources are available.', 'sarkariresult' ); ?></p>
					</details>
					<details class="faq__item">
						<summary><?php esc_html_e( 'Can I apply for jobs through this website?', 'sarkariresult' ); ?></summary>
						<p><?php esc_html_e( 'Applications are submitted on official portals. We provide guidance, eligibility summaries, and direct links to official apply-online pages wherever available.', 'sarkariresult' ); ?></p>
					</details>
					<details class="faq__item">
						<summary><?php esc_html_e( 'Is the information free?', 'sarkariresult' ); ?></summary>
						<p><?php printf( esc_html__( 'Yes. Browsing recruitment updates, results, admit cards, and related information on %s is free.', 'sarkariresult' ), esc_html( $host ) ); ?></p>
					</details>
					<details class="faq__item">
						<summary><?php printf( esc_html__( 'How can I contact %s?', 'sarkariresult' ), esc_html( $host ) ); ?></summary>
						<p><?php esc_html_e( 'Use the Contact page linked in the footer. For application issues, please contact the official helpdesk of the recruiting organization.', 'sarkariresult' ); ?></p>
					</details>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
