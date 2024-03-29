<?php
session_start();
require_once('news.php');
include('nav.php');
$news = new News();

$newsList = $news->showUserNews();

if (isset($_GET['state'])) {
        session_destroy();
        header('Location: index.php');
        exit();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
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

<div class="container">
            <div class="row">
                <div>
                    <a class="submit" id="add-news" href="addNews.php">Add news</a>
                </div>
                <?php if ($newsList): ?>
                    <?php foreach ($newsList as $singleNews) : ?>
                        <?php if (isset($_SESSION['user_id']) && $singleNews['author_id'] == $_SESSION['user_id'])  : ?>
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
                                <div class="remove_or_edit">
                                    <a class="fa fa-pencil-square-o" href="editNews.php?id=<?= $singleNews['id'] ?>"
                                       aria-hidden="true"></a>
                                    <a class="fa fa-trash" id="<?= $singleNews['id'] ?>" aria-hidden="true"></a>
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
                    button.closest('.card').remove();
                },
                error: function (response) {
                    alert('This news cannot be removed');
                }
            })
        }
    });

</script>
</body>
</html>