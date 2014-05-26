<?php

require __DIR__ .'/../classes/SimpleImage.php';

require __DIR__ .'/../classes/UploadImage.php';

$simpleImage = new SimpleImage();

$uploadImage = new UploadImage();

//

if(empty($_FILES['upload'])){

	echo json_encode(array(
		'status' => false,
		'value' => 'ERR_DATA_PASSED'
	));

	exit;
	
}

$imageData = $uploadImage->upload('upload');

$imageDataThumb = $uploadImage->renderNewPath($imageData, 'thumb');

$simpleImage->load($imageData['filePath']);

$simpleImage->resizeToWidth(150);

$simpleImage->save($imageDataThumb['filePath']);

//

$imageDataThumb['width'] = $simpleImage->getWidth();

$imageDataThumb['height'] = $simpleImage->getHeight();

//

echo json_encode(array(
	'status' => true,
	'value' => array(
		'thumb' => $imageDataThumb,
		'orginal' => $imageData
	)
));

exit;
