<?php
    session_start();
    $return = "";
    
    if(isset($_SESSION["create"])){
        $return = $_SESSION["create"];
    }
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-7">
        <div class="div-pro">
            <span class="test-pro"></span>
        </div>
        <form action="web/backend/CreateProduct.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name-product">Product name</label>
                <input type="text" name="name-product" class="form-control" id="name-product"  placeholder="product name">
            </div>
            <div class="form-group">
                <label for="description-product">Product description</label>
                <input type="text" name="description-product" class="form-control" id="description-product"  placeholder="product description">
            </div>
            <div class="form-group">
                <label for="price-product">Product price</label>
                <input type="text" name="price-product" class="form-control" id="price-product"  placeholder="product price">
            </div>
            <div class="form-group">
                <label for="img">Product image</label>
                <input type="file" name="file" class="form-control" id="img">
            </div>
            <div class="form-group">
                <select class="form-select categorys" name="category" aria-label="Default select example">
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-50">Submit</button>
        </form>
        </div>
    </div>
</div>
<script>
    $(document).ready( () => {
        test = "<?php echo $return;  ?>";
        if(test != ""){
            switch(test){
                case "true":
                    $(".div-pro").addClass("alert alert-success");
                    $(".test-pro").text("Product Added successfully");
                    setTimeout(() => {
                        <?php $_SESSION["create"] = "" ?>
                        $(".div-pro").removeClass("alert alert-success");
                        $(".test-pro").text("");
                    }, 3000);
                break;
                case "false":
                    $(".div-pro").addClass("alert alert-danger");
                    $(".test-pro").text("Error plaese try again");
                    setTimeout(() => {
                        <?php $_SESSION["create"] = "" ?>
                        $(".div-pro").removeClass("alert alert-danger");
                        $(".test-pro").text("");
                    }, 3000);
                break;
                default:
                    $(".div-pro").addClass("alert alert-info");
                        $(".test-pro").text($test);
                        setTimeout(() => {
                            <?php $_SESSION["create"] = "" ?>
                            $(".div-pro").removeClass("alert alert-info");
                            $(".test-pro").text("");
                        }, 3000);
                break;
            }
        }
        $.ajax({
            url : "web/backend/LoadCategorys.php",

            success : (e) => {
                $(".categorys").html(e);
            }
        })
    } )
</script>