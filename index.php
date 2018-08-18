<?php

class User {
    protected $id;
    protected $username;
    protected $password;
    protected $setting;

    public function __construct($id, $username, $password, Setting $setting)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->setting = $setting;
    }

    public function __call($method, $parametrs)
    {
        if (method_exists($this->setting, $method)) {
            return call_user_func_array(array($this->setting, $method), $parametrs);
        }
    }
}

class Setting {
    protected $name;
    protected $age;
    protected $email;

    public function __construct($name, $age, $email)
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    public function getSetting() {
        return [
            'name' => $this->name,
            'age' => $this->age,
            'email' => $this->email
        ];
    }
}

$setting = new Setting('dog', 18, 'doggo@mail.com');
$user = new User(1, 'doggo1', '123456', $setting);

var_dump($user->getSetting());
?>