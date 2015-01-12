<?php

class UsersController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $users = Users::find();
        $currentPage = $this->request->getQuery('page', 'int', 1);
        $paginator = new \Phalcon\Paginator\Adapter\Model(
            array(
                'data'  => $users,
                'limit' => 5,
                'page'  => $currentPage
            )
        );
        $this->view->users = $paginator->getPaginate();
    }

    public function addAction()
    {

    }

    public function editAction($id)
    {
        if (!$this->request->getPost()) {
            $user = Users::findFirst(array(
                'id=:id:',
                'bind' => array('id' => $id)
            ));
            $this->tag->setDefault('id', $user->id);
            $this->tag->setDefault('username', $user->username);
            $this->tag->setDefault('password', $user->password);
        }
    }

    public function saveAction()
    {
        $request = $this->request->getPost();
        if (!empty($request)) {
            $users = new Users();
            if (isset($request['id']) && !empty($request['id'])) {
                $users->id       = $request['id'];
                $users->username = $request['username'];
                $users->password = $request['password'];
                $result = $users->save();
            } else {
                $result = $users->save($request, array('username', 'password'));
            }
            if ($result) {
                isset($request['id']) && !empty($request['id']) ? $this->flash->success('User was edit success.') : $this->flash->success('Create new user success.');
            } else {
                foreach ($users->getMessages() as $key => $value) {
                    $this->flash->error($value);
                }
                return (isset($users->id) && !empty($users->id)) ?
                    $this->dispatcher->forward(array(
                        "controller" => "users",
                        "action" => 'edit',
                        "params" => array($users->id)
                    )) :
                    $this->dispatcher->forward(array(
                        "controller" => "users",
                        "action" => 'add',
                    ));
            }
        }
        return $this->dispatcher->forward(
            array(
                'controller' => 'users',
                'action'     => 'index'
            )
        );
    }

    public function deleteAction($id)
    {
        $user = Users::findFirstByid($id);
        if (!$user) {
            $this->flash->error('User was not found.');
        }
        if (!$user->delete()) {
            foreach ($user->getMessages() as $key => $value) {
                $this->flash->error($value);
            }
        } else {
            $this->flash->success('User was deleted success.');
        }
        return $this->dispatcher->forward(array(
            'controller' => 'users',
            'action'     => 'index'
        ));
    }
}

