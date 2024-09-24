<?php
class UserController extends BaseController
{
  private $__userModel;
  public function __construct($conn)
  {
    $this->__userModel = $this->load_model("UserModel", $conn);
  }

  public function login()
  {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $data['page'] = 'layouts/login';
      $data['page_title'] = 'Log In';
      $this->view("layouts/client/client", $data);
    } else {
      $username = trim($_REQUEST["username"]);
      $password = trim($_REQUEST["password"]);
      $user = $this->__userModel->getUserByUsernameANDPassword($username, $password);
      if (isset($user) && $user) {
        $role = $user->role;

        // save user to session
        $_SESSION["user"] = $user;
        if ($role == "admin") {
          header("Location: http://localhost/shop/admin/index");
        } else {
          // role = client
          header("Location: http://localhost/shop/home/index");
        }
      } else {
        // not logged in yet -> redirect user to login page
        header("Location: http://localhost/shop/user/login?error=true");
      }
    }
  }

  public function logout()
  {
    // if logged in -> delete user info from SESSION
    if (isset($_SESSION["user"])) {
      $role = $_SESSION["user"]->role;
      // delete user info from $_SESSION
      $_SESSION["user"] = null;
      if ($role == "admin") {
        // if role = admin -> redirect to login
        header("Location: http://localhost/shop/user/login");
      } else {
        // if role = client -> redirect to home page
        header("Location: http://localhost/shop/home/index");
      }
    } else {
      // not logged in -> redirect user to home page
      header("Location: http://localhost/shop/home/index");
    }
  }

  public function register()
  {
    $data['page'] = 'layouts/register';
    $data['page_title'] = 'Register New Account';

    // handle GET request
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $this->view("layouts/client/client", $data);
    } else { // handle POST requet
      $name = trim($_REQUEST["name"]);
      $username = trim($_REQUEST["username"]);
      $password = trim($_REQUEST["password"]);
      $password2 = trim($_REQUEST["password2"]);
      // check if username already exits in db
      $user = $this->__userModel->getUserByUsername($username);
      // user is set -> output error (username taken)
      if (isset($user) && $user) {
        $data['error'] = 'Username was taken. Please try a another one.';
        $this->view("layouts/client/client", $data);
      } else {
        // check if passwords match
        if ($password != $password2) {
          // output error: 'Passwords must match'
          $data['error'] = 'Passwords must match';
          $this->view("layouts/client/client", $data);
        } else {
          // save new user to db
          $this->__userModel->registerNewUser($name, $username, $password);
          header("Location: http://localhost/shop/user/login");
        }
      }
    }
  }
}
