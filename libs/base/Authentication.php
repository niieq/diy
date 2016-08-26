<?php

class Authentication{
    public function __construct(){}

    public static function login($username, $password){
        $user = UserQuery::create()->findOneByUserName($username);

        if(empty($user)) return false;

        if(password_verify($password, $user->getPassword())){
            if(password_needs_rehash($user->getPassword(), PASSWORD_BCRYPT, ["cost" => DUtil::hash_cost()])){
                $password = password_hash($password, PASSWORD_BCRYPT, array("cost" => DUtil::hash_cost()));
                $user->setPassword($password);
            }

            return $user;
        } else{
            return false;
        }
    }

    public static function create_superuser($username, $email, $password){
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array("cost" => DUtil::hash_cost()));

        $user = new User;
        $user->setUserName($username);
        $user->setEmail($email);
        $user->setPassword($hashed_password);
        $user->setIsSuperuser(true);
        $user->setIsStaff(true);
        if (!$user->validate()) {
            foreach ($user->getValidationFailures() as $failure) {
                echo "Property ".$failure->getPropertyPath().": ".$failure->getMessage()."\n";
            }
        } else {
            $user->save();
            echo "User successfully created!!!\n";
        }
    }

    public static function create_user($data){
        if(isset($data["confirm_password"])){
            if($data["password"] === $data["confirm_password"]){
                $passwd = password_hash($data["password"], PASSWORD_BCRYPT, array("cost" => DUtil::hash_cost()));
                $data["password"] = $passwd;
                unset($data["confirm_password"]);
            } else{
                return "Passwords do not match";
            }
        } else{
            $passwd = password_hash($data["password"], PASSWORD_BCRYPT, $this->_cost());
            $data["password"] = $passwd;
        }

        $data["is_superuser"] = false;
        $data["is_staff"] = true;
        $data["create_at"] = date("Y-m-d H:i:s");
        $data["modified_at"] = date("Y-m-d H:i:s");

        $user = new User();
        $user->fromArray($data, TableMap::TYPE_FIELDNAME);
        $user->save();

        return $user;
    }

    public static function change_password(){}

    public static function logout(){
        Session::destroy();
    }
}