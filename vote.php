<!DOCTYPE html>
<?php
    require("vote-database.php");
    session_start();

?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vote Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu&display=swap');
  </style>
</head>
<body>
<?php 
$vote_error = "";
$vote_first_candidate = "";
$vote_second_candidate = "";
$vote_third_candidate = "";
$voted ="";


if(isset($_POST['submit'])){

  if(!empty($_POST['voted'])){
      $voted_person = test_input($_POST['voted']);
      $_SESSION['voted'] = $voted_person;
      $user_id = $_SESSION['lastID'];
      

      if($_POST["voted"] == 1 ){
      
        try{
          
        $conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users
                SET choosed = $voted_person
                WHERE users.id = $user_id";
        // use exec() because no results are returned
        $conn->exec($sql);


               
          // use exec() because no results are returned
          $conn->exec($sql);








      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
        }  
      }else if($_POST["voted"] == 2 ){
      

      try{
        $conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users
                SET choosed = $voted_person
                WHERE users.id = $user_id";
                
        // use exec() because no results are returned
        $conn->exec($sql);
        // use exec() because no results are returned
        $conn->exec($sql);



      






      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      } 


  }else {
     

      try{

        $conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users
                SET choosed = $voted_person
                WHERE users.id = $user_id";
        // use exec() because no results are returned
        $conn->exec($sql);


        $conn->exec($sql);
        $vote_third_candidate++;
      } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
      }


       
















    }


  


         
  

  header("location: http://localhost/www/candidates/agreement.php");

}else {
    $vote_error = "You should choose one candidate!";
  }



  

  $conn = null;

}else{
  if(empty($_POST['submit'])){
       echo $vote_error;
  }
}





function test_input($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




?>

<form method="post" action="vote.php">
  <div class="row">
    <p class="h2" style="text-align: center; padding-top: 4%; font-weight: bold; font-family: 'Ubuntu', sans-serif;">Now it is time for voting!</p>
  </div>
  <div class="president-button" style="text-align: center; padding-top: 4%;font-family: 'Ubuntu', sans-serif;">
    <div class="president-name">
      <input type="radio" name="voted" class="choose-button" value="1" >
      <label><h4 style="font-weight: bold; font-size: 20px;">Hossein Jabbarzadeh</h4></label>
    </div>
    
    <div class="president-text" style="padding-top: 1%; padding-bottom: 1%;">
      <p>Mohammad Hossein Jabbarzadeh was born in Tabriz. He studied Computer Engeneering in Tabriz university. He was in Dictator faction from 2010 to now and he promissed to be a good dictator for peaple. </p>
    </div>
    
  </div>
  <hr>
 <div class="president-button" style="text-align: center; padding-top: 6%; font-family: 'Ubuntu', sans-serif;">
    <div class="president-name">
      <input type="radio" name="voted" class="choose-button" value="2">
      <label><h4 style="font-weight: bold;font-size: 20px;">Barack Obama</h4></label> 
    </div>
    
    <div class="president-text" style="padding-top: 1%; padding-bottom: 1%;">
      <p>Barack Hussein Obama II is an American politician who served as the 44th president of the United States from 2009 to 2017. A member of the Democratic Party, he was the first African-American president of the United States.</p>
    </div>
    
  </div>
  <hr>
  <div class="president-button" style="text-align: center; padding-top: 6%; font-family: 'Ubuntu', sans-serif;" >
    <div class="president-name">
      <input type="radio" name="voted" class="choose-button" value="3">
      <label><h4 style="font-weight: bold; font-size: 20px;">Donald Trump</h4></label>
    </div>
    
    <div class="president-text" style="padding-top: 1%; padding-bottom: 1%;">
      <p>Donald John Trump is an American politician, media personality, and businessman who served as the 45th president of the United States from 2017 to 2021. Trump graduated from the University of Pennsylvania with a bachelor's degree in economics in 1968.</p>
    </div>
    
  </div>


  <div class="reg-div" style="display: flex; justify-content: center; align-items: center; padding-top: 2%;">
    <input type="submit" name="submit" class="btn btn-outline-success" style="text-align:center;">
      
    </input>
  </div>
  <span><?php echo $vote_error;?></span>

</form>

</body>
</html>








