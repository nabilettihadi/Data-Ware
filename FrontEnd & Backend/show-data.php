<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include("server.php");
$limit_page = 10;

$page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

$offset = ($page - 1) * $limit_page;

// Check if cat_name is set
$catname = isset($_POST['cat_name']) ? mysqli_real_escape_string($conn, $_POST['cat_name']) : 'All';

$sql = "SELECT * FROM questions 
        INNER JOIN users ON questions.user_id = users.id_user 
        INNER JOIN projets ON questions.projet_id = projets.id_projets
        WHERE ('$catname' = 'All' OR projets.nom_projet = '$catname')
        ORDER BY questions.date_creation DESC LIMIT $offset, $limit_page";

$fetch_query = mysqli_query($conn, $sql);

$output = "";
$row_count = mysqli_num_rows($fetch_query);

if ($row_count > 0) {
    while ($row = mysqli_fetch_assoc($fetch_query)) {
        $output .= '<div class="card w-75 mt-4">
            <div class="card-header d-flex justify-content-between text-danger">
                <p>' . $row['First_name'] . ' ' . $row['Last_name'] . '</p>
                <p>' . $row['date_creation'] . '</p>
            </div>
            <div class="card-body d-flex flex-column">
                <a href="Question.php?id=' . $row['id_question'] . '" class="text-decoration-none text-dark">
                    <h3>' . $row['titre'] . '</h3>
                </a>
                <div class="d-flex gap-2">';

        // Display tags
        $question_id = $row['id_question'];
        $sqle = "SELECT * FROM questions 
                 JOIN question_tags ON questions.id_question = question_tags.question_id
                 JOIN tags ON question_tags.tag_id = tags.id_tag 
                 WHERE questions.id_question = $question_id";

        $resulte = mysqli_query($conn, $sqle);
        while ($tag_row = mysqli_fetch_assoc($resulte)) {
            $output .= '<p class="btn btn-outline-primary">' . $tag_row['nom_tag'] . '</p>';
        }

        $output .= '</div>
                    <div class="card-footer d-flex justify-content-end gap-3">
                        <!-- Like and Dislike buttons -->
                        <i ' . ((userLiked($question_id)) ? 'class="fa fa-thumbs-up like-btn text-success"' : 'class="fa fa-thumbs-o-up like-btn"') . '
                            data-id="' . $question_id . '"></i>
                        <span class="likes">' . getLikes($question_id) . '</span>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i ' . ((userDisliked($question_id)) ? 'class="fa fa-thumbs-down dislike-btn text-danger"' : 'class="fa fa-thumbs-o-down dislike-btn"') . '
                            data-id="' . $question_id . '"></i>
                        <span class="dislikes">' . getDislikes($question_id) . '</span>
                    </div>
                </div>
            </div>';
    }

    // Recalculate total pages after filtering
    $fetch_query_all = mysqli_query($conn, "SELECT * FROM questions INNER JOIN projets ON questions.projet_id = projets.id_projets WHERE ('$catname' = 'All' OR projets.nom_projet = '$catname')");
    $total_row = mysqli_num_rows($fetch_query_all);
    $total_page = ceil($total_row / $limit_page);

    $output .= '<ul class="pagination my-4">';
    for ($i = 1; $i <= $total_page; $i++) {
        $active = ($i == $page) ? "active" : "";
        $output .= "<li class='page-item {$active}'><a class='page-link' id='{$i}'>{$i}</a></li>";
    }
    $output .= '</ul>';

    echo $output;
} else {
    echo "Aucun résultat trouvé.";
}
?>