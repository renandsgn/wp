<?php get_header() ?>
<main>
    <section class="wrapper">
        <script>
            if (window.location.search == '?error1') {
                alert('<?php lang('Invalid URL', 'Link inválido'); ?>');
                window.location.href = '<?php echo get_bloginfo('siteurl') ?>';
            }
        </script>
    </section>
</main>
<?php get_footer() ?>