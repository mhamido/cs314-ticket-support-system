<?php
    include_once 'ExecQuery.php';
    include_once 'ConcreteImp.php';
  //  include_once 'usertype_pages.php';
  //  require_once '../errorPage.php';
    //include_once 'error_message_details.php';
  //  require_once '../validation.php';
  //  require_once 'type.php';
    class ProxyDP implements ExecQuery
    {
        public $username;
        public $password;
        public $userTypeObj;
        function __construct($username,$password,$type)
        {
            $con = mysqli_connect("localhost","root","","phase2");
           
            if(!$con)
            {
                die('Could not connect:' );
             
            }
            
            else
            {
                $sql="SELECT * FROM user WHERE email = '$username' AND password = '$password'";
                $AdminDataSet = mysqli_query($con,$sql);
                $num = mysqli_num_rows($AdminDataSet);
                if($num > 0)
                {
                        $row = mysqli_fetch_array($AdminDataSet);
                        $this->username = $row["email"];
                        $this->password = $row["password"];
                      //  $this->userTypeObj = new type($row["user_type_id"]);
                        $Temp = $this->userTypeObj->id;
                        $sql2 = "SELECT * FROM user_type";
                        $UserTypeDataSet = mysqli_query($con,$sql2);
                        while($row = mysqli_fetch_array($UserTypeDataSet))
                        {
                            if(  $this->username == $username && $this->password == $password)
                            {
                               // $sql3 = "SELECT * FROM user_type_pages WHERE usertype_id = '$Temp'";
                                //$result = mysqli_query($con,$sql3);
                                //$row2 = mysqli_fetch_array($result);
                                echo("gg");
                              //  $user_pageObj = new usertype_pages($row2["id"]);
                              //  if ($user_pageObj->page_id != "")
                                //{
                                  //  echo "<br><a href=".$user_pageObj->page_id->HTML."></a>";
                                    break;
                                //}
                               
                            }
        
                        }
                        /*if($ct10 == 0)
                        {
                            echo "Error type";
                        }*/
                }
                else
                {
                    $errs = new ErrorPage();
                    if (Validation::isNullOrEmpty($username) || !Validation::isValidEmail($username)) {
                        $errs->emit(ErrorMsg::INVALID_EMAIL);
                    }
                    
                    if (Validation::isNullOrEmpty($password)) {
                           // $errs->add("Invalid Password: '$password'");
                        $errs->emit(ErrorMsg::INVALID_PASSWORD);
                    }
                   
                }
                
           }
           
        }

        public function executeQuery($Query) {
            echo("gg");
            if($this->userTypeObj->name == "User")
            {
                $admin = new ConcreteImp();
                $admin->executeQuery($Query);
            }
            if($this->userTypeObj->name == "DepartmentHead")
            {
                $admin = new ConcreteImp();
                $admin->executeQuery($Query);
            }
            if($this->userTypeObj->name == "Dispatcher")
            {
                $admin = new ConcreteImp();
                $admin->executeQuery($Query);
            }
    }
}
//$x = new ProxyDP("Kiro2003", "7bdfae2a3b7932a1547c231485dbe0d2a1c226e3", "Head of Servants");
//echo $x->username . "<br>";
//echo $x->password . "<br>";
//echo $x->userTypeObj->name . "<br>";
//Working !!!
?>
