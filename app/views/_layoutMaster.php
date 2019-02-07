<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $controller = $this->router->fetch_class();
    $method = $this->router->fetch_method();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $this->viewbag->title ?></title>
        <meta name="description" content="<?= $this->viewbag->description ?>" />
        <meta name="robots" content="index, follow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="manifest" href="/site.webmanifest">
        <meta name="theme-color" content="#ffffff">
        <meta name="apple-mobile-web-app-title" content="Lorem">
        <?php /*
        <link href="https://plus.google.com/+Lorem" rel="publisher" />
        <meta name="geo.region" content="GB" />
        <meta name="geo.placename" content="London" />
        <meta name="geo.position" content="0.000000;0.000000" />
        <meta name="ICBM" content="0.000000, 0.00000" />
        */?>
        <?php if (!empty($this->viewbag->canonical)): ?>
            <link rel="canonical" href="<?=$this->viewbag->canonical?>"/>
        <?php endif; ?>
        
        <link rel="stylesheet" href="/css/all.css">
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <?= $CONTENT ?>

        <script src="/js/all.js"></script>
        <script id="init-script" type="text/javascript"
                data-action="<?= $controller.'.'.$method ?>"
                data-log-enabled="<?php echo ENVIRONMENT !== "production" ? "true" : "false" ?>"
                data-debug-enabled="<?php echo ENVIRONMENT !== "production" ? "true" : "false" ?>">
            $(function () { app.init(); });
        </script>

        <?php if (ENVIRONMENT === "production"): ?>
            <!-- GA -->
        <?php endif; ?>
        
    </body>
</html>
