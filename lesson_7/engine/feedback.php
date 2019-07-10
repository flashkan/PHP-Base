<?php
$queryFeedback = "SELECT * FROM `feedback`;";
$feedbackResult = mysqli_query(myDB_connect(), $queryFeedback);

$feedbacks = [];
while ($elem = mysqli_fetch_assoc($feedbackResult)) {
    $feedbacks[] = $elem;
}
$feedbackError = false;
if ($_GET['feedback_body']) {
    $feedbackUser = $_SESSION['userLog'];
    $feedbackBody = $_GET['feedback_body'];
    if (strlen($feedbackBody) > 10) {
        $queryNewFeedback = "INSERT INTO `feedback` (`feedback_user`, `feedback_body`)
        VALUES ('$feedbackUser', '$feedbackBody');";
        mysqli_query(myDB_connect(), $queryNewFeedback);

        header ('location: index.php');
        die;
    } else {
        $feedbackError = true;
    }
}

if ($_POST['delFeedback']) {
    $idFeedback = $_POST['delFeedback'];
    $queryDel = "DELETE FROM `feedback` WHERE `id_feedback` = '$idFeedback';";
    mysqli_query(myDB_connect(), $queryDel);
    header('location: /');
    die;
}