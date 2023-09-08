<?php 
require ("config.php");
session_start();
$voted = 0 ;
$first = 0 ;
$second = 0;
$third = 0 ;
$precent_first ="";
$percent_second = "";
$percent_third = "";
$voted_person = $_SESSION['voted'] ;
?>


<!DOCTYPE html>
<html>
<title>Result</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <link rel="stylesheet" href="design_result.css">
<body>
<div class="w3-container">

<h2 class="title" style="padding-bottom: 10%;">Result</h2>
<?php



$conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT id FROM users");
$stmt->execute();


$result = $stmt->fetchAll();
foreach ($result as $total) {
  $voted++;
}



// count of first candidate
$stmt = $conn->prepare("SELECT id FROM users WHERE choosed = 1");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->fetchAll();
foreach ($result as $firstCan) {
  $first++;
}





// count of second candidate
$stmt = $conn->prepare("SELECT choosed FROM users WHERE choosed = 2");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->fetchAll();
foreach ($result as $secondCan) {
  $second++;
}









// count of third candidate
$stmt = $conn->prepare("SELECT choosed FROM users WHERE choosed = 3");
$stmt->execute();

// set the resulting array to associative
$result = $stmt->fetchAll();
foreach ($result as $thirdCan) {
  $third++;
}















$precent_first = ($first / $voted) * 100;
$percent_second =  ($second / $voted) * 100;
$percent_third = ($third / $voted) * 100;






 ?>
<br>
<div class="container">
  
  <div style="padding-top:1%" >
    <p class="h3" style="text-align:center;">Mohammad Hossein Jabbarzadeh</p>
    <div class="progress">
      <div  class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $precent_first; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $precent_first; ?>%"><?php echo $precent_first ?>%</div>
    </div><br>
  </div>
  <div style="padding-top:1%" >
    <p class="h3" style="text-align:center;">Barack Obama</p>
    <div class="progress"> 
      <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo  $percent_second; ?>" aria-valuemin="0" aria-valuemax="100"   style="width:<?php echo $percent_second; ?>%"><?php echo $percent_second ?>%</div>
    </div><br>
  </div>

  <div style="padding-top:1%" >
    <p class="h3" style="text-align:center;">Donald Trump</p>
    <div class="progress">
      <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo $percent_third; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $percent_third; ?>%"><?php echo $percent_third ?>%</div>
    </div><br>
  </div>

</div>
</body>
</html>


