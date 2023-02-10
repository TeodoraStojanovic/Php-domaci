    <?php
    
    class User{
        public $name;
        public $surname;
        public $username;
        public $password;

        public function __construct($name,$surname,$username,$password){
            $this->name = $name;
            $this->surname = $surname;
            $this->username = $username;
            $this->password = $password;
           
        }
        public static function logInUser($userL, $passL, mysqli $conn)
        {
            $query = "SELECT * FROM user WHERE username='$userL' and password='$passL'";
            return $conn->query($query);
        }
        public static function registerUser($nameR, $surnameR, $usernameR, $passwordR, mysqli $conn)
        {
            $query = "INSERT INTO user(`name`, `surname`, `username`, `password`) 
            VALUES('$nameR', '$surname', '$usernameR', '$password')";
            return $conn->query($query);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    