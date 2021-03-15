<?php
    require "../../server.php";
    $cmd = "SELECT * FROM category";
    if($res = mysqli_query($con,$cmd)){
?>
        <option value="">--  Categorys  --</option>
<?php
        while($row = mysqli_fetch_row($res)){
?>
            <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
<?php
        }
    }
?>