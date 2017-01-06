<?php

/* Classe d'accès aux données */
class PdoM2l{
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=mrbs';
    private static $user='root';
    private static $mdp='';
    private static $monPdo;
    private static $monPdoMd2l=null;
    
    /* Constructeur privé et instaciation */
    private function __construct(){
        self::$monPdo = new PDO(self::$serveur. ';' .self::$bdd, self::$user,self::$mdp);
        self::$monPdo->query("SET CHARACTER SET utf8");
    }
    
    public function __destruct(){
        self::$monPdo=null; 
    }
    
    public static function getPdo(){
        if(self::$monPdoMd2l == null){
            self::$monPdoMd2l = new PdoM2l();
        }
        return self::$monPdoMd2l;
    }
    
    public function getUser($login, $mdp){
    $req = "select id, level, name from mrbs_users where name = :login and password = :mdp";
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':login', $login);
    $mdp=MD5($mdp);
    $stm->bindParam(':mdp', $mdp);
    $stm->execute();
    $laLigne = $stm->fetch();
        if(count($laLigne)>1)
            return $laLigne;
        else              
            return NULL;
    }
    
    public function getLesSalles() //page agendaJour
    {
        $req = "SELECT DISTINCT room_name, id FROM mrbs_room WHERE id = 5 OR id = 6 OR id = 12" ; 
        $stm = self::$monPdo->prepare($req);
        $stm->execute();
        $lesSalles = $stm->fetchAll();
        return $lesSalles;
    }
	
    public function addReservation($start_time,$end_time,$room_id,$name,$types,$description,$statut){
    $req = "insert into mrbs_entry (start_time,end_time,room_id,create_by,name,type,description,status) values (:start_time,:end_time,:room_id,'admin',:name,:types,:description,:statut)" ;
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':start_time', $start_time);
    $stm->bindParam(':end_time', $end_time); 
    $stm->bindParam(':room_id',$room_id);
    $stm->bindParam(':name', $name); 
    $stm->bindParam(':types',$types);
    $stm->bindParam(':description', $description);
    $stm->bindParam(':statut',$statut);
    return $stm->execute();
    }
    
     public function getEvenement($id_salle, $dateJour) //page agendaJour
    {
        /*$req = "SELECT name, description,
                DATE_FORMAT(FROM_UNIXTIME(start_time),'%d/%m/%Y') as jour,
                DATE_FORMAT(FROM_UNIXTIME(start_time),'%H:%i:%s') as heure_debut, 
                DATE_FORMAT(FROM_UNIXTIME(end_time),'%H:%i:%s') as heure_fin
                FROM `mrbs_entry`
                WHERE  DATE_FORMAT(FROM_UNIXTIME(start_time),'%d/%m/%Y') = :dateJour AND id = :id_salle" ;
         */
         $req = "SELECT name, description, start_time, end_time FROM `mrbs_entry`
                WHERE  DATE_FORMAT(FROM_UNIXTIME(start_time),'%Y-%m-%d') = :dateJour AND id = :id_salle" ;
        $stm = self::$monPdo->prepare($req);
        $stm->bindParam(':id_salle', $id_salle);
        $stm->bindParam(':dateJour', $dateJour); 
        $stm->execute();
        $lesEvenement = $stm->fetchAll();
        return $lesEvenement;
    }
    
    public function getLesReservations($name){
    $req = "select mrbs_entry.id,name, mrbs_entry.description, FROM_UNIXTIME(start_time) start_datetime,FROM_UNIXTIME(end_time) end_datetime,room_name,type,status from mrbs_entry inner join mrbs_room on mrbs_entry.room_id=mrbs_room.id where name like '" . $name ."%' ";
    $rs = self::$monPdo->query($req);
    $lesLignes = $rs->fetchAll();
    return $lesLignes;
    }
    
    
    
 


    
}
?>
