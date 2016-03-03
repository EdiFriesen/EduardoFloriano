<?php
namespace Fbreuer\MetinCms\Controller;

use Fbreuer\MetinCms\User;

class StandardController extends AbstractController
{
    public function indexAction()
    {
        $this->render('Index');
    }

    public function switchPageAction()
    {
        switch ($_GET['id']) {
            case 0:
                $this->render('Index');
                break;
            case 1:
                $this->view->assign('view', $this->getView());
                $this->render('Charts');
                break;
            case 2:
                $this->render('Tables');
                break;
            case 3:
                $this->render('Forms');
                break;
            case 4:
                $this->render('Bootstrap-elements');
                break;
            case 5:
                $this->render('Bootstrap-grid');
                break;
            case 6:
                $this->render('Blank-page');
                break;
            default:
                $this->render('Index');
        }
    }

    public function wrongControllerAction ()
    {
        $this->render('Index');
        echo '<div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Die Ausgewählte Action wurde nicht gefunden!</strong>
                </div>';
    }

    public function userLoginAction()
    {
        if (isset($_POST['username']) and isset($_POST['password']) ) {
            if(User::userLogin($_POST['username'], $_POST['password'])){
                $this->view->assign('username', $_POST['username']);
                $this->view->assign('password', $_POST['password']);
                $this->render('Home');
            }else{
                $this->render('Index');
                $this->render('Error');
            }
        }elseif(isset($_SESSION['UserID'])){
            $User = User::getUserData($_SESSION['UserID']);
            $this->view->assign('username', $User->username);
            $this->render('Home');
        }else{
            $this->render('Index');
        }
    }


    public function getView(){
        return $this->view;
    }

    public function userRegistrationAction()
    {
        if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email'])) {

        }else{
            $this->render('RegistrationFrom');
        }
    }
}