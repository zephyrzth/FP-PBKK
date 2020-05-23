<?php
declare(strict_types=1);

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();

        $this->tag->setTitle('Sign Up/Sign In');
    }

    public function indexAction(): void
    {

    }

    /**
     * This action authenticate and logs an user into the application
     */
    public function startAction(): void
    {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            /** @var Users $user */
            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND password = :password: AND active = 1",
                'bind' => [
                    'email'    => $email,
                    'password' => sha1($password),
                ],
            ]);

            if ($user) {
                $this->registerSession($user);
                $this->flash->success('Selamat datang ' . $user->name);

                $this->dispatcher->forward([
                    'controller' => 'donasi',
                    'action'     => 'index',
                ]);

                return;
            }

            $this->flash->error('Wrong email/password');
        }

        $this->dispatcher->forward([
            'controller' => 'session',
            'action'     => 'index',
        ]);
    }

    /**
     * Finishes the active session redirecting to the index
     */
    public function endAction(): void
    {
        $this->session->remove('auth');
        $this->flash->success('Sampai jumpa!');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index',
        ]);
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function registerSession(Users $user): void
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name,
        ]);
    }
}
