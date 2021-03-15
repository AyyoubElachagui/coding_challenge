<?php
    class Category{
        // attributs
        public $Name = "";
        public $Parent_Category = "";
        //constructeur par default
        function __construct(){}
        //property
        //set and get for name category
        public function setName($Name){
            if(trim($Name) == "") $this->Name = "";
            else $this->Name = $Name;
        }
        public function getName(){ return $this->Name; }
        //set and get for parent category
        public function setParentCategory($Parent_Category){
            if(trim($Parent_Category) == "" || strtolower(trim($Parent_Category)) == "null" ) $this->Parent_Category = "";
            else $this->Parent_Category = $Parent_Category;
        }
        public function getParentCategory(){ return $this->Parent_Category; }
        //method for get Id Category with name
        public function getIdNameCategory($con){
            $return = false;
            $name = $this->getName();
            $cmd = "SELECT * from category where `name` = '$name' " ;
            if($res = mysqli_query($con,$cmd)){
                if($row = mysqli_fetch_row($res)){
                    $return = $row[0];
                }
            }
            return $return;
        }
        //method for get Id Category with parent category 
        public function getIdParentCategory($con){
            $return = false;
            $parent_category = $this->getParentCategory();
            $cmd = "SELECT * from category where `parent_category` = '$parent_category' " ;
            if($res = mysqli_query($con,$cmd)){
                if($row = mysqli_fetch_row($res)){
                    $return = $row[0];
                }
            }
            return $return;
        }
        //method find with where 
        public function findParentCategory($con){
            $return = false;
            $parentCategory = $this->getParentCategory();
            $cmd = "SELECT count(*) from category where `name` LIKE '$parentCategory' ";
            if($res = mysqli_query($con,$cmd)){
                $row = mysqli_fetch_row($res);
                if($row[0] != 0){
                    $return = true;
                }
            }
            return $return;
        }
        //method create Category with parent category null
        public function createCategoryWithNull($con){
            $return = false;
            $name = $this->getName();
            if(empty(trim($name))){
                $return = false;
            }else{
                $cmd = "INSERT INTO category VALUES(null,'$name',null) ";
                if($res = mysqli_query($con,$cmd)){
                    $return = true;
                }
            }
            return $return;
        }
        // method create category with parent category
        public function createCategoryWithParentCategory($con){
            $return = false;
            $name = $this->getName();
            $parent_category = $this->getParentCategory();
            if(empty(trim($name)) && empty(trim($parent_category))){
                $return = "false";
            }else{
                if($this->findParentCategory($con)){
                    $cmd = "INSERT INTO category VALUES (null,'$name','$parent_category') ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }
                }else{
                    $return = "Parent Category is not exists !!";
                }
            }
            return $return;
        }
        //method delete Category with name
        public function deleteCategoryName($con){
            $return = "false";
            $name = $this->getName();
            if($id = $this->getIdNameCategory($con)){
                $cmd = "DELETE FROM product where id_category = $id";
                if(mysqli_query($con,$cmd)){
                    $cmd = "DELETE FROM category where `name` = '$name' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }else{
                        $return = "false";
                    }
                }else{
                    $cmd = "DELETE FROM category where `name` = '$name' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }else{
                        $return = "false";
                    }
                }
            }else{
                $return = "Category Name is not exists !!";
            }
            
            return $return;
        }
        //method delete Category with parent category
        public function deleteParentCategory($con){
            $return = "false";
            $parent_category = $this->getParentCategory();
            if($id = $this->getIdParentCategory($con)){
                $cmd = "DELETE FROM product where id_category = $id";
                if(mysqli_query($con,$cmd)){
                    $cmd = "DELETE FROM category where `parent_category` = '$parent_category' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }else{
                        $return = "false";
                    }
                }else{
                    $cmd = "DELETE FROM category where `parent_category` = '$parent_category' ";
                    if($res = mysqli_query($con,$cmd)){
                        $return = "true";
                    }else{
                        $return = "false";
                    }
                }
            }else{
                $return = "Category Name is not exists !!";
            }
            
            return $return;
        }
        
    }
?>