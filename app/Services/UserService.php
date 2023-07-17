<?php

namespace App\Services;

use App\Models\User;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserService
{
    public function __construct(private User $model)
    {
        $this->model = new User();
    }

    public function list(array $filters = null, $id = null): array
    {
        $users = $this->model->list(...$filters);
        if (!is_null($id)) {
            return $users->first();
        }

        return $users;
    }

    public function create(array $data): array
    {
        $id = $this->model->insertGetId($data);
        return $this->list(null, $id);
    }

    public function update(array $data, int $id): array
    {
        $id = $this->model->where('id', $id)->update($data);
        return $this->list(null, $id);
    }

    public function destroy(int $id): bool
    {
        return $this->model->where('id', $id)->delete();
    }
}
