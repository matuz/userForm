<?php

namespace Matuz\UserBundle\Form\Handler;


use Matuz\UserBundle\Entity\User;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class UserHandler
{
    /**
     * @var string
     */
    private $uploadRootDir;

    /**
     * @var FormInterface
     */
    private $form;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param FormInterface $form
     * @param Request $request
     */
    public function __construct(FormInterface $form, Request $request, $uploadRootDir)
    {
        $this->form = $form;
        $this->request = $request;
        $this->uploadRootDir = $uploadRootDir;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function process(User $user)
    {
        $this->form->setData($user);


        if ($this->request->getMethod() === 'POST') {
            $this->form->submit($this->request);

            if ($this->form->isValid()) {

                $this->handleUploadedFile($user);
                $this->performSave($user);

                return true;
            }

        }

        return false;

    }

    private function handleUploadedFile(User $user)
    {
        $picture = $user->getPicture();

        if ($picture instanceof UploadedFile) {
            $fileName = $this->generateSafeName($picture);
            $picture->move($this->uploadRootDir, $fileName);
        }

    }

    private function generateSafeName()
    {
        $dateTime = new \DateTime();                              // TODO: Date should be injected
        return 'user_picture_' . $dateTime->format('U') . '.jpg'; // Validation allows only jpg files.
    }

    private function performSave(User $user)
    {
        // TODO: add manager to the handler and perform persist and flush on the object.
    }

} 