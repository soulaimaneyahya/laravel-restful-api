<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Support\Collection;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    use ApiResponser;

    public function __construct
    (
        private UserRepository $userRepository,
    )
    {
    }
    
    public function all(Collection $collection)
    {
        return $this->userRepository->all($collection);
    }

    public function find(Model $model)
    {
        return $this->userRepository->find($model);
    }

    public function store(array $data)
    {
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationToken();
        $data['password'] = bcrypt($data['password']);
        $data['admin'] = User::REGULAR_USER;

        $user = User::create($data);
        return $this->userRepository->find($user);
    }

    public function update(User $user, array $data)
    {
        if (isset($data['name'])) {
            $user->name = $data['name'];
        }

        if (isset($data['email']) && $user->email != $data['email']) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationToken();
            $user->email = $data['email'];
        }

        if (isset($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        if (isset($data['admin'])) {
            if (!$user->isVerified()) {
                return $this->infoResponse('Only verified users can change admin field', 422);
            }
            $user->admin = $data['admin'];
        }

        if (!$user->isDirty()) {
            return $this->infoResponse('You need to specify diff value to change', 422);
        }

        $user->save();
        return $this->userRepository->find($user);
    }

    public function delete(User $user)
    {
        $user->delete();
        return $this->infoResponse('user deleted !', 204);
    }
}
