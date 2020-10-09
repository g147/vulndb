<?php
session_start();
print_r("<br><center><h1>VulnDB[0.1]{alpha}</h1></center><br><br>");
if(isset($_GET['response'])){
    print_r("<center><br>status: ".$_GET['response']."<br> <br><center>");
}
if(isset($_SESSION['username'])){
    echo <<< END_OF_TEXT
    <body>
    <center>
    <form method="post" action="api/authenticate.php">
        <input type="submit"  name="signout" value="SIGN OUT"/><br/><br/>
    </form>
    END_OF_TEXT;
    if(isset($_GET['cve'])){
        echo <<< END_OF_TEXT
        <body>
            <form id="db" method="post" action="api/vulndb.php">
        END_OF_TEXT;
        $cve=$_GET['cve'];
        $product=$_GET['product'];
        $version=$_GET['version'];
        $port=$_GET['port'];
        $author=$_GET['author'];
        $type=$_GET['type'];
        $date=$_GET['date'];
        $desc=$_GET['desc']; 
        echo "<input type='number' value='$cve' name='cve' placeholder='CVE'/><br><br>";
        echo "<input type='text' value='$product' name='product' placeholder='PRODUCT' /><br><br>";
        echo "<input type='text' value='$version' name='version' placeholder='VERSION'/><br><br>";
        echo "<input type='number' value='$port' name='port' placeholder='PORT'/><br><br>";
        echo "<input type='text' value='$author' name='author' placeholder='AUTHOR'/><br><br>";
        echo "<input type='text' value='$type' name='type' placeholder='TYPE'/><br><br>";
        echo "<input type='date' value='$date' name='date' placeholder='DATE'/><br><br>";
        echo "<textarea rows=10 cols=70 name='desc' placeholder='DESCRIPTION'>$desc</textarea><br><br>";								
    }
    else{     
        echo <<< END_OF_TEXT
        <body>
            <form id="db" method="post" action="api/vulndb.php">
                <input type="number" placeholder="CVE" name="cve"/><br><br>
                <input type="text" placeholder="PRODUCT" name="product"/><br><br>
                <input type="text" placeholder="VERSION" name="version"/><br><br>
                <input type="number" placeholder="PORT" name="port"/><br><br>
                <input type="text" placeholder="AUTHOR" name="author"/><br><br>
                <input type="text" placeholder="TYPE" name="type"/><br><br>
                <input type="date" placeholder="DATE" name="date"/><br><br>
                <textarea rows=10 cols=70 placeholder="DESCRIPTION" name="desc"></textarea><br><br>
            </form>
        END_OF_TEXT;
    }
    echo <<< END_OF_TEXT
                <input type="submit" value="INSERT"  name="insert" form="db">
                <input type="submit" value="UPDATE"  name="update" form="db">
                <input type="submit" value="DELETE"  name="delete" form="db">
                <input type="submit" value="FIND"    name="find"   form="db">
                <input type="submit" value="FIRST"   name="first"  form="db">
                <input type="submit" value="LAST"    name="last"   form="db">
                <input type="submit" value="NEXT"    name="next"   form="db">
                <input type="submit" value="PREVIOUS"  name="prev"   form="db">
        </body>
        </center>
        END_OF_TEXT;
}
else{
    echo <<< END_OF_TEXT
    <body>
    <center>
        <form method="post" action="api/authenticate.php">
            USERNAME: <input type="text" name="username"/><br/><br/>
            PASSWORD: <input type="password" name="password"/><br/><br/>
            <input type="submit"  name="signin" value="SIGN IN"/>
            <input type="submit"  name="signup" value="SIGN UP"/><br/><br/>
        </form>
    </center>
    </body>
    END_OF_TEXT;

}
?>