<?php 

include_once('..\config.php');
include '..\Model\reclamation.php';

class ReclamationC {

    function afficherreclamations(){
        $sql="SELECT * FROM reclamation ";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }

    function supprimerreclamations($id){
        $sql=" DELETE FROM reclamation WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id' , $id);
        try{
            $req->execute();
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
   

    function ajouterreclamation($reclamations){

        $sql = "INSERT INTO reclamation (name,email, num_tel,objet,message)
                  VALUES (:name,:email, :num_tel,:objet,:message)";
     $db = config::getConnexion();
     try{
         $query = $db->prepare($sql);
         $query->execute([
             'name'=> $reclamations->getname(),
             'email'=> $reclamations->getemail(),
             'num_tel'=> $reclamations->getnum_tel(),
             'objet'=> $reclamations->getobjet(),
             'message'=> $reclamations->getmessage(),
         ]);
         $_SESSION['error']="data add seccsesfuly";
 } catch (Exception $e){
     $e->getMessage();
 }
 
     }
     function searchreclamations($string){
        $sql="SELECT * FROM reclamation WHERE name = '$string' or email = '$string'";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    function trireclamations(){
        $sql="SELECT * FROM reclamation order by name desc";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        }
        catch(Exception $e){
            die('Erreur:' . $e->getMessage());
        }
    }
    


}



?>