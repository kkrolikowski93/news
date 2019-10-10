<?php
session_start();
require_once('news.php');
include('nav.php');
$news = new News();

$newsList = $news->showAllNews();

if (isset($_GET['state'])) {
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

if (isset($_POST['idToRemove'])) {
    {
        $id = $_POST['idToRemove'];
        $delete = $news->deleteNews($id);

        return $delete;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="style.css">
    <title>Title of the document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
</script>
<div class="background">
</div>
<div class="row">
    <?php if ($newsList): ?>
        <?php foreach ($newsList as $singleNews) : ?>
            <?php if ($singleNews['is_active']) : ?>
            <div class="card">
                    <div class="left-column">
                        <div class="news-header">
                            <p>Created at: <?= $singleNews['created_at'] ?></p>
                            <p>Last modified: <?= $singleNews['updated_at'] ?></p>
                            <p>Author: <?= $singleNews['first_name'] . ' ' . $singleNews['last_name'] ?></p>
                        </div>
                        <div class="news-content">
                            <h2><?= $singleNews['name']; ?></h2>
                            <p><?= $singleNews['description']; ?></p>
                            <br/>
                        </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script type="text/javascript">
    $('.fa-trash').click(function () {
        var button = this;
        if (confirm('Are you sure you want to remove this news?')) {
            $.ajax({
                method: "post",
                data: {
                    idToRemove: button.id
                },
                url: "index.php",
                success: function (json) {
                    button.closest('.post').remove();
                },
                error: function (response) {
                    console.log('elooo');
                }
            })
        }
    });

</script>
</body>
</html>