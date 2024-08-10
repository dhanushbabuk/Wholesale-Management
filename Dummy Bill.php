<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>New</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <section class="container">
        <section id="data">
          <h2>Enter Data</h2>
          <form action="\project\night.php" method="POST">
          <div>Enter your full name <input type="text" name="name" id="name" placeholder="Full name"></div><br><br>
          <div>Enter Customer ID <input type="text" name="cid" id="cid" placeholder="ID"></div><br><br>
          <div>Enter your Product name <input type="text" name="pname" id="item" placeholder="Product Name"></div><br><br>
          <div>Enter the Quantity <input type="number" name="quantity" id="quantity" placeholder="Quantity"></div><br><br>
          <div>Enter the Price <input type="number" name="price" id="price" placeholder="Price"></div><br><br>
          <button id="add" name="submit">Add</button>
          </form>
        </section>
      </section>
      <br><br>
        <table id="mytab" border="2px">
            <tr>
                <th>Sl no.</th>
                <th>Item name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </table>
        <br><br>
        <p id="info"></p>
       
        <script src="night.js"></script>
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
            $result = mysqli_query($conn,$sql);
            if($result)
             echo "update is successful";
            else
              echo "update is unsuccessful";
            
        }
        ?>


    </body>
</html>
