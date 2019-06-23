<?php
$queryFeedback = "SELECT * FROM `feedback`;";
$feedbackResult = mysqli_query(myDB_connect(), $queryFeedback);

$feedbacks = [];
while ($elem = mysqli_fetch_assoc($feedbackResult)) {
    $feedbacks[] = $elem;
}

if ($_GET['feedback_user'] && $_GET['feedback_body']) {
    $feedbackUser = $_GET['feedback_user'];
    $feedbackBody = $_GET['feedback_body'];
    $queryNewFeedback = "INSERT INTO `feedback` (`feedback_user`, `feedback_body`) 
        VALUES ('$feedbackUser', '$feedbackBody');";
    mysqli_query(myDB_connect(), $queryNewFeedback);

    header ('location: index.php');
    die;
}