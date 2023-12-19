<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
$role= $_SESSION['role'];
include("connexion.php");
$limit_page = 10;
$page = isset($_POST['page_no']) ? $_POST['page_no'] : 1;

$offset = ($page - 1) * $limit_page;
$sql = "SELECT * FROM questions INNER JOIN users ON questions.user_id = users.id_user WHERE archiver = false ORDER BY questions.date_creation DESC LIMIT $offset, $limit_page";

$fetch_query = mysqli_query($conn, $sql);

$output = "";
$row_count = mysqli_num_rows($fetch_query);

if ($row_count > 0) {
    $output .= '';

    while ($row = mysqli_fetch_assoc($fetch_query)) {
        $output .= '   <div  class="card w-75 mt-4">
            <div class="card-header d-flex justify-content-between text-danger">
                <p>' . $row['First_name'] . ' ' . $row['Last_name'] . '</p>
                <p>' . $row['date_creation'] . '</p>
            </div>
            <div class="card-body d-flex flex-column">
                <a href="Question.php?id=' . $row['id_question'] . '" class="text-decoration-none text-dark">
                    <h3>' . $row['titre'] . '</h3>
                </a>
                <div class="d-flex gap-2 mt-2">';
        
        // Afficher les balises des tags
        $question_id = $row['id_question'];
        $sqle = "SELECT * FROM questions 
                 JOIN question_tags ON questions.id_question = question_tags.question_id
                 JOIN tags  ON question_tags.tag_id = tags.id_tag WHERE questions.id_question = $question_id";

        $resulte = mysqli_query($conn, $sqle);
        while ($tag_row = mysqli_fetch_assoc($resulte)) {
            $output .= '<p class="btn btn-outline-primary">' . $tag_row['nom_tag'] . '</p>';
        }

        $output .= '</div>
        <div class="card-footer d-flex justify-content-end gap-3">';
        // Check if the response belongs to the current user
        if ($role == 'scrum_master') {
            $output .= '<a href="archiverQ.php?id=' . $row['id_question'] . '" class="text-success "><i class="bi bi-archive-fill"></i></a>';
        }
        $output .= '
        <p><i class="bi bi-chat"></i> Répondre</p>
        <p onclick="myFunction(this)" class="like"><i class="fa fa-thumbs-up"></i> 1</p>
        <p onclick="yourFunction(this)" class="dislike"><i class="fa fa-thumbs-down"></i> 1</p>
        </div>
        </div>
        </div>';
        
    }

    $output .= '</div>';

    $fetch_query_all = mysqli_query($conn, "SELECT * FROM questions");
    $total_row = mysqli_num_rows($fetch_query_all);
    $total_page = ceil($total_row / $limit_page);

    $output .= '<ul class="pagination my-4">';
    for ($i = 1; $i <= $total_page; $i++) {
        $active = ($i == $page) ? "active" : "";
        $output .= "<li class='page-item  {$active}'><a class='page-link ' id='{$i}'>{$i}</a></li>";
    }
    $output .= '</ul>';
    echo $output;
} else {
    echo "Aucun résultat trouvé.";
}
?>