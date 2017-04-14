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
        $req = "SELECT DISTINCT room_name, id FROM mrbs_room WHERE id = 5 OR id = 12" ; 
        $stm = self::$monPdo->prepare($req);
        $stm->execute();
        $lesSalles = $stm->fetchAll();
        return $lesSalles;
    }
    
    public function verifAddReservation($start_time,$end_time,$room_id)
    {
        $req = "select mrbs_entry.id, DATE_FORMAT(FROM_UNIXTIME(start_time),'%d/%m/%Y %H:%i:%s') as start_time,DATE_FORMAT(FROM_UNIXTIME(end_time),'%Y/%m/%d %H:%i:%s') as end_time from mrbs_entry where room_id = :room_id AND start_time between  :start_time AND end_time AND end_time between :start_time AND :end_time";
        $stm = self::$monPdo->prepare($req);
        $stm->bindParam(':start_time', $start_time);
        $stm->bindParam(':end_time', $end_time); 
        $stm->bindParam(':room_id', $room_id);
        $stm->execute();
        $uneReservation = $stm->fetchAll();
        return $uneReservation;
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

    public function delReservation($idReservation){
    $req = "delete from mrbs_entry where id= :idReservation";
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':idReservation',$idReservation);
    return $stm->execute();
    }
    
    public function copyReservation($idReservation){
    $req = "insert into mrbs_entry (start_time,end_time,room_id,create_by,name,type,description,status) select start_time,end_time,room_id,create_by,name,type,description,status from mrbs_entry where id= :idReservation";
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':idReservation',$idReservation);
    return $stm->execute();
    }
	    
	public function majReservation($idReservation,$start,$end,$nom,$user,$description,$type,$statut){
    $req = "update mrbs_entry inner join mrbs_room on mrbs_entry.room_id=mrbs_room.id set start_time = :start_time,end_time = :end_time, name = :name ,create_by = :create_by, mrbs_entry.description = :description, type = :type, status = :status  where mrbs_entry.id  = :idReservation";
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':idReservation', $idReservation);
    $stm->bindParam(':start_time', $start);
    $stm->bindParam(':end_time', $end);
    $stm->bindParam(':name', $nom); 
    $stm->bindParam(':create_by', $user); 
    $stm->bindParam(':description', $description); 
    $stm->bindParam(':type', $type); 
    $stm->bindParam(':status', $statut); 
    return $stm->execute();
                 
    } 
    
    public function getEvenement($id_salle, $dateJour) //page agendaJour
    {
        $jour = strtotime("$dateJour,00:0:0");
        $req = "SELECT name, :jour, description, start_time, end_time, (start_time-:jour) as heure_debut_stamp,(end_time-:jour) as heure_fin_stamp,
                DATE_FORMAT(FROM_UNIXTIME(start_time),'%d/%m/%Y') as jour,
                DATE_FORMAT(FROM_UNIXTIME(start_time),'%H:%i:%s') as heure_debut, 
                DATE_FORMAT(FROM_UNIXTIME(end_time),'%H:%i:%s') as heure_fin
                FROM `mrbs_entry`
                WHERE  DATE_FORMAT(FROM_UNIXTIME(start_time),'%Y-%m-%d') = DATE_FORMAT(:dateJour,'%Y-%m-%d') AND room_id = :id_salle" ;
        
        
        $stm = self::$monPdo->prepare($req);
        $stm->bindParam(':id_salle', $id_salle);
        $stm->bindParam(':dateJour', $dateJour); 
        $stm->bindParam(':jour', $jour);
        $stm->execute();
        $lesEvenement = $stm->fetchAll();
        return $lesEvenement;
    }
    
    public function getLesReservations($name){
    $req = "select mrbs_entry.id,name, mrbs_entry.description, DATE_FORMAT(FROM_UNIXTIME(start_time),'%Y/%m/%d %H:%i:%s') start_datetime,DATE_FORMAT(FROM_UNIXTIME(end_time),'%Y/%m/%d %H:%i:%s') end_datetime,create_by from mrbs_entry inner join mrbs_room on mrbs_entry.room_id=mrbs_room.id where name like '%" . $name ."%' OR mrbs_entry.description like '%" .$name."%'";
    $rs = self::$monPdo->query($req);
    $lesLignes = $rs->fetchAll();
    return $lesLignes;
    }
    
    public function getLaReservation($idReservation){
    $req = "select mrbs_entry.id,name, mrbs_entry.description, DATE_FORMAT(FROM_UNIXTIME(start_time),'%Y/%m/%d %H:%i:%s') as start,DATE_FORMAT(FROM_UNIXTIME(end_time),'%Y/%m/%d %H:%i:%s') as end,room_name,create_by,type,status from mrbs_entry inner join mrbs_room on mrbs_entry.room_id=mrbs_room.id where mrbs_entry.id  = :idReservation" ; 
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':idReservation', $idReservation);
    $stm->execute();
    $laLigne = $stm->fetch();
    return $laLigne;
    }   
}
?>
