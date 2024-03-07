<?php get_header(); ?>
    <main>
       <form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
            <div>
                <div class="wrp-search-form">
                    <label class="screen-reader-text" for="s">Pesquisar por:</label>
                    <input type="text" value="" name="s" id="s" autocomplete="off">
                </div>
                <input type="submit" id="searchsubmit" value="Pesquisar">
            </div>
        </form>
    </main>
<?php get_footer();  ?>
