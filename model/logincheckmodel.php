<?php
   include_once 'ExecQuery.php';
   include_once 'ConcreteImp.php';
   require_once '../validation.php';
   require_once '../model/type.php';
   require_once "../model/database.php";
    class ProxyDP implements ExecQuery
    {
        
        public $email;
        public $password;
        public $con;
        public $usertype;
        public $Object;
        function __construct($user)
        {
             $con = DatabaseConnection::getInstance();
            $email=$user->email;
             $password=$user->password;
                $stmt = DatabaseConnection::getInstance()->prepare(
               "SELECT * FROM user
               WHERE user.email=? AND user.Password=?"
               );
                
                 $stmt->bind_param('ss', $email, $password);
                $result = $stmt->execute();
                $result = $stmt->get_result();
                
                 $row=$result->fetch_assoc();
               // $AdminDataSet = $con->prepare($sql);
                //$AdminDataSet->bind_param('ss', $email, $password);
                //$AdminDataSet->execute();
              
                $num = mysqli_num_rows($result);
                if($num > 0)
                {
                    
                        $this->email = $row["email"];
                        $this->password = $row["password"];
                        $this->Object = $row["user_type_id"];
                          $stmt = DatabaseConnection::getInstance()->prepare(
                                  
                          "SELECT * FROM user_type WHERE id=?");
                             $stmt->bind_param('i', $this->Object);
                             $result = $stmt->execute();
                             $result = $stmt->get_result();
                             $row2=$result->fetch_assoc();
                           if ($row2["name"] == "User") {
                                 echo("user");
                              include("view/viewall.php");
                                 }
                           if ($row2["name"] == "DepartmentHead") {
                             include("view/viewall.php");
                          }
                       if ($row2["name"] == "Dispatcher") {
                          include("view/viewall.php");
                           }
                               
                               // $sql3 = "SELECT * FROM user_type_pages WHERE usertype_id = '$this->Object->name'";
                                //$result = mysqli_query($con,$sql3);
                                //$row2 = mysqli_fetch_array($result);
                                echo("usertype");
                              //  $user_pageObj = new user_type_pages($row2["id"]);
                              //  if ($user_pageObj->page_id != "")
                                //{
                                  //  echo "<br><a href=".$Object->page_id->HTML."></a>";
                                  
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
        public function executeQuery($Query) {
            
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


?>
