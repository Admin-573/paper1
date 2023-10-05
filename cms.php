<html>
    <head>
        <title>CMS</title>
    </head>
    <body>
        <center>
            <form action="" method="POST">
            <table>
            <h1>Student Registration</h1>
                <tr>
                    <td>
                        ID
                    </td>
                    <td>
                        <input type="text" id="sid" name="sid" required/>
                    </td>
                </tr>

                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        <input type="text" id="sname" name="sname" required/>
                    </td>
                </tr>

                <tr>
                    <td>
                        Email
                    </td>
                    <td>
                        <input type="email" id="semail" name="semail" required/>
                    </td>  
                </tr>

                <tr>
                    <td>
                        Phone
                    </td>
                    <td>
                        <input type="text" id="sphone" name="sphone" required/>
                    </td>  
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        <input type="submit" id="btn_add" name="btn_add" value="ADD"/>
                    </td>
                </tr>
            </table>
            
            </form>

            <table>
                <form action="" method="POST">
                    <tr>
                        <td>Search Data</td>
                        <td><input type="text" id="search" name="search" required/></td>
                        <td><input type="submit" id="btn_search" name="btn_search" value="SEARCH"/></td>
                    </tr>
                </form>
            </table>
        </center>

    </body>
</html>

<?php
error_reporting(0);
include "cms_init.php";
if(isset($_POST['btn_search'])){

    $STUD_NAME=$_POST[$sname];
    $STUD_EMAIL=$_POST[$semail];
    $STUD_PHONE=$_POST[$sphone];
    $STUD_SEARCH = $_POST[$search];

    $sql = "select * from $tblcms where $sname LIKE '$STUD_SEARCH' OR $semail LIKE '$STUD_SEARCH' OR $sphone LIKE '$STUD_SEARCH'";
    $query = mysqli_query($con,$sql);
    $data = mysqli_num_rows($query);

    if($data)
    {
        while($row = mysqli_fetch_array($query)){
            ?>
                <center>
                    <table border=2px>
                        <tr>
                            <td>SID</td>
                            <td>NAME</td>
                            <td>EMAIL</td>
                            <td>PHONE</td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                    echo $row[$sid];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row[$sname];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row[$semail];
                                ?>
                            </td>
                            <td>
                                <?php
                                    echo $row[$sphone];
                                ?>
                            </td>
                        </tr>
                    </table>
                </center>
            <?php
        }
    } else {
       ?>
        <script>
            alert("Not Found !");
        </script>
       <?php
    }

} else{

    $createQuery = "CREATE TABLE IF NOT EXISTS $tblcms($sid integer primary key,$sname text,$semail text,$sphone text);";
    $query = mysqli_query($con,$createQuery);


    if(isset($_POST['btn_add'])){
        
        $STUD_ID=$_POST[$sid];
        $STUD_NAME=$_POST[$sname];
        $STUD_EMAIL=$_POST[$semail];
        $STUD_PHONE=$_POST[$sphone];

        $sql = "SELECT * FROM $tblcms WHERE $STUD_ID=$sid";
        $queryExe = mysqli_query($con,$sql);
        $data = mysqli_num_rows($queryExe);

        if($data){
            ?>
                <script>
                    alert("Student Exists !")
                </script>
            <?php
        } else {
            $insertQuery = "INSERT INTO $tblcms VALUES($STUD_ID,'$STUD_NAME','$STUD_EMAIL','$STUD_PHONE');";
            $queryExe = mysqli_query($con,$insertQuery);
            if($queryExe){
                ?>
                <script>
                    alert("Student Added !")
                    window.open("http://localhost/paper1/cms.php","_slef");
                </script>
            <?php
            }
        }
    }
    ?>
        <center>
            <table border="2px">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <th>Student Phone</th>
                </tr>

                <tr>
                    <?php
                        include "cms_init.php";
                        $sql = "select * from $tblcms";
                        $queryExe = mysqli_query($con,$sql);
                        $data = mysqli_num_rows($queryExe);
                        if($data){
                            while($row = mysqli_fetch_array($queryExe)){
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo $row[$sid];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $row[$sname];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $row[$semail];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $row[$sphone];
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                            }
                        } else {
                            echo "Table Empty";
                        }    
                    ?>
                </tr>
            </table>
        </center>
    <?php
}
?>