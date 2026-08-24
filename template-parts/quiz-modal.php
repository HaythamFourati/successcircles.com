<?php
/**
 * The Entrepreneur Test modal.
 *
 * Rendered once in the footer by successcircles_quiz_modal(). Every step is in
 * the markup already; theme.js only ever toggles `hidden`, so there are no
 * template strings living in JavaScript.
 *
 * @package SuccessCircles
 *
 * @var array<int, array{id:int, title:string, options:array<int, string>}> $questions Published questions.
 * @var array<string, mixed>                                                $copy      The `test` content block.
 * @var int                                                                 $total     Question count plus the contact step.
 */

defined( 'ABSPATH' ) || exit;

$sc_q = (array) successcircles_content( 'quiz', array() );

?>
<dialog class="sc-quiz" data-sc-quiz-dialog aria-label="<?php echo esc_attr( $sc_q['eyebrow'] ); ?>">
	<div class="sc-quiz__panel">

		<header class="sc-quiz__head">
			<?php successcircles_eyebrow( '', $sc_q['eyebrow'], 'sc-quiz__eyebrow' ); ?>

			<p class="sc-quiz__count" data-sc-quiz-count aria-hidden="true">
				<span data-sc-quiz-current>01</span> / <?php echo esc_html( str_pad( (string) $total, 2, '0', STR_PAD_LEFT ) ); ?>
			</p>

			<button type="button" class="sc-quiz__close" data-sc-quiz-close>
				<span class="sc-screen-reader-text"><?php echo esc_html( $sc_q['close'] ); ?></span>
				<span aria-hidden="true">&times;</span>
			</button>

			<div class="sc-quiz__track" data-sc-quiz-track aria-hidden="true"><span></span></div>
		</header>

		<div class="sc-quiz__body">

			<?php foreach ( $questions as $sc_i => $sc_question ) : ?>
				<section class="sc-quiz__step" data-sc-quiz-step data-sc-quiz-question="<?php echo esc_attr( (string) $sc_question['id'] ); ?>" <?php echo $sc_i ? 'hidden' : ''; ?>>
					<h2 class="sc-display sc-display--sm sc-quiz__question" tabindex="-1">
						<?php echo esc_html( wp_specialchars_decode( $sc_question['title'] ) ); ?>
					</h2>

					<ul class="sc-quiz__options">
						<?php foreach ( $sc_question['options'] as $sc_option ) : ?>
							<li>
								<button type="button" class="sc-quiz__option" data-sc-quiz-answer="<?php echo esc_attr( $sc_option ); ?>">
									<span class="sc-quiz__option-text"><?php echo esc_html( wp_specialchars_decode( $sc_option ) ); ?></span>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</section>
			<?php endforeach; ?>

			<section class="sc-quiz__step" data-sc-quiz-step data-sc-quiz-form hidden>
				<h2 class="sc-display sc-display--sm sc-quiz__question" tabindex="-1">
					<?php echo esc_html( wp_specialchars_decode( $sc_q['form_title'] ) ); ?>
				</h2>

				<p class="sc-quiz__lede"><?php echo esc_html( wp_specialchars_decode( $sc_q['form_lede'] ) ); ?></p>

				<form class="sc-form sc-quiz__form" novalidate>
					<div class="sc-field">
						<label class="sc-field__label" for="sc-quiz-name"><?php echo esc_html( $sc_q['name'] ); ?></label>
						<input class="sc-field__input" type="text" id="sc-quiz-name" name="name" autocomplete="name" required>
					</div>

					<div class="sc-field">
						<label class="sc-field__label" for="sc-quiz-email"><?php echo esc_html( $sc_q['email'] ); ?></label>
						<input class="sc-field__input" type="email" id="sc-quiz-email" name="email" autocomplete="email" required>
					</div>

					<div class="sc-field">
						<label class="sc-field__label" for="sc-quiz-phone"><?php echo esc_html( $sc_q['phone'] ); ?></label>
						<input class="sc-field__input" type="tel" id="sc-quiz-phone" name="phone" autocomplete="tel" required>
					</div>

					<?php // Honeypot. Hidden from people, filled in by bots — see inc/quiz.php. ?>
					<div class="sc-field sc-field--trap" aria-hidden="true">
						<label for="sc-quiz-site"><?php esc_html_e( 'Leave this field empty', 'successcircles' ); ?></label>
						<input type="text" id="sc-quiz-site" name="sc_site" tabindex="-1" autocomplete="off">
					</div>

					<p class="sc-quiz__error" data-sc-quiz-error data-sc-quiz-fallback="<?php echo esc_attr( wp_specialchars_decode( $sc_q['error'] ) ); ?>" role="alert" hidden></p>

					<div class="sc-quiz__foot">
						<button type="submit" class="sc-btn sc-btn--primary" data-sc-quiz-submit data-sc-quiz-sending="<?php echo esc_attr( wp_specialchars_decode( $sc_q['sending'] ) ); ?>">
							<?php echo esc_html( $sc_q['submit'] ); ?>
						</button>
						<span class="sc-quiz__note"><?php echo esc_html( $sc_q['privacy'] ); ?></span>
					</div>
				</form>
			</section>

			<section class="sc-quiz__step sc-quiz__step--done" data-sc-quiz-step data-sc-quiz-done hidden>
				<span class="sc-quiz__tick" aria-hidden="true"></span>

				<?php successcircles_eyebrow( '', $sc_q['done_eyebrow'], 'sc-quiz__eyebrow' ); ?>

				<h2 class="sc-display sc-display--sm sc-quiz__question" tabindex="-1">
					<?php echo esc_html( wp_specialchars_decode( $sc_q['done_title'] ) ); ?>
				</h2>

				<p class="sc-quiz__lede"><?php echo esc_html( wp_specialchars_decode( $sc_q['done_lede'] ) ); ?></p>

				<div class="sc-quiz__foot">
					<button type="button" class="sc-btn sc-btn--primary" data-sc-quiz-close>
						<?php echo esc_html( $sc_q['done_cta'] ); ?>
					</button>
				</div>
			</section>

		</div>

		<footer class="sc-quiz__bar">
			<button type="button" class="sc-quiz__back" data-sc-quiz-back hidden>
				<span aria-hidden="true">&larr;</span> <?php echo esc_html( $sc_q['back'] ); ?>
			</button>
			<p class="sc-quiz__intro"><?php echo esc_html( wp_specialchars_decode( $sc_q['intro'] ) ); ?></p>
		</footer>

	</div>
</dialog>
