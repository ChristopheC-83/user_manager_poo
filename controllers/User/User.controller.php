<?php






class UserController extends VisitorController
{
    private $userManager;
    public function __construct()
    {
        $this->userManager = new UserManager();
    }
    public function validation_login($login, $password)
    {
        echo ($login);
    }
}
