<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class RegisterRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function get(Request $request)
    {
        $query = user::with('user');

        return $query;
    }



    public function create(array $input)
    {
        return $this->model->create($input);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, array $input)
    {
        $user = $this->find($id);
        if ($user) {
            $user->update($input);
        }
        return $user;
    }

    public function delete($id)
    {
        $user = $this->find($id);
        if ($user) {
            $user->delete();
        }
    }
}
