<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Contracts\RoleInterface;
use Illuminate\Support\Carbon;
use App\Documents\RoleDocument;

class RoleService implements RoleInterface {

    public const DOCUMENT = "roles";
    protected $firestore;
    protected PermissionService $permissionService;

    public function __construct(){
        $this->firestore = app('firebase.firestore')
        ->database()
        ->collection(static::DOCUMENT);

        // PermissionService
        $this->permissionService = new PermissionService();
    }

    public function index(): mixed
    {
        $query = $this->firestore->documents();
        $roles = [];
        $rows = collect($query->rows());

        foreach ($rows as $row) {
            $item = new RoleDocument($row);
            $item->permissions = $this->permissionService->getByArrayString($item->permissions);
            array_push($roles, $item);
        }

        return $roles;
    }

    public function getById(string $id): mixed
    {
        $query = $this->firestore->document($id);
        $row = $query->snapshot();
        $role = new RoleDocument($row);

        return $role;
    }

    public function store($data)
    {
        $data['created_at'] = Carbon::now()->toTimeString();
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->newDocument()->set($data);   
    }

    public function update(string $id, $data)
    {
        $data['updated_at'] = Carbon::now()->toTimeString();
        $query = $this->firestore->document($id)->set($data);
    }

    public function delete(string $id)
    {
        $query = $this->firestore->document($id)->delete();
    }
}