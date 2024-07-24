<?php
namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function all()
    {
        return Location::all();
    }

    public function create(array $data)
    {
        return Location::create($data);
    }

    public function update(Location $location, array $data)
    {
        return $location->update($data);
    }

    public function delete(Location $location)
    {
        return $location->delete();
    }

    public function find($id)
    {
        return Location::find($id);
    }

    public function findByOrganization($organizationId)
    {
        return Location::where('organization_id', $organizationId)->get();
    }
}
