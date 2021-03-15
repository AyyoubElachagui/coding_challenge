<?php
    class Product{
        // attributs
        public $Name = "";
        public $Description = "";
        public $Price ;
        public $Image = "";
        public $Id_Category = "";
        //constructeur par default
        function __construct(){}
        //property
        //set and get for name product
        public function setName($Name){
            if(trim($Name) == "") $this->Name = "";
            else $this->Name = $Name;
        }
        public function getName(){ return $this->Name; }
        //set and get for Description product
        public function setDescription($Description){
            if(trim($Description) == "") $this->Description = "";
            else $this->Description = $Description;
        }
        public function getDescription(){ return $this->Description; }
        //set and get for price product
        public function setPrice($Price){
            if(!floatval(trim($Price))) $this->Price = "";
            else $this->Price = $Price;
        }
        public function getPrice(){ return $this->Price; }
        //set and get for image product
        public function setImage($Image){
            $ext = array(".png",".jpg",".jpeg");
            if(in_array(strtolower(substr(trim($Image),strlen(strtok(trim($Image),".")),strlen(trim($Image)))),$ext)) $this->Image = strtolower($Image);
            else $this->Image = "";
        }
        public function getImage(){ return $this->Image; }
        //set and get for id category
        public function setIdCategory($con,$Category){
            $cmd = "SELECT * from category where `name` = '$Category' " ;
            if($res = mysqli_query($con,$cmd)){
                if($row = mysqli_fetch_row($res)){
                    $this->Id_Category = $row[0];
                }else $this->Id_Category = "";
            }else{
                $this->Id_Category = "";
            }
        }
        public function getIdCategory(){ return $this->Id_Category; }
        //method find product with name 
        public function findProduct($con){
            $return = false;
            $name = $this->getName();
            $cmd = "SELECT count(*) from product where `name` LIKE '$name' ";
            if($res = mysqli_query($con,$cmd)){
                $row = mysqli_fetch_row($res);
                if($row[0] != 0){
                    $return = true;
                }
            }
            return $return;
        }
        //method find product with PRICE 
        public function findProductPrice($con){
            $return = "false";
            $price = $this->getPrice();
            $cmd = "SELECT count(*) from product where `price` = '$price' ";
            if($res = mysqli_query($con,$cmd)){
                $row = mysqli_fetch_row($res);
                if($row[0] != 0){
                    $return = "true";
                }
            }
            return $return;
        }
        //method create product 
        public function createProduct($con){
            $return = "error";
            $name = $this->getName();
            $description = $this->getDescription();
            $price = $this->getPrice();
            $image = $this->getImage();
            $id_category = $this->getIdCategory();
            if(empty(trim($name)) && empty(trim($description)) && empty(trim($price)) && empty(trim($image)) && empty(trim($id_category)) ){
                $return = "false";
            }else{
                if($this->findProduct($con)){
                    $return = "Product already exists !!";
                }else{
                    $cmd = "INSERT INTO product VALUES (null,'$name','$description','$price','$image','$id_category') ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }
                }
            }
            return $return;
        }
        //method create product 
        public function createProductWeb($con,$id){
            $return = "error";
            $name = $this->getName();
            $description = $this->getDescription();
            $price = $this->getPrice();
            $image = $this->getImage();
            $id_category = $id;
            if(empty(trim($name)) && empty(trim($description)) && empty(trim($price)) && empty(trim($image)) && empty(trim($id_category)) ){
                $return = "false";
            }else{
                if($this->findProduct($con)){
                    $return = "Product already exists !!";
                }else{
                    $cmd = "INSERT INTO product VALUES (null,'$name','$description','$price','$image','$id_category') ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }
                }
            }
            return $return;
        }
        //Product list web 
        public function ProductList($con){
            $cmd = "SELECT * from product ";
            return mysqli_query($con,$cmd);
        }
       
        //method delete product with name
        public function deleteProductWithName($con){
            $return = "false";
            $name = $this->getName();
            if(!empty(trim($name))){
                if($this->findProduct($con)){
                    $cmd = "DELETE FROM product where `name` = '$name' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }
                }else{
                    $return = "Product Name is not exists !!";
                }
            }
            return $return;
        }
        //method delete product with price
        public function deleteProductWithPrice($con){
            $return = "false";
            $price = $this->getPrice();
            if(!empty(trim($price))){
                if($this->findProductPrice($con) == "true"){
                    $cmd = "DELETE FROM product where `price` = '$price' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }
                }else{
                    $return = "Price of Product is not exists !!";
                }
            }
            return $return;
        }
            
    }
?>