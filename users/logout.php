<?php
session_start();
$date=date("Y-m-d h:i:sa");

if(isset ($_SESSION['users'])||isset($_SESSION['admin'])||isset($_SESSION ['tenantid'])){
        
                session_unset();
                session_destroy();
                header("location: ../index.php");
                   
}
       /* if(isset ($_SESSION['users'])||isset($_SESSION['admin'])||isset($_SESSION ['tenantid'])){
                $sql="UPDATE tenantslog SET logout_time='".$date."' WHERE tenants_tenant_id='".$_SESSION ['tenantid']."'";
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