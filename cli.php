<?php
    // call file server
    require "server.php";
    require "class/Class_Category.php";
    require "class/Class_Product.php";
    if($con){
        $Category = new Category();
        $Product = new Product();
        //show menu
        function showMenu(){
            echo ("\n\n******* Menu *******");
            echo ("\n1- Category\n");
            echo ("2- Product \n");
            echo ("3- Exit \n");
            echo ("\n\nMake Your Choice :\n");
        }
        //show seconde menu
        function secondMenu($section){
            echo ("\n\n******* '$section' *******");
            echo ("\n1 - Create\n");
            echo ("2 - Delete \n");
            echo ("3 - Go Back \n");
            echo ("\n\nMake Your Choice :\n");
        }
        //show Required fields
        function RequireFields(){
            echo "\n\n\033[36m  please Make sure all fields are filld  \033[0m\n";
            echo "\n\ntype 1 to repete :";
            $test_repete = fgets(STDIN,1024);
            if($test_repete == 0 ) return true;
            else if($test_repete == 1 ) return false;
        }
        //show error
        function Error(){
            echo "\n\n\033[31m  Error Try again !!!  \033[0m\n";
            echo "\n\ntype 1 to repete :";
            $test_repete = fgets(STDIN,1024);
            if($test_repete == 0 ) return true;
            else if($test_repete == 1 ) return false;
        }
        //test if delete or not 
        function delete($test,$section){
            $test_delete = false;
            if(trim($test) == "true"){
                echo "\n\n\033[36m '$section' Deleted Successfully  \033[0m\n";
                $test_delete = true;
            }else if (trim($test) == "false"){
                $test_delete = Error();
            }else{
                echo "\n\n\033[36m".$test."\033[0m\n";
                $test_delete = Error();
            }
            return $test_delete;
        }
        //start menu
        // Menu for choice 
        $choice;
        echo ("\n\n\n************ Welcome To Coding Challenges From Next Media ************\n");
        do {
            # code...
            showMenu();
            $choice = fgets(STDIN,1024);
            switch($choice){
                # START CREATE AND DELETE CATEGORY
                case 1:
                    # code...
                    do {
                        # code...
                        secondMenu("Category");
                        $choice_cat = fgets(STDIN,1024);
                        switch($choice_cat){
                            #CREATE CATEGORY
                            case 1:
                                # code...
                                    do {
                                        # code...
                                        echo ("\n\n******* Create category *******");
                                        echo ("\n Category's name :");
                                        $Name_Category = fgets(STDIN,1024);
                                        echo ("\n Parent category :");
                                        $Parent_Category = fgets(STDIN,1024);
                                        $Category->setName($Name_Category);
                                        $Category->setParentCategory($Parent_Category);
                                        $test_create = false;
                                        if(empty(trim($Parent_Category))){
                                            if($Category->createCategoryWithNull($con)){
                                                echo "\n\n\033[36mCategory Added Successfully \033[0m\n";
                                                $test_create = true;
                                            }else{
                                                $test_create = Error();
                                            }
                                        }else if (empty(trim($Name_Category)) && empty(trim($Parent_Category))){
                                            $test_create = RequireFields();
                                        }else{
                                            if(trim($Category->createCategoryWithParentCategory($con)) == "true"){
                                                echo "\n\n\033[36mCategory Added Successfully  \033[0m\n";
                                                $test_create = true;
                                            }else if(trim($Category->createCategoryWithParentCategory($con)) == "Parent Category is not exists !!"){
                                                echo "\n\n\033[36m".$Category->createCategoryWithParentCategory($con)."\033[0m\n";
                                                $test_create = Error();
                                            }else{
                                                $test_create = Error();
                                            }
                                        }
                                    } while (!$test_create);
                            break;
                            #DELETE CATEGORY
                            case 2:
                                # code...
                                    # code...
                                        $test_create = false;
                                    do {
                                        # code...
                                        echo ("\n\n\033[31m******* Delete category *******\033[0m\n");
                                        echo ("\n 1 - delete with name category ");
                                        echo ("\n 2 - delete with parent category ");
                                        echo ("\n 3 - go back ");
                                        echo ("\n\nMake Your Choice :\n");
                                        $choice_d_cat = fgets(STDIN,1024);
                                        switch(trim($choice_d_cat)){
                                            #DELETE CATEGORY WITH NAME
                                            case 1:
                                                # code...
                                                $test_delete = false;
                                                do {
                                                    echo ("\n\n\033[31m******* Delete category with name *******\033[0m\n");
                                                    echo ("\n\nName category :\n");
                                                    $name = fgets(STDIN,1024);
                                                    $Category->setName($name);
                                                    $test = $Category->deleteCategoryName($con);
                                                    $test_delete = delete($test,"Category");
                                                } while (!$test_delete);
                                            break;
                                            #DELETE CATEGORY WITH PARENT CATEGORY
                                            case 2:
                                                $test_delete = false;
                                                do {
                                                    echo ("\n\n\033[31m******* Delete category with Parent category *******\033[0m\n");
                                                    echo ("\nParent category :\n");
                                                    $parent_category = fgets(STDIN,1024);
                                                    $Category->setParentCategory($parent_category);
                                                    $test = $Category->deleteParentCategory($con);
                                                    $test_delete = delete($test,"Category");
                                                } while (!$test_delete);
                                            break;
                                            case 3:
                                                # code...
                                                $test_create = true ;
                                            break;
                                            default :
                                                echo "\n\n\033[31m  Error !!!! try again \033[0m\n";
                                                $test_create = false;
                                            break;
                                        }
                                    } while (!$test_create);
                            break;
                            default :
                                echo "\n\n\033[31m  Error !!!! try again \033[0m\n";
                            break;
                        }
                    } while ($choice_cat != 3);
                    break;
                #END CREATE AND DELETE CATEGORY
    
                #START CREATE AND DELETE PRODUCT
                case 2:
                    # code...
                    do {
                        # code...
                        secondMenu("Product");
                        $choice_pro = fgets(STDIN,1024);
                        switch($choice_pro){
                            #start create product
                            case 1:
                                # code...
                                    do {
                                        # code...
                                        echo ("\n\n******* Create Product *******");
                                        echo ("\n Name :");
                                        $name_product = fgets(STDIN,1024);
                                        echo ("\n Description :");
                                        $desc_product = fgets(STDIN,1024);
                                        echo ("\n Price :");
                                        $price_product = fgets(STDIN,1024);
                                        echo ("\n Image (PATH) :");
                                        $image_product = fgets(STDIN,1024);
                                        echo ("\n Category Name :");
                                        $name_category = fgets(STDIN,1024);
                                        $Product->setName($name_product);
                                        $Product->setDescription($desc_product);
                                        $Product->setPrice($price_product);
                                        $Product->setImage($image_product);
                                        $Product->setIdCategory($con,$name_category);
                                        $test_create = false;
                                        $test_product = $Product->createProduct($con);
                                        if(trim($test_product) == "true"){
                                            echo "\n\n\033[36mProduct Added Successfully \033[0m\n";
                                            $test_create = true;
                                        }else if (trim($test_product) == "false"){
                                            echo "\n\n\033[36mWarning | name is string | description is string | price is float | image (Ex: aaa.png / aaa.jpg / aaa.jpeg ) |  and Category Name | \033[0m\n";
                                            $test_create = RequireFields();
                                        }else{
                                            echo "\n\n\033[36m".$test_product."\033[0m\n";
                                            $test_create = Error();
                                        }
                                    } while (!$test_create);
                            break;
                            #end create product
    
                            #start delete product
                            case 2:
                                # code...
                                    # code...
                                        $test_create = false;
                                    do {
                                        # code...
                                        echo ("\n\n\033[31m******* Delete product *******\033[0m\n");
                                        echo ("\n 1 - delete product with name ");
                                        echo ("\n 2 - delete product with price ");
                                        echo ("\n 3 - go back ");
                                        echo ("\n\nMake Your Choice :\n");
                                        $choice_d_pro = fgets(STDIN,1024);
                                        switch(trim($choice_d_pro)){
                                            #delete product with name
                                            case 1:
                                                # code...
                                                $test_delete = false;
                                                do {
                                                    echo ("\n\n\033[31m******* Delete Product with name *******\033[0m\n");
                                                    echo ("\n\nProduct Name :\n");
                                                    $name = fgets(STDIN,1024);
                                                    $Product->setName($name);
                                                    $test = $Product->deleteProductWithName($con);
                                                    $test_delete = delete($test,"Product");
                                                } while (!$test_delete);
                                            break;
                                            #delete product with price
                                            case 2:
                                                $test_delete = false;
                                                do {
                                                    echo ("\n\n\033[31m******* Delete Product with price *******\033[0m\n");
                                                    echo ("\n\nProduct Price :\n");
                                                    $price = fgets(STDIN,1024);
                                                    $Product->setPrice($price);
                                                    $test = $Product->deleteProductWithPrice($con);
                                                    $test_delete = delete($test,"Product");
                                                } while (!$test_delete);
                                            break;
                                            case 3:
                                                # code...
                                                $test_create = true ;
                                            break;
                                            default :
                                                echo "\n\n\033[31m  Error !!!! try again \033[0m\n";
                                                $test_create = false;
                                            break;
                                        }
                                    } while (!$test_create);
                            break;
                            default :
                                echo "\n\n\033[31m  Error !!!! try again \033[0m\n";
                            break;
                        }
                    } while ($choice_pro != 3);
                    break;
                # END CREATE AND DELETE PRODUCT 
    
                #EXIT MENU
                case 3:
                    # code...
                    echo "\n\n\033[36m  Good Bye  \033[0m\n";
                    break;
                # IF VALUE CHOICE != 1 || != 2 || != 3
                default :
                    echo "\n\n\033[31m  Error !!!! try again \033[0m\n";
                    break;
            }
        } while( $choice != 3 );
    }else{
        echo "\n\n\033[31m  Server Local not runnig try again \033[0m\n";
    }

?>