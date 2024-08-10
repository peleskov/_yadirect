<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форматирование объявления Яндекс Директ</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <?php $timestamp = time(); ?>
    <link rel="stylesheet" href="css/styles.min.css?v=<?php echo $timestamp; ?>">
</head>
<body>
    <main>
        <?php include 'includes/form.php'; ?>
        <section class="d-flex justify-content-center pb-5">
            <?php include 'includes/ad-block.php'; ?>
        </section>
    </main>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.min.js?v=<?php echo $timestamp; ?>"></script>
</body>
</html>