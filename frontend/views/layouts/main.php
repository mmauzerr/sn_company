<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;


AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,800,800italic&subset=latin,cyrillic-ext,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Great+Vibes&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href='http://fonts.googleapis.com/css?family=Black+Ops+One|Luckiest+Guy|Sonsie+One|Shojumaru&effect=3d|3d-float|anaglyph|brick-sign|canvas-print|
          crackle|decaying|destruction|distressed|distressed-wood|emboss|fire|fire-animation|fragile|grass|ice|mitosis|neon|outline|putting-green|
          scuffed-steel|shadow-multiple|splintered|static|stonewash|vintage|wallpaper'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?= $content?>
<footer class="footer text-lg" style="background-color: #a1a1a1; padding: 2% 0; font-size:1.3em">
    <div class="container">
        <p class="text-center" style="color: whitesmoke">&copy; S&N Company <?= date('Y') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
