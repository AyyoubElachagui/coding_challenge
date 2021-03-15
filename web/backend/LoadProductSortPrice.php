<?php
    require "../../server.php";
    require "../../class/Class_Product.php";
    $Product = new Product();
    $cmd = "SELECT * FROM product order by `price` asc ";
    $res = mysqli_query($con,$cmd);
    while($row = mysqli_fetch_row($res)){
        $cmd = "SELECT * FROM category where `id` = '$row[5]' ";
        $qry = mysqli_query($con,$cmd);
        $row_ = mysqli_fetch_row($qry)
?>
    <tr>
        <th scope="col"><?php echo $row[0]; ?></th>
        <th scope="col"><?php echo $row[1]; ?></th>
        <th scope="col"><?php echo $row[2]; ?></th>
        <th scope="col"><?php echo $row[3]; ?></th>
        <th scope="col"><img src="<?php echo $row[4]; ?>" width="30" height="30"></th>
        <th scope="col"><?php echo $row_[1]; ?></th>
    </tr>
<?php
    }
?>