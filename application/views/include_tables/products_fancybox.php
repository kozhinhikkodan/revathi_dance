<div class="d-none">

	<?php $i=0; foreach ($products as $key => $value) { 
		if($i==0){
			$id = 'id="first_image"';
		}
		?>

		<a  href="<?= base_url() ?>uploads/products/<?= $value->product_file_name ?>" data-fancybox="gallery" data-type="image" data-caption="<?= $value->product_name ?>">
			<img <?= $id ?> src="<?= base_url() ?>uploads/products/<?= $value->product_file_name ?>" alt="Image Gallery">
		</a>

	<?php $i++; } ?>

</div>