<?php

include "connexion.php";
$message = "";

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}

// Get the user's ID from the session
$user_id = $_SESSION['id'];

// Check the database connection
if (!$conn) {
    die("Error connecting to the database: " . mysqli_connect_error());
}

// If the user clicks like or dislike button
if (isset($_POST['action'])) {
    $question_id = $_POST['question_id'];
    $action = $_POST['action'];

    switch ($action) {
        case 'like':
            // Delete any existing dislike vote for the user on the same question
            $delete_dislike_sql = "DELETE FROM votes WHERE user_id=$user_id AND question_id=$question_id AND type='dislike'";
            mysqli_query($conn, $delete_dislike_sql);

            // Insert or update the like vote
            $insert_like_sql = "INSERT INTO votes (user_id, question_id, type) VALUES ($user_id, $question_id, 'like')
                                ON DUPLICATE KEY UPDATE type='like'";
            mysqli_query($conn, $insert_like_sql);
            break;
        case 'dislike':
            // Delete any existing like vote for the user on the same question
            $delete_like_sql = "DELETE FROM votes WHERE user_id=$user_id AND question_id=$question_id AND type='like'";
            mysqli_query($conn, $delete_like_sql);

            // Insert or update the dislike vote
            $insert_dislike_sql = "INSERT INTO votes (user_id, question_id, type) VALUES ($user_id, $question_id, 'dislike')
                                   ON DUPLICATE KEY UPDATE type='dislike'";
            mysqli_query($conn, $insert_dislike_sql);
            break;
        case 'unlike':
            // Delete the like vote
            $delete_like_sql = "DELETE FROM votes WHERE user_id=$user_id AND question_id=$question_id AND type='like'";
            mysqli_query($conn, $delete_like_sql);
            break;
        case 'undislike':
            // Delete the dislike vote
            $delete_dislike_sql = "DELETE FROM votes WHERE user_id=$user_id AND question_id=$question_id AND type='dislike'";
            mysqli_query($conn, $delete_dislike_sql);
            break;
        default:
            break;
    }

    // Output the updated rating
    echo getRating($question_id);
    exit(0);
}

// Get total number of likes for a particular question
function getLikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM votes 
            WHERE question_id = $id AND type='like'";
    $result = mysqli_query($conn, $sql);
    $likes = mysqli_fetch_array($result);
    return $likes[0];
}

// Get total number of dislikes for a particular question
function getDislikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM votes 
            WHERE question_id = $id AND type='dislike'";
    $result = mysqli_query($conn, $sql);
    $dislikes = mysqli_fetch_array($result);
    return $dislikes[0];
}

// Get total number of likes and dislikes for a particular question
function getRating($id)
{
    global $conn;
    $rating = array();
    $likes_query = "SELECT COUNT(*) FROM votes WHERE question_id = $id AND type='like'";
    $dislikes_query = "SELECT COUNT(*) FROM votes 
                       WHERE question_id = $id AND type='dislike'";
    $likes_result = mysqli_query($conn, $likes_query);
    $dislikes_result = mysqli_query($conn, $dislikes_query);
    $likes = mysqli_fetch_array($likes_result);
    $dislikes = mysqli_fetch_array($dislikes_result);
    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);
}

// Check if the user already likes the question or not
function userLiked($question_id)
{
    global $conn;
    global $user_id;
    $sql = "SELECT * FROM votes WHERE user_id=$user_id 
            AND question_id=$question_id AND type='like'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

// Check if the user already dislikes the question or not
function userDisliked($question_id)
{
    global $conn;
    global $user_id;
    $sql = "SELECT * FROM votes WHERE user_id=$user_id 
            AND question_id=$question_id AND type='dislike'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

// Fetch all questions from the database
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>