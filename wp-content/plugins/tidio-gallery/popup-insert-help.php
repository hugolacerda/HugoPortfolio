<?php
if (empty($_GET['galleryId'])) {
    $_GET['galleryId'] = '';
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>PopUp</title>
        <link rel="stylesheet" href="./media/css/popup-base.css">

        <style>
            body{
                font-family: 'Lato', sans-serif;
                font-size:15px;
                padding: 0px 10px;
                color: #32475c;
                background-color: #F1F1F1;
            }
            h1{
                margin:0px 0px 15px;
                font-size:24px;
                font-weight:400
            }
            h2{
                margin:0px 0px 15px;
                font-size:18px;
                font-weight:800
            }
            p{
                margin:0px 0px 18px;
                font-weight: bold;
            }
            pre {
                word-break: break-word; width: 100%;
            }
        </style>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    </style>

</head>

<body>

    <h3>Add To Site</h3>

    <p><strong>Option #1</strong> While creating a subpage/post</p>

    <p>While you create a subpage/post click the “Add Gallery” button to add or manage the gallery. </p>

    <p><strong>Option #2</strong> Paste the shortcode</p>

    <p>If you want to add the gallery in different place than subpage/post you need to paste the following shortcode into your subpage <pre>&lt;?php echo do_shortcode('[tidio-gallery id="<?php echo $_GET['galleryId'] ?>" /]'); ?&gt;</pre>.</p>

</body>
</html>
