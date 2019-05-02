<?php 

$_array_Notes;
$db = createConnexion();
$_postNewElement = isset($_POST) && isset($_POST['action']) ;
$deleteItem =  (isset($_GET['action']) && $_GET['action'] == 'delete') ;



if ($_postNewElement){
      
        createNote($_POST,$db);
}else{
    if ($deleteItem){
        deleteNote($_GET['id'],$db);

    }else{
        $_array_Notes = getAllNotes($db);
        echo(json_encode($_array_Notes));
    }
    
} 



/*-----------------------------------------------------------------------------------------






-*/
/**
 * 
 */
function createConnexion(){
    $_db ="";
    //$LOCAL_DNS = 'mysql:dbname=globalNotes;host=localhost;charset=utf8';
    //$LOCAL_USER = 'jpb@localhost';
    //$LOCAL_PASSWORD ='A-1234-test';  
   
    $LOCAL_DNS = 'mysql:dbname=globalnotes;host=localhost;charset=utf8';
    $LOCAL_USER = 'root';
    $LOCAL_PASSWORD ='password';  

  try {
    $_db = new PDO($LOCAL_DNS, $LOCAL_USER, $LOCAL_PASSWORD);   

      $_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
      $_db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
      $_db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
     // echo("ok connexion <br>");  
  }  catch (PDOException $e) {
      echo 'Base de Donnée Non Accessible ... veuillez reéessayer.';
  }

  return $_db;
}
/**
 * $id [INT] id de la note
 */
function getNote($id){
    $_array=[];
    $sql = "SELECT * FROM notes WHERE id=?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

/**
 * $db [instance PDO]  
 */
function  getAllNotes($db){
   
    $_array=[];
    $sql = "SELECT * FROM notes ORDER BY id DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
      array_push($_array,$row);
    }

    $stmt = null;
    return $_array;
}

/**
 * insert en base de donnée la note
 */
function createNote($post,$db){
    $errors = validateForm($post);
    $data           = array();      // array to pass back data
    
    // Erreurs dans le formulaire
    if (!empty($errors)){

        $data['success'] = false;
        $data['errors']  = $errors;

    }else{
     // insert in database ! 
     
    // var_dump($Post);

     $values = [
        'label' => $post['label'],
        'com' => $post['commentaire'],
        'code' => $post['code'],
        'showOrder' => $post['showorder'],
        'blocknote_id' => $post['blocknote'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      ];

      //Liste des champs & value
          $tmp_fields = '';
          $tmp_value = '';
       
      $numItems = count($values);
      $i = 0;
      foreach ($values as $paramName => $paramValue) {
        //Si le champ n'est pas vide
              if(!empty($paramValue)){
                 
                  $tmp_fields .= $paramName;
                 
                  $tmp_value .= ':'.$paramName;
                  //On insert les virgule entre charque mot "username, email, password"
                  if (++$i < $numItems){
                    $tmp_fields .= ', ';
                    $tmp_value .= ', ';
                  }
    
              }
      }
      $tmp_query = ("INSERT INTO notes ($tmp_fields) VALUES ($tmp_value) ");
      //var_dump($tmp_query);die();
      //le tmp_query affichera "INSERT INTO table (username, email, password) VALUES (:username, :email, :password)"
    
      //Pr�paration de la requ�te
      $tmp_result = $db->prepare($tmp_query);
      //Personnaliser chaque champ avec les valeurs
      foreach($values as $paramName => $paramValue){
        //Si le champ n'est pas le premier (id), qui est un n� Auto
        if(!($paramName == 'id')){
          //Si le champ n'est pas vide
          if(!empty($paramValue)){
            //si le champs est un integer
             if(is_int($paramValue))
               $param = PDO::PARAM_INT;
               //si le champs est un boolean
             elseif(is_bool($paramValue))
               $param = PDO::PARAM_BOOL;
              //si le champs est un NULL
             elseif(is_null($paramValue))
              $param = PDO::PARAM_NULL;
              //si le champs est un string
              elseif(is_string($paramValue))
                $param = PDO::PARAM_STR;
                //sinon
                else
                $param = FALSE;
                //Associe une VALEUR � ce CHAMP
                //ex: username donnera: $tmp_result->bindValue(':username', "Joe", PDO::PARAM_ST
                $tmp_result->bindValue(':'.$paramName, $paramValue, $param);
           }
        }
      }
      if($tmp_result->execute()){
       // return $this->_db->LastInsertId(); 
      }else{
       echo "une erreur est survenue l'ors de l'insertion";
      }




     

    $data =[];
    $data['success'] = true;
    $data['errors']  =[];
    }
    echo json_encode($data); 
}
/**
 *  check for validation fields in form
 * 
 */
function validateForm($post){

    $errors         = array();      // array to hold validation errors
   
    
    if (empty($post['label'])){
        $errors['label'] = 'Nom de la Note requis.';
    }
        

    if (empty($_POST['commentaire'])){
        $errors['commentaire'] = 'Commentaire requis.';
    }
        

    if ($_POST['code'] == ""){
        $errors['code'] = 'Section code requise.';
    }
        

    if ($_POST['showorder'] == "0"){
        $errors['showorder'] = 'ShowOrder > 0  requis.';
    }
        

    if (empty($_POST['blocknote'])){
        $errors['blocknote'] = 'Blocknote Association requise.';
    }
        
        


return $errors;
}


function deleteNote($id,$db){
  $sql ="DELETE FROM notes WHERE id =? ";
  $smtp = $db->prepare($sql);
  $smtp->execute([$id]);
  $smtp = null;

}
