<?php
require("config.php");
try {

    $conn = new PDO("mysql:host=" . host . ";dbname=" . dbname . "", user, pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection is successful";


    
		$login = $conn -> query("SELECT * FROM presidents WHERE presName = 'Mohammad Hossein'");
		$login ->execute();

		$fetch = $login -> fetch (PDO:: FETCH_ASSOC);
		if($login -> rowCount() < 1){
            $sql = "INSERT INTO presidents (presName, presFamilyName, fiction , about , years)
            VALUES ('Mohammad Hossein', 'Jabbarzadeh', 'Dictator' , 'A relax person' , '20')";
            $conn->exec($sql);
			
		}

    

    $login = $conn->query("SELECT * FROM presidents WHERE presName = 'Barac'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);
    if ($login->rowCount() < 1) {
        $sql = "INSERT INTO presidents (presName, presFamilyName, fiction , about , years)
            VALUES ('Barac', 'Obama', 'Republican' , 'A kind person' , '47')";
        $conn->exec($sql);

    }

    $login = $conn->query("SELECT * FROM presidents WHERE presName = 'Donald'");
    $login->execute();

    $fetch = $login->fetch(PDO::FETCH_ASSOC);
    if ($login->rowCount() < 1) {
        $sql = "INSERT INTO presidents (presName, presFamilyName, fiction , about , years)
            VALUES ('Donald', 'Trump', 'Democrate' , 'A powerfull man' , '68')";
        $conn->exec($sql);

    }



    



} catch (PDOException $e) {
    // roll back the transaction if something failed
    // $conn->rollback();
    echo "Error: " . $e->getMessage();
}



$conn = null;



?>