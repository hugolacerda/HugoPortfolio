<div class="tidio-gallery clearfix" id="tidio-gallery-<?php echo $galleryData['data']['id'] ?>" >

<?php foreach($galleryData['elements'] as $e){ ?>

<a href="<?php echo $e['orginal']['fileUrl'] ?>">
	<span class="cover" style="background-image: url(<?php echo $e['thumb']['fileUrl'] ?>);"></span>
</a>

<?php } ?>

</div>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function(){
	 serviceGallery.setupGallery('<?php echo $galleryData['data']['id'] ?>'); 
});
</script>