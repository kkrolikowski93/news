<?php
session_start();
include_once('news.php');
include('nav.php');

$news = new News();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $singleNews = $news->showSingleNews($id);

    if (!$singleNews) {
        echo 'Cannot find article';
        die();
    } else {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $singleNews['author_id']) {
            echo 'You are not allowed for this operation';
            die();
        }
         if (isset($_POST['name']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $published = isset($_POST['publish']) ? $_POST['publish'] : 0;

            $editNews = $news->editNews($id, $name, $description, $published);

            if ($editNews) {
               $singleNews = $news->showSingleNews($id);
               echo 'Article succesfully saved';
            }
         }

    }
} else {
    echo 'Error editing news';
    exit();
}
?>
<link rel="stylesheet" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('input[name=publish]').on("click", function() {
            if ($(this).val() == 0) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        })
    });
</script>
<form action="" method="post" name="edit">
    <label for="name">News name</label>
    <input type="text" id="name" name="name" value="<?= $singleNews['name'] ?>"/>

    <label for="description">News description</label>
    <input type="text" id="description"  class="description" name="description" value="<?= $singleNews['description'] ?>"/>

    <label for="checkbox">Publish news</label>
    <label class="switch">
        <input type="checkbox" <?= $singleNews['is_active'] ? 'checked' : '' ?> value=<?= $singleNews['is_active']?> name="publish">
        <span class="slider round"></span>
    </label>

    <input type="submit" name="save" value="Save"/>
</form>