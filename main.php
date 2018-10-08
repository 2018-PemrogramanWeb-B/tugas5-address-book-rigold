<?php
	include("connect.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tugas 5</title>
	</head>
	<body>
		<h1>Formulir Address Book</h1>
		<h3>Input</h3>
		<form action = "" method = "post">
			<p>
			<label>Nama :</label> <input type = "text" name = "nama" required placeholder = "Masukkan Nama">
			</p>
			<p>
			<label>Alamat :</label> <input type = "text" name = "alamat" placeholder = "Masukkan Alamat">
			</p>
			<p>
			<label>Telfon :</label> <input type = "text" name = "telfon" placeholder = "Masukkan No. Telfon">
			</p>
			<input type = "submit" value = "Submit" name = "submit">
		</form>

		<h3>Edit</h3>
		<form action = "" method = "post">
			<p>
			<label>Type :</label> <select name = "pilih">
				<option value = "1">Nama</option>
            	<option value = "2">Alamat</option>
            	<option value = "3">Telfon</option>
			</select>
			</p>
			<p>
			<label>From :</label> <input type = "text" name = "old">
			</p>
			<p>
			<label>To :</label> <input type = "text" name = "new">
			</p>
			<input type = "submit" value = "Update" name = "update">
		</form>

		<h3>Delete</h3>
		<form action = "" method="post">
			<p>
			<label>No :</label> <input type = "text" name = "delete">
			</p>
			<input type = "submit" value = "Delete" name = "del">
		</form>

		<h3>Show Table</h3>
		<form action="" method="post">
			<button type = "submit" value = "Show Table" name = "show">Show Table</button><br>
		</form>
	</body>
</html>

<?php
	//Submit Data
	if(isset($_POST["submit"]))
	{
        $nama=$_POST['nama'];
        $alamat=$_POST['alamat'];
        $telfon=$_POST['telfon'];
        if($conn->query("INSERT INTO address_book (Nama,Alamat,Telfon)
                        VALUES ('".$nama."','".$alamat."','".$telfon."')") == true)
        {
            echo "Data Added<br>";
        }
        else
        	echo "Failed";
    }

    //Edit Data
    if(isset($_POST["update"]))
    {
        $old = $_POST["old"];
        $new = $_POST["new"];
        if($_POST["pilih"])
        {
            $val = $_POST["pilih"];
            if($val == 1)
            {
                $pilih = "Nama";
            }
            else if($val == 2)
            {
                $pilih = "Alamat";
            }
            else if($val == 3)
            {
                $pilih = "Telfon";
            }

            if($conn->query("UPDATE address_book
                            SET ".$pilih." = '".$new."'
                            WHERE ".$pilih." = '".$old."'") == true)
            {
                echo "Update Done<br>";
            }
            else
            {
                echo "Update Failed<br>";
            }
        }
    }

    //Delete Data
    if(isset($_POST["del"]))
    {
	    if($conn->query("DELETE FROM address_book WHERE No = ".$_POST["delete"]."") == true)
	    {
	        echo "Data Deleted";
	    }
    }

    //Show Table
    if(isset($_POST["show"]))
    {
        $sql = "SELECT No, Nama, Alamat, Telfon FROM address_book";
        $table = mysqli_query($conn,$sql);

        if(mysqli_num_rows($table)>0)
        {
            echo "<table border = '2'>
                      <tr>
                      	<th>No</th>
                      	<th>Nama</th>
                      	<th>Alamat</th>
                      	<th>Telfon</th>
                      </tr>";
            while($row = mysqli_fetch_assoc($table))
            {
                echo "<tr>
                <td>".$row["No"]."</td>
                <td>".$row["Nama"]."</td>
                <td>".$row["Alamat"]."</td>
                <td>".$row["Telfon"]."</td>";
            }
        }
        else
        	echo "Empty Table";
    }
?>