<?php
session_start();
$date=date("Y-m-d h:i:sa");

if(isset ($_SESSION['admin'])||isset($_SESSION['admin'])||$_SESSION ['adminid'])
        
                                {
                                        session_unset();
                                        session_destroy();
                                        header("location: ../index.php");
                                        
                                }
       /* if(isset ($_SESSION['admin'])||isset($_SESSION['admin'])||$_SESSION ['adminid']){
                $sql="UPDATE adminlog SET logout_time='".$date."' WHERE admin_admin_id='".$_SESSION ['adminid']."'";

                        $res=mysqli_query($conn,$sql);
                        if($res)
                                        {
                                                session_unset();
                                                session_destroy();
                                                header("location: ../index.php");
                                                
                                        }
                else{
                        header("location: ../index.php".mysqli_connect_error());
     
                }
        }*/

    ?>