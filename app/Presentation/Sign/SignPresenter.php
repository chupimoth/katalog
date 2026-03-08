<?php
declare(strict_types=1);

namespace App\Presentation\Sign;

use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;

final class SignPresenter extends \App\Core\BasePresenter
{
    protected function createComponentSignInForm(): Form
    {
        $form = new Form;
        $form->setHtmlAttribute('novalidate', 'novalidate');
        $form->addEmail('email', 'Email:')
            ->setRequired('Zadejte email');
        $form->addPassword('password', 'Heslo:')
            ->setRequired('Zadejte heslo');
        $form->addSubmit('send', 'Přihlásit')->setHtmlAttribute("class","btn btn-secondary mt-2");

        $form->onSuccess[] = [$this, 'signInFormSucceeded'];
        return $form;
    }

    public function signInFormSucceeded(Form $form, \stdClass $values): void
    {
        $username = $values->email ?? '';
        $password = $values->password ?? '';
        $ip = $this->getHttpRequest()->getRemoteAddress();

        if ($username === 'user@example.com' && $password === 'heslo123') {
            $this->logAttempt($username, true, $ip);

            $this->getUser()->login(new \Nette\Security\Identity(1, ['admin'], ['email' => $username]));

            $this->flashMessage('Přihlášení úspěšné');
            $this->redirect('Ebooks:list');                
        } else {
            $this->logAttempt($username, false, $ip);
            $form->addError('Špatný email nebo heslo');
        }
    }

    private function logAttempt(string $username, bool $success, string $ip): void
    {
        $logLine = sprintf("[%s] %s | %s | IP: %s\n",
            date('Y-m-d H:i:s'),
            $success ? 'SUCCESS' : 'FAILURE',
            $username,
            $ip
        );

        file_put_contents(__DIR__ . '../../../../log/login.log', $logLine, FILE_APPEND);
    }

    public function actionIn(): void
    {
        if ($this->getUser()->isLoggedIn()) {
            $this->redirect('Ebooks:list');
        }
    }

    public function actionOut(): void
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl jsi odhlášen');
        $this->redirect('Sign:in');
    }
}