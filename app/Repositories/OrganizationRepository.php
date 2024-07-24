<?php
namespace App\Repositories;

use App\Models\Organization;

class OrganizationRepository
{
    public function all()
    {
        return Organization::all();
    }

    public function create(array $data)
    {
        return Organization::create($data);
    }

    public function update(Organization $organization, array $data)
    {
        return $organization->update($data);
    }

    public function delete(Organization $organization)
    {
        return $organization->delete();
    }

    public function find($id)
    {
        return Organization::find($id);
    }
}
