
<!DOCTYPE html>
 <?php
    require("regi-database.php");
    session_start();

?> 

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
  </style>
</head>
<body>





<?php


$name = $family_name = $email = $date_of_birth = "";
$nameErr = $family_nameErr = $emailErr = $date_of_birthErr = "";
$email_test = $date_test = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["name"])){
        $nameErr = " Name is required!";
    }else{
        $name = test_input($_POST["name"]);
        if(empty($_POST["family-name"])){
            $family_nameErr = "Family Name is reqired!";
        }else{
            $family_name = test_input($_POST["family-name"]);
            if(empty($_POST["birthday"])){
                $date_of_birthErr = "Birthday is reqired!";
            }else{
                $date_test = test_input($_POST["birthday"]); 
                if(test_age($date_test) == false){
                    $date_of_birthErr = " You are too young!";
                }else{
                    $date_of_birth = age_calculator($date_test);
                    if(empty($_POST["email"])){
                        $emailErr = "Email is reqired!";
                    }else{
                        $email_test = test_input($_POST["email"]);
                        if(test_email($email_test) == false){
                            $emailErr = "Email is invalid!";
                        }else{

                            

        


                            $email_exist_check = $email_test;
                            $login = $conn->query("SELECT * FROM users WHERE email = '$email_test'");
                            $fetch = $login->fetch(PDO::FETCH_ASSOC);

                            if ($login->rowCount() > 0) {
                               $emailErr = "Email is available!";
                               
                            }else{
                                $email = $email_test;
                                $insert = $conn->prepare("INSERT INTO users(name , familyName , birthday , email) VALUES (:name , :family_name ,:date_of_birth,:email)");
                                try {
                                    $insert->execute([
                                        ":name" => $name,
                                        ":family_name" => $family_name,
                                        ":date_of_birth" => $date_of_birth,
                                        ":email" => $email,
                                    ]);
                                    $last_id = $conn->lastInsertId();
                                    $_SESSION['lastID'] = $last_id;


                                } catch (PDOException $e) {
                                    echo $e->getMessage();
                                }
                                header("Location: http://localhost/www/candidates/vote.php");
                            }








                        
                        }




                    }






















                }

            }

        }
    }
}

function test_age($date){
    if(date("Y") - $date >= 18){
        return true;
    }else{
        return false;
    }

}

function age_calculator($date){
    return date("Y") - $date;
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes(($data));
    $data = htmlspecialchars($data);
    return $data;
}

function test_email($user_email){
    if(filter_var($user_email , FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}


















?>





    <div class="row">
        <p class="h2" style="text-align: center; padding-top: 5%; font-family: 'Lato', sans-serif;">Registration And Candidates</p>
        <hr>
    </div>


    <div class="container">

            <!-- first candidate info -->
        <div class="row">
            <div class="col-lg-4 d-flex" style="text-align: center; padding-top: 10%; align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%; font-family: 'Lato', sans-serif;">

                <div class="card" style="height: 500px; width: 200px; object-fit: cover; filter:grayscale(50); ">
                    <img class="card-img-top" src="images\hossein.jpg" alt="Card image"  style="height: 300px; width: 200px; object-fit: cover; filter:grayscale(50);">
                    <div class="card-body">
                        <h4 class="card-title">Hossein Jabbarzadeh</h4>
                        <p class="card-text">Age: 20</p>
                        <p class="card-text">Educatioin: Doctore </p>
                        <p class="card-text">Faction: Dictator</p>
                    </div>
                </div>

            </div>

            <!-- second candidate info -->

            <div class="col-lg-4 d-flex" style="text-align: center; padding-top: 10%; align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%; font-family: 'Lato', sans-serif;">
                <div class="card" style="height: 500px; width: 200px; object-fit: cover; filter:grayscale(50); text-align: center; ">
                    <img class="card-img-top" src="images\obama.jpg" alt="Card image"  style="height: 300px; width: 200px; object-fit: cover; filter:grayscale(50);">
                    <div class="card-body">
                        <h4 class="card-title">Barac Obama</h4>
                        <p class="card-text">Age: 48</p>
                        <p class="card-text">Educatioin: Doctore </p>
                        <p class="card-text">Faction: Republican</p>
                    </div>
                </div>
            </div>

            <!-- third candidate info -->

            <div class="col-lg-4 d-flex" style="text-align: center; padding-top: 10%; align-items: center; justify-content: center; padding-left: 5%; padding-right: 5%; font-family: 'Lato', sans-serif;">
                <div class="card" style="height: 500px; width: 200px;object-fit: cover; filter:grayscale(50); text-align: center;">
                    <img class="card-img-top" src="images\trump.jpg" alt="Card image"  style="height: 300px; width: 200px; object-fit: cover; filter:grayscale(50);">
                    <div class="card-body">
                        <h4 class="card-title">Donald Trump</h4>
                        <p class="card-text">Age: 55</p>
                        <p class="card-text">Educatioin: Doctore </p>
                        <p class="card-text">Faction: Republican</p>
                    </div>
                </div>
            </div>

        </div>

 
    

            <!-- -->


            <!-- making form and getting input from user -->

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

            <div class="container">
                <p id="tile" class="h1" style="font-size: 34px; font-weight: bold; text-align: center; padding-top: 8%; font-family: 'Lato', sans-serif;">Register Form</p>
                <div class="row" id="first" style="display: block; text-align: center;">
                    <div id="name" class="col-lg-12 col-md-12" style="text-align: center; padding-top: 5%; padding-left: 0%; font-family: 'Lato', sans-serif; color: rgb(168, 170, 169); text-align: center;">
                        Name:  <input class="form-control" type="text" placeholder="Name" name="name" >
                        
                    </div>
                    <div id="family-name" class="col-lg-12 col-md-12" style="text-align: center; padding-top: 5%; padding-left: 0%; font-family: 'Lato', sans-serif; color: rgb(168, 170, 169);">
                        Family Name:  <input class="form-control" type="text" placeholder="Family Name" name="family-name" >
                        
                    </div>
                    <div id="email" class="col-lg-12 col-md-12" style="text-align: center; padding-top: 5%; padding-left: 0%; font-family: 'Lato', sans-serif; color: rgb(168, 170, 169);">
                        Birthday: <input class="form-control" type="number" name="birthday" min="1900" max="2099" step="1" name="birthday" value="2016" required >
                       
                    </div>
                    <div id="email" class="col-lg-12 col-md-12" style="text-align: center; padding-top: 5%; padding-left: 0%; font-family: 'Lato', sans-serif; color: rgb(168, 170, 169);">
                        Email: <input class="form-control" type="email" name="email" placeholder="Email" required style="color: rgb(168, 170, 169);">
                       
                    </div>
                </div>
               
        
        
                <div class="row" style="padding-top: 5%; display: flex; align-items: center; justify-content: center; font-family: 'Lato', sans-serif; padding-bottom: 5%;">
                    <span class="error" style="text-align:center; color:red; padding-bottom:1.5%;"><?php echo $nameErr ?></span>
                    <span class="error" style="text-align:center; color:red; padding-bottom:1.5%;"><?php echo $family_nameErr ?></span>
                    <span class="error" style="text-align:center; color:red; padding-bottom:1.5%;"><?php echo $date_of_birthErr ?></span>
                    <span class="error" style="text-align:center; color:red; padding-bottom:1.5%;"><?php echo $emailErr ?></span>
                    <input type="submit" class="btn btn-outline-success" style="width: 100px; justify-content: center; "></input>
                </div>
        
            </div>
    </div>




            
        
    </form>
</div>  

</body>
</html>