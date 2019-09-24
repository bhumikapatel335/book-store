<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Repostiories\UserRepository;
use App\SendNotification\MailNotification;
use Doctrine\ORM\EntityManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    protected $em;
    protected $userRepository;

    public function __construct(EntityManager $em, UserRepository $userRepository)
    {
        $this->em = $em;
        $this->userRepository = $userRepository;
    }


    public function create(Request $request)
    {
        $user = new User();

        $user = $this->userRepository->save( $user , $request);

        $this->em->persist($user);

        $this->em->flush();


        return response()->json('saved new user with user id: '.$user->getId(), 201);
    }

    public function show($id)
    {
        $user = $this->userRepository->getUser($id);

        return response()->json($user->getEmail(), 200);
    }

    public function update(Request $request, $id)
    {
        $user = $this->em->find('App\Entities\User',$id);

        $user = $this->userRepository->save( $user , $request);

        $this->em->persist($user);

        $this->em->flush();

        return response()->json('updated user with user id: '.$user->getId(), 200);

    }

    public function delete($id)
    {
        $user = $this->em->find('App\Entities\User',$id);

        if($user)
        {
            $this->em->remove($user);

            $this->em->flush();

            return response()->json('user deleted successfully', 200);
        }
        else
        {
            throw  new Exception('User not found');
        }

    }

    public function sendNotification($name)
    {
        $users = $this->userRepository->getUserByName($name);

        $email = null;
        $password = null;

        foreach ($users as $user) {
            $email = $user->getEmail();
        }
        $mailNotification = new MailNotification();

        $mailNotification->send($email,$users);





    }






}
