<?php


class  Equipe{
    private $name_equipe;
    private $date_creation;
    private $id_equipe;
    private $scrum_master;
    

    public function __construct($name_equipe, $date_creation, $id_equipe, $scrum_master) {
        $this->name_equipe = $name_equipe;
        $this->date_creation = $date_creation;
        $this->id_equipe = $id_equipe;
        $this->scrum_master = $scrum_master;
    }

    public function getNameEquipe() {
        return  $this->name_equipe;
    }

    public function getDateCreation() {
        return  $this->date_creation;
    }

    public function getScrumMaster() {
        return $this->scrum_master; 
    }
    public function getIdEquipe() {
        return   $this->id_equipe;
    }
    
}

?>