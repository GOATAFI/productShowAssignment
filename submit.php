<?php
include('dbConn.php');

if (isset($_POST['submit'])) {
    // Debugging: Check if form fields are received correctly
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $productionDate = $_POST['productionDate'];
    // echo "ID: $id, Name: $name, Category: $category, Production Date: $productionDate<br>";

    if (isset($_FILES['image']['name'])) {
        //get the details of selected image
        $image = $_FILES['image']['name'];
        //check whether image is selected or not and upload image only if selected
        if ($image != "") {
            //image is selected
            //rename the image
            //get the extension
            $image_parts = explode('.', $image); // Explode the filename
            $ext = end($image_parts); // Get the last part, which is the extension
            $image = "Product-Name-" . rand(0, 99999) . "." . $ext;
            //upload the image
            //get the source and destination path
            $src = $_FILES['image']['tmp_name'];
            $dst = "images/" . $image; //corrected path
            //finally upload the image
            $upload = move_uploaded_file($src, $dst);
            //check whether uploaded or not
            if ($upload == false) {
                $_SESSION['upload'] = "<div>Failed to upload image</div>";
                header('location:' . SITEURL);
                exit();
            }
        }
    } else {
        $image = "";
    }

    // Debugging: Check if SQL query is formed correctly
    $sql = "INSERT INTO products SET name = '$name', category = '$category', productionDate = '$productionDate', image = '$image' ";
    // echo "SQL Query: $sql<br>";

    // Execute SQL query
    $res = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if ($res == true) {
        echo "<p style='color:green'>Product Added successfully</p>";
?>
        <br>
        <div style="display: flex; margin: 15px; ">
            <a href="index.php" style="padding: 10px; margin: 10px; width: 85px; border-radius: 10px; background-color: green; color: white; text-align: center; display: inline-block; text-decoration: none;">Home</a>
            <a href="addProduct.html" style="padding: 10px; margin: 10px; width: 85px; border-radius: 10px; background-color: blue; color: white; text-align: center; display: inline-block; text-decoration: none;">Add Product</a>
        </div>
<?php
    } else {
        echo "Product Added failed ";
    }
}
?>