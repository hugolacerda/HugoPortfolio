<?php

require 'classes/TidioGalleryOptions.php';

wp_register_style('tidio-gallery-css', plugins_url('media/css/app-options.css', __FILE__));

wp_enqueue_style('tidio-gallery-css');

//

$galleryData = get_option('tidio_gallery_data');

if (empty($galleryData)) {
    $galleryData = array();
}

//

TidioGalleryOptions::register();

?>

<div class="wrap" id="wrap">

    <div id="powered-by">
    	<a href="http://www.tidioelements.com/?utm_source=wordpress_gallery&utm_medium=inside_form&utm_campaign=wordpress_plugin" target="_blank"></a>
        <div class="left">
            See how <strong>better your website</strong> could <strong>look</strong> like!
        </div>
        <div id="tidio-top-logo"></div>
        <div class="clearfix"></div>
        <form action="http://www.tidioelements.com/editor-test" method="get" target="_blank">
            <input type="text" name="url" placeholder="http:/www.yourwebsite.com" value="<?php echo site_url(); ?>" />
            <input type="hidden" name="utm_source" value="wordpress_gallery" />
            <input type="hidden" name="utm_medium" value="inside_form"/>
            <input type="hidden" name="utm_campaign" value="wordpress_plugin"/>
            <input type="submit" name="submit" value="OK"/>
        </form>
    </div>

    <h2 id="wrap-header">Gallery</h2>

    <!-- List -->

    <div id="section-list" class="section-content active">

        <div id="gallery-list" class="elements-list clearfix"></div>

        <div id="gallery-list-empty">
            <div class="alert alert-info">No elements have been added yet.</div>
        </div>

        <hr />

        <a href="#" class="btn primary" id="gallery-btn-add">add gallery</a>

    </div>

    <!-- Details -->

    <div id="section-details" class="section-content">

        <div id="images-list" class="elements-list clearfix"></div>

        <div id="images-list-empty">
            <div class="alert alert-info">No elements have been added yet.</div>
        </div>

        <hr />
        
        <a href="#" class="btn primary" id="images-btn-add">add image</a>
        <a href="#" class="btn primary" id="images-btn-gallery-select">add to site</a>
        <a href="#" class="btn" id="images-btn-back">back</a>

    </div>


</div>

<div id="fixed-loading-bottom">
	<img src="<?php echo TGALLERY_PLUGIN_URL ?>media/img/ajax-loader.gif" />
    <span class="text">loading...</span>
    <div style="clear: both;"></div>
</div>

<script>

    var app = {
        plugin_url: '<?php echo TGALLERY_PLUGIN_URL ?>',
        admin_url: '<?php echo TGALLERY_ADMIN_URL ?>'
    };

</script>

<script> var $ = jQuery;</script>
<script src="<?php echo TGALLERY_PLUGIN_URL ?>media/js/plugin-backstretch.js"></script>
<script src="<?php echo TGALLERY_PLUGIN_URL ?>media/js/plugin-minicolors.js"></script>
<script src="<?php echo TGALLERY_PLUGIN_URL ?>media/js/admin-gallery.js"></script>
<script> adminGallery.create({
	replay_data: <?php echo $galleryData ?>
});</script>

