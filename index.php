<?php
/*1) Создать класс User у которого вы будете вызывать метод getSettings и класс Setting которому вы делегируете реалазацию этого метода.*/

class User {
    protected $id;
    protected $username;
    protected $password;

    public function __construct($id, $username, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;

    }

    public function __get($id)
    {
        if (isset($id)) {
            return $this->id;
        }
    }

    public function getSetting() {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}

class Setting {
    protected $name;
    protected $age;
    protected $email;
    protected $user;

    public function __construct($name, $age, $email, User $user)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->user = $user;
    }

    public function __call($method, $parameters)
    {
        if (method_exists($this->user, $method)) {
            return call_user_func_array(array($this->user, $method), $parameters);
        }
    }
}

$user = new User(1, 'doggo92', '123456');
$getSetting = new Setting('dog', 18, 'doggo@mail.com', $user);

var_dump($getSetting->getSetting());
?>