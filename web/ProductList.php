

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-3 ml-2">
            <input type="button" value="Sort By Name" class="btn btn-info name">
        </div>
        <div class="col-lg-3 ml-2">
            <input type="button" value="Sort By Price" class="btn btn-info price">
        </div>
        <div class="col-lg-3 ml-2 mb-5">
            <select class="form-select category btn btn-info" name="category" aria-label="Default select example">
                
            </select>
        </div>
        <div class="col-lg-7">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script>
    $(document).ready( (e) => {
        function ajax(url,tags){
            $.ajax({
                url : url,
                success : (e) => {
                    $(tags).html(e);
                }
            })
        }
        ajax("web/backend/LoadProduct.php","tbody");
        ajax("web/backend/LoadCategorys.php",".category");
        $(".name").click( (e) => {
            name = $(".name").val();
            $.ajax({
                url : "web/backend/LoadProductSortName.php",
                method : "POST",
                success : (e) => {
                    console.log(e);
                    $("tbody").html(e);
                }
            })
        } )
        $(".price").click( (e) => {
            $.ajax({
                url : "web/backend/LoadProductSortPrice.php",
                method : "POST",
                success : (e) => {
                    console.log(e);
                    $("tbody").html(e);
                }
                })
        
        } )
        $(".category").change( (e) => {
            if($(".category").val() == ""){
                ajax("web/backend/LoadProduct.php","tbody");
            }else{
                category = $(".category").val();
                $.ajax({
                    url : "web/backend/LoadProductSortCategory.php",
                    method : "POST",
                    data : {category},
                    success : (e) => {
                        console.log(e);
                        $("tbody").html(e);
                    }
                })
            }
        } )
    } )
</script>