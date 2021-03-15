<?php
    require "../../server.php";
    require "../../class/Class_Product.php";
    session_start();
	$reponse ="";
	$ext = array('jpeg' , 'jpg' , 'png');
	$pic = $_FILES['file']['tmp_name'];
    $upload_folder = '../image/';
    $image = "";
    if(isset($pic))
    {
        $image = $_FILES['file']['name'];
        $extn = end(explode('.' , $image));
        if(in_array($extn, $ext))
        {
            $uploadpc = move_uploaded_file($pic, $upload_folder.$image);
            if($uploadpc)
            {   
                $reponse = "nice";
            }
                            
        }
    }
    if($reponse == "nice"){
        $Product = new Product();
        $category = $_POST["category"];
        echo $category;
        $Product->setName($_POST["name-product"]);
        $Product->setDescription($_POST["description-product"]);
        $Product->setPrice($_POST["price-product"]);
        $Product->setImage("web/image/".$image);
        $Product->setIdCategory($con,$category);
        echo $Product->getName()."  ".$Product->getDescription()."  ".$Product->getPrice()."  ".$Product->getImage()."  ".$Product->getIdCategory();
        $test = $Product->createProductWeb($con,$category);
        if($test == "true") {
            header("Location: ../../index.php");
            $_SESSION["create"] = "true";
        }
        else if ($test == "false"){
            header("Location: ../../index.php");
            $_SESSION["create"] = "false";
        }else{
            header("Location: ../../index.php");
            $_SESSION["create"] = $test;
        }
    }else{
        header("Location: ../../index.php");
        $_SESSION["create"] = "false";
    }
?>