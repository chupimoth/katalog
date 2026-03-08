<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
    protected function startup(): void
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn()) {
            if ($this->getName() !== 'Sign') {
                $this->flashMessage('Pro přístup musíte být přihlášen.', 'warning');
                $this->redirect('Sign:in');
            }
        }
        $this->template->theme = $_COOKIE['theme'] ?? 'theme-blue';
    }
}