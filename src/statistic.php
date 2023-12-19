<?php
class StatisticsManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getQuestionsPerProject()
    {
        $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions
                  FROM projets
                  LEFT JOIN questions ON projets.id_projets = questions.projet_id
                  GROUP BY projets.id_projets";

        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getProjectsWithFewestResponses()
    {
        $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions, 
                  COALESCE(COUNT(DISTINCT reponses.id_reponse), 0) as total_reponses
                  FROM projets
                  LEFT JOIN questions ON projets.id_projets = questions.projet_id
                  LEFT JOIN reponses ON questions.id_question = reponses.question_id
                  GROUP BY projets.id_projets
                  ORDER BY total_reponses ASC
                  LIMIT 3";

        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // Add more methods for different statistics
    public function getProjectsMostQuestions()
    {
        $query = "SELECT projets.nom_projet, COUNT(questions.id_question) as total_questions
                  FROM projets
                  LEFT JOIN questions ON projets.id_projets = questions.projet_id
                  GROUP BY projets.id_projets
                  ORDER BY total_questions DESC
                  LIMIT 3";

        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getUserWithMostResponses()
    {
        $query = "SELECT users.First_name, users.Last_name, 
                  COALESCE(COUNT(DISTINCT reponses.id_reponse), 0) as total_reponses
                  FROM users
                  LEFT JOIN questions ON users.id_user = questions.user_id
                  LEFT JOIN reponses ON questions.id_question = reponses.question_id
                  GROUP BY users.id_user
                  ORDER BY total_reponses DESC
                  LIMIT 1";

        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}
?>