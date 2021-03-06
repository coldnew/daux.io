<!DOCTYPE html>
<html class="no-js" lang="<?=$config->getLanguage() ?>">
<head>
    <title><?= $page['title']; ?> <?= ($page['title'] != $config->getTitle()) ? '- ' . $config->getTitle() : "" ?></title>
<?php //SEO meta tags...
    if (array_key_exists('attributes', $page) && array_key_exists('description', $page['attributes'])) {
        echo "    <meta name=\"description\" content=\"{$page['attributes']['description']}\">\n";
    } elseif ($config->hasTagline()) {
        echo "    <meta name=\"description\" content=\"{$config->getTagline()}\">\n";
    }
    if (array_key_exists('attributes', $page) && array_key_exists('keywords', $page['attributes'])) {
        echo "    <meta name=\"keywords\" content=\"{$page['attributes']['keywords']}\">\n";
    }
    if (array_key_exists('attributes', $page) && array_key_exists('author', $page['attributes'])) {
        echo "    <meta name=\"author\" content=\"{$page['attributes']['author']}\">\n";
    } elseif ($config->hasAuthor()) {
        echo "    <meta name=\"author\" content=\"{$config->getAuthor()}\">\n";
    }
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="<?= $config->getTheme()->getFavicon(); ?>" type="image/x-icon">

    <!-- Mobile -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <script>
        window.base_url = "<?php echo $base_url?>";
        document.documentElement.classList.remove('no-js');
    </script>

    <!-- Font -->
    <?php foreach ($config->getTheme()->getFonts() as $font) {
        echo "<link href='$font' rel='stylesheet' type='text/css'>";
    } ?>

    <!-- CSS -->
    <?php foreach ($config->getTheme()->getCSS() as $css) {
        echo "<link href='$css' rel='stylesheet' type='text/css'>";
    } ?>

    <?php if ($config->getHTML()->hasSearch()) { ?>
        <!-- Search -->
        <link href="<?= $base_url; ?>daux_libraries/search.css" rel="stylesheet">
    <?php } ?>
</head>
<body class="<?= $this->section('classes'); ?>">
    <?= $this->section('content'); ?>

    <?php
    if ($config->getHTML()->hasGoogleAnalytics()) {
        $this->insert('theme::partials/google_analytics', ['analytics' => $config->getHTML()->getGoogleAnalyticsId(), 'host' => $config->hasHost() ? $config->getHost() : '']);
    }
    if ($config->getHTML()->hasPiwikAnalytics()) {
        $this->insert('theme::partials/piwik_analytics', ['url' => $config->getHTML()->getPiwikAnalyticsUrl(), 'id' => $config->getHTML()->getPiwikAnalyticsId()]);
    }
    ?>

    <!-- JS -->
    <?php foreach ($config->getTheme()->getJS() as $js) {
        echo '<script src="' . $js . '"></script>';
    } ?>

    <?php $this->insert('theme::partials/search_script', ['page' => $page, 'base_url' => $base_url]); ?>

</body>
</html>
