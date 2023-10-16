<?php
if (!defined('_INCODE')) die('access denied ...');

?>

<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo !empty($data) ? $data['pageTitle'] : 'unicode'?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE;?>/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_HOST_TEMPLATE;?>/css/style.css">
</head>
<body>

