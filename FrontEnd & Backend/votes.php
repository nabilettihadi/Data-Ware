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

// If user clicks like or dislike button
if (isset($_POST['action'])) {
    $reponse_id = $_POST['reponse_id'];
    $action = $_POST['action'];

    // Check the user's existing vote
    $existingVote = getExistingVote($user_id, $reponse_id);

    // Handle the user's new vote
    switch ($action) {
        case 'like':
            if ($existingVote === 'dislike') {
                // If the user had previously disliked, update the vote to 'like'
                updateVote($user_id, $reponse_id, 'like');
            } else {
                // If the user had no existing vote or had liked, insert a new 'like' vote
                insertVote($user_id, $reponse_id, 'like');
            }
            break;
        case 'dislike':
            if ($existingVote === 'like') {
                // If the user had previously liked, update the vote to 'dislike'
                updateVote($user_id, $reponse_id, 'dislike');
            } else {
                // If the user had no existing vote or had disliked, insert a new 'dislike' vote
                insertVote($user_id, $reponse_id, 'dislike');
            }
            break;
        case 'unlike':
        case 'undislike':
            // Delete the user's existing vote
            deleteVote($user_id, $reponse_id);
            break;
        default:
            break;
    }

    // Echo the updated rating for the response
    echo getRating($reponse_id);
    exit(0);
}

// Get the user's existing vote for a response
function getExistingVote($user_id, $reponse_id)
{
    global $conn;
    $sql = "SELECT type FROM votes WHERE user_id=$user_id AND reponse_id=$reponse_id";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['type'];
    }

    return null;
}

// Update the user's vote
function updateVote($user_id, $reponse_id, $type)
{
    global $conn;
    $sql = "UPDATE votes SET type='$type' WHERE user_id=$user_id AND reponse_id=$reponse_id";
    mysqli_query($conn, $sql);
}

// Insert a new vote
function insertVote($user_id, $reponse_id, $type)
{
    global $conn;
    $sql = "INSERT INTO votes (user_id, reponse_id, type) VALUES ($user_id, $reponse_id, '$type')";
    mysqli_query($conn, $sql);
}

// Delete the user's vote
function deleteVote($user_id, $reponse_id)
{
    global $conn;
    $sql = "DELETE FROM votes WHERE user_id=$user_id AND reponse_id=$reponse_id";
    mysqli_query($conn, $sql);
}

// Get total number of likes for a particular response
function getLikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM votes 
            WHERE reponse_id = $id AND type='like'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Get total number of dislikes for a particular response
function getDislikes($id)
{
    global $conn;
    $sql = "SELECT COUNT(*) FROM votes 
            WHERE reponse_id = $id AND type='dislike'";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}

// Get total number of likes and dislikes for a particular response
// function getRating($id)
// {
//     global $conn;
//     $rating = array();
//     $likes_query = "SELECT COUNT(*) FROM votes WHERE reponse_id = $id AND type='like'";
//     $dislikes_query = "SELECT COUNT(*) FROM votes 
//                         WHERE reponse_id = $id AND type='dislike'";
//     $likes_rs = mysqli_query($conn, $likes_query);
//     $dislikes_rs = mysqli_query($conn, $dislikes_query);
//     $likes = mysqli_fetch_array($likes_rs);
//     $dislikes = mysqli_fetch_array($dislikes_rs);
//     $rating = [
//         'likes' => $likes[0],
//         'dislikes' => $dislikes[0]
//     ];
//     return json_encode($rating);
// }

// // Check if user already likes response or not
// function userLiked($reponse_id)
// {
//     global $conn;
//     global $user_id;
//     $sql = "SELECT * FROM votes WHERE user_id=$user_id 
//             AND reponse_id=$reponse_id AND type='like'";
//     $result = mysqli_query($conn, $sql);
//     return mysqli_num_rows($result) > 0;
// }

// // Check if user already dislikes response or not
// function userDisliked($reponse_id)
// {
//     global $conn;
//     global $user_id;
//     $sql = "SELECT * FROM votes WHERE user_id=$user_id 
//             AND reponse_id=$reponse_id AND type='dislike'";
//     $result = mysqli_query($conn, $sql);
//     return mysqli_num_rows($result) > 0;
// }

// Assuming you have a 'reponses' table in your 'dataware_v3' database
$sql = "SELECT * FROM reponses";
$result = mysqli_query($conn, $sql);

// Fetch all responses from the database
// Return them as an associative array called $responses
$responses = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>