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
	
    public function addReservation($start_time,$end_time,$name,$description){
    $req = "insert into mrbs_entry (start_time,end_time,create_by,name,description) values (:start_time,:end_time,'admin',:name,:description)" ;
    $stm = self::$monPdo->prepare($req);
    $stm->bindParam(':start_time', $start_time);
    $stm->bindParam(':end_time', $end_time); 
    $stm->bindParam(':name', $name); 
    $stm->bindParam(':description', $description);
    return $stm->execute();
    }
    
    public function getLesReservations($name){
    $req = "select mrbs_entry.id,name, mrbs_entry.description, FROM_UNIXTIME(start_time) start_datetime,FROM_UNIXTIME(end_time) end_datetime,room_name from mrbs_entry inner join mrbs_room on mrbs_entry.room_id=mrbs_room.id where name like '" . $name ."%' ";
    $rs = self::$monPdo->query($req);
    $lesLignes = $rs->fetchAll();
    return $lesLignes;
    }
    
 


    
}
?>
