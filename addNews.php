<link rel="stylesheet" href="style.css">
<?php
session_start();
include_once('news.php');
include('nav.php');

$news = new News();

        if (!isset($_SESSION['user_id'])) {
            echo 'You are not allowed for this operation';
            echo '<button class="button">Back</button>';
            exit();
        }
        if (isset($_POST['name']) && isset($_POST['description'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $published = isset($_POST['publish']) ? $_POST['publish'] : 0;

            $addNews = $news->addNews($name, $description, $published);

            if ($addNews) {
                header('Location: newsPanel.php');
                exit();

            }
            else {
                echo 'Error adding news';
                exit();
            }
        }

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('input[name=publish]').on("click", function() {
            if ($(this).val() == 0) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        });
    });
</script>
<form action="" method="post" name="edit">
    <label for="name">News name</label>
    <input type="text" id="name" required name="name" value=""/>

    <label for="description">News description</label>
    <p>
    <textarea id="description"  class="description" required name="description"></textarea>
    </p>
    <label for="checkbox">Publish news</label>
    <label class="switch">
        <input type="checkbox" name="publish" value=0>
        <span class="slider round"></span>
    </label>

    <input class="submit" type="submit" name="save" value="Save"/>
</form>