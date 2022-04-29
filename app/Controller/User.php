<?php
namespace App\Controller;

use Src\AbstractController;
use \App\Model\User as UserModel;

class User extends AbstractController
{
    public function loginAction()
    {
        $twig =  $this->view->getTwig();
        $email = trim($_POST['email']);
        if(isset($_POST['email']))
        {
            if($email)
            {
                $password = $_POST['password'];
                $user = UserModel::getByEmail($email);
                if (!$user)
                {
                    $this->view->assign('error','Пользователь на найден');
                }
                if($user)
                {
                    if ($user->getPassword() != UserModel::getPasswordHash($password))
                    {
                        $this->view->assign('error','пароль не подошел!');
                    }
                    else
                    {
                        $_SESSION['id'] = $user->getId();
                        $this->redirect('/blog/index');
                    }
                }
            }
        }

        if (TWIG_VIEW == 1)
        {
            echo $twig->render('login.twig', ['user'=>UserModel::getById((int) $_GET['id'])]);
        }
        else{
            return $this->view->render('User/register.phtml', ['user'=>UserModel::getById((int) $_GET['id'])]);
        }
        return '';
    }

    public function registerAction()
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];
        $success = true;
        $twig =  $this->view->getTwig();
        if(isset($_POST['email']))
        {
            if (!$name)
            {
                $this->view->assign('error','Поля не могут быть пустыми!');
                $success = false;
            }

            if (strlen($password) < 4)
            {
                $this->view->assign('error','Пароль слишком короткий ');
                $success = false;
            }

            if ($password != $passwordRepeat)
            {
                $this->view->assign('error','Пароли не совпадают');
                $success = false;
            }

            $user = UserModel::getByEmail($email);
            if ($user)
            {
                $this->view->assign('error','Такой email уже зарегистрирован!');
                $success = false;
            }
            if($success)
            {
                $user = new UserModel();
                $user->setName($name);
                $user->setEmail($email);
                $user->setPassword($password);

                $userId = $user->save();
                $_SESSION['id'] = $user->getId();
                $this->setUser($user);
                $this->redirect('/blog/index');
            }
        }
        if (TWIG_VIEW == 1)
        {
            echo $twig->render('login.twig', ['user'=>UserModel::getById((int) $_GET['id'])]);
        }
        else{
            return $this->view->render('User/register.phtml', ['user'=>UserModel::getById((int) $_GET['id'])]);
        }
        return '';
    }

    public function profileAction()
    {
        $id = (int)$_GET['id'];
        $user = UserModel::getById($id);
        var_dump($user);
        return $this->view->render('User/profile.phtml', ['user'=>$user]);
    }

    public function logoutAction()
    {
        session_destroy();
        $this->redirect('/user/login');

    }
}