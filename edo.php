<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>New</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="edo.css">
    <script src="night.js"></script>
</head>

<body>
    <section class="container">
        <section id="data">
            <h2 class="data">Enter Data</h2><br>
            <form action="\project\edo.php" method="POST">
                <div class="nam">Enter your full name <input type="text" name="name" id="name" class="name1"
                        placeholder="Full name"></div>
                <br><br>
                <div class="nam">Enter Customer ID <input type="text" name="cid" id="cid" class="name1"
                        placeholder="ID"></div>
                <br><br>
                <div class="nam">Enter your Product name <input type="text" name="pname" class="name1" id="item"
                        placeholder="Product Name"></div>
                <br><br>
                <div class="nam">Enter the Quantity <input type="number" name="quantity" class="name1" id="quantity"
                        placeholder="Quantity"></div>
                <br><br>
                <div class="nam">Enter the Price <br><input type="number" name="price" id="price" class="name1"
                        placeholder="Price">
                </div><br><br>
                <button class="add1" id="add" name="submit">Add</button>
                <button class="add1" id="add2" name="submit2">Show</button>
            </form>
        </section>
    </section>
    <br><br>



    <div class="container1">
        <a href="add_new.php" class="btn btn-dark mb-3" ">Add New</a>
        <table class=" table table-hover text-center" id="mytab">
            <thead class="table-dark">
                <tr>
                    <th scope="co1">Sl_No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
        </table>
            <br><br>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
                integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous"></script>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous">

                <?php
                include 'basic.php'; 
                $sql="create table IF NOT EXISTS customers(cust_name varchar(30),cust_id int primary key)";
                $result=mysqli_query($conn,$sql); 
       
       
                
       
                if(isset($_POST['submit']))
                {
                   $cname = $_POST['name'];
                   $cid = $_POST['cid'];
                   
                   $sql = "select cust_id from customers where cust_id = $cid";
       
                   $result = mysqli_query($conn, $sql);
                   $i = mysqli_num_rows($result);
                   
                   if($i == 0)
                   {
                       $sql="insert into customers(cust_name,cust_id) values('$cname', '$cid')";
                       $res = mysqli_query($conn, $sql);
                   }
       
                   $sql="create table IF NOT EXISTS Bill(Sl_no int NOT NULL AUTO_INCREMENT, Product_Name varchar(20), Cust_ID int, Quantity int, Price int, Total_Price int, primary key(Sl_no), foreign key (Product_Name) references products(Product_name), foreign key (Cust_ID) references customers(cust_id))";
                   $result = mysqli_query($conn, $sql);
       
                   $pname = $_POST['pname'];
                   $quantity = $_POST['quantity'];
                   $price = $_POST['price'];
                   $tprice = $quantity * $price;
       
                  
                   
                   $sql = "insert into Bill(Product_Name, Cust_ID, Quantity, Price, Total_Price) values('$pname', '$cid', '$quantity', '$price', '$tprice')";
                   $result = mysqli_query($conn, $sql);
                   if($result)
                       echo "Data entered successfully!";
                   else
                       echo "Data not entered!". mysqli_error($conn);
       
                   $sql="update products set stock=100-'$quantity' where Product_name='$pname'";
                   $result=mysqli_query($conn,$sql);
                   if($result)
                    echo "update is successful";
                   else
                     echo "update is unsuccessful";
                   
                }
                
                if(isset($_POST['submit2']))
                {
                    echo "hi";
                    $cid=$_POST['cid'];
                    $sql = "select Product_name,Quantity,Price,Total_Price from Bill where Cust_ID='$cid'";
                    $result = mysqli_query($conn, $sql);
                    echo "<table>
                    <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    </tr>";
       
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                        echo "<td>" .$row['Product_name']. "</td>";
                        echo "<td>" .$row['Quantity']. "</td>";
                        echo "<td>" .$row['Price']. "</td>";
                        echo "<td>" .$row['Total_Price']. "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
               ?>
</body>

</html>