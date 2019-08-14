<?php

// src/Controller/AdminController.php

namespace App\Controller;

use AlterPHP\EasyAdminExtensionBundle\Controller\EasyAdminController as BaseAdminController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends BaseAdminController
{
    public function createNewRepresenEntity()
    {
        return $this->get('fos_user.user_manager')->createUser();
    }

    public function persistRepresenEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::persistEntity($user);
    }
    public function updateRepresenEntity($user)
    {
        $this->get('fos_user.user_manager')->updateUser($user, false);
        parent::updateEntity($user);
    }
}
