<?php
    class User
    {
    public $name;
    public $age;
    public $email;
    public $phoneNumber;

   public function __construct($name,$age,$email="",$phoneNumber="")
    {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    }
    $user1 = new User("Join",19,"join@gmail.com");
    $user2 = new User("Bob",20);

    print_r($user1);
    print_r($user2);

    /* PHP inherited */
    class Employee extends User
    {
        // public $title;
        public function __construct($name,$age,$email="",$phoneNumber="",
                                    $title // only Employee
                                    )
        {
            parent::__construct($name,$age,$email,$phoneNumber);
            $this->title = $title;
        }

        public function get_title(){
         return  $this->title;
        }
    }

    $employee1 = new Employee("wich",25,"wich#gmail.com","080234888","PMO");

    print_r($employee1->get_title());
