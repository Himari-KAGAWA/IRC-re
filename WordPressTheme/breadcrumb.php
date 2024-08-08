<!-- Breadcrumb NavXT使用 -->
<!-- 404ページに独自style用クラス追加の分岐 -->
<nav class="<?php echo is_404() ? 'breadcrumb breadcrumb--404 top-breadcrumb--404' : 'breadcrumb top-breadcrumb'; ?>" aria-label="Breadcrumb">
    <div class="breadcrumb__inner inner wow fadeIn">
        <?php if (function_exists('bcn_display')) {
            bcn_display();
        } ?>
    </div>
</nav>