<?php
session_start();
if($_SESSION['autoriser'] != "oui"){
  header("Location: index.php");
  exit();
}
include "connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['input'])) {
    $inputValues = $_POST['input'];
  

    $sql_query = "SELECT * FROM questions 
                  INNER JOIN users ON questions.user_id = users.id_user
                  LEFT JOIN question_tags ON questions.id_question = question_tags.question_id
                  LEFT JOIN tags ON question_tags.tag_id = tags.id_tag
                  WHERE questions.titre LIKE '%$inputValues%'
                    OR questions.contenu LIKE '%$inputValues%'
                    OR tags.nom_tag LIKE '%$inputValues%'
                  GROUP BY questions.id_question
                  ORDER BY questions.date_creation DESC";
                  

    $result = mysqli_query($conn, $sql_query);

    $output = "";
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
                        <div class="card-footer d-flex justify-content-end gap-3">
                            <p><i class="bi bi-chat"></i> Répondre</p>
                            <p onclick="myFunction(this)" class="like"><i class="fa fa-thumbs-up"></i> 1</p>
                            <p onclick="yourFunction(this)" class="dislike"><i class="fa fa-thumbs-down"></i> 1</p>
                        </div>
                        </div>
                </div>';
        }

    } else {
        $output .= 'Aucune donnée correspondante.';
    }

    echo $output;
}
?>