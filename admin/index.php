<?php require_once("functions.admin.php"); ?>
<?php get_header();?>
<div class="content">
    <section layout="row" flex>
        <?php get_sidebar(); ?>
        <md-content ui-view flex layout-padding>

        </md-content>
    </section>
</div>
<?php get_footer();?>