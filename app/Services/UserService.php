<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class UserService
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllUsers()
    {
        $type =  request()->input('type','active-members');
        if($type == 'admins'){
            return $this->userRepo->getAdmins();
        }elseif($type == 'pending-members'){
            return $this->userRepo->getPendingMembers();
        }else{
            return $this->userRepo->getActiveMembers();
        }
        // return $this->userRepo->getAll($type);
    }

    public function getUserByUuid(string $uuid)
    {
        return $this->userRepo->findByUuid($uuid);
    }

    public function createUser(array $data)
    {
        // Store image if uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            $data['image'] = $data['image']->store('users/images', 'public');
        }

        return $this->userRepo->create($data);
    }

    public function updateUser(User $user, array $data)
    {
        // Replace image if new one uploaded
        if (isset($data['image']) && $data['image']->isValid()) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $data['image'] = $data['image']->store('users/images', 'public');
        }
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        return $this->userRepo->update($user, $data);
    }

    public function deleteUser(User $user)
    {
        return $this->userRepo->delete($user);
    }
}
