<?php get_header(); ?>

<main class="main">
  <div class="main__lower-image wow fadeInUp"></div>
  <section class="sub-mv sub-mv__bg sub-mv__bg--faq wow fadeIn">
    <div class="sub-mv_inner">
      <div class="sub-mv__header">
        <h1 class="sub-mv__title sub-mv__title--upper">faq</h1>
      </div>
    </div>
  </section>

  <!-- breadcrumbs -->
  <?php get_template_part('breadcrumb'); ?>
  <!-- /breadcrumbs -->

  <!-- page-contents -->
  <div class="page top-page">
    <div class="page__content page-faq">
      <div class="page-faq__inner inner wow fadeIn">
        <dl class="page-faq__lists faq-items">

          <!-- Q&A呼出し -->
          <!-- 繰り返しフィールドの値を取得する -->
          <?php $faqGroup = SCF::get('faq'); ?>
          <!-- 繰り返しフィールドに値がある場合に処理を行う -->
          <?php if (!empty($faqGroup)) : ?>
            <!-- 繰り返し構文で各値を順次取り出す -->
            <!-- questionとaskedの値をエスケープ処理して変数に代入する -->
            <?php foreach ($faqGroup as $faqItem) :  ?>
              <?php
              $faq_question = esc_html($faqItem['question']);
              $faq_asked = esc_html($faqItem['asked']);
              ?>
              <div class="faq-item js-faq">
                <dt class="faq-item__question">
                  <button class="faq-item__question-text" aria-expanded="false">
                    <?php echo nl2br($faq_question); ?>
                  </button>
                </dt>
                <dd class="faq-item__answer js-faq-open">
                  <p class="faq-item__answer-text"><?php echo nl2br($faq_asked); ?></p>
                </dd>
              </div>

            <?php endforeach; ?>
          <?php endif; ?>
        </dl>
      </div>
    </div>
  </div>
  <!-- /page-contents -->

</main>

<?php get_footer(); ?>