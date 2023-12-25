<?php

class  Projet{
    private $nom_projet;
    private $date_debut;
    private $date_fin;
    private $status_projet;
    private $id_projet;
    private $scrum_master;
    private $equipe_id;
    

    public function __construct($nom_projet, $date_debut, $date_fin, $status_projet, $scrum_master, $id_projet, $equipe_id) {
        $this->nom_projet = $nom_projet;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->status_projet = $status_projet;
        $this->scrum_master = $scrum_master;
        $this->id_projet = $id_projet;
        $this->equipe_id = $equipe_id;
    }

    public function getNomProjet() {
        return $this->nom_projet;
    }

    public function getDateDebut() {
        return $this->date_debut;
    }

    public function getDateFin() {
        return $this->date_fin;
    }

    public function getStatusProjet() {
        return $this->status_projet;
    }

    public function getScrumMaster() {
        return $this->scrum_master; 
    }
    public function getIdProjets() {
        return $this->id_projet; 
    }
    public function getEquipeId() {
        return $this->equipe_id;
    }

}
?>