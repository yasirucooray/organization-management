<?php
namespace App\Repositories;

use App\Models\Device;

class DeviceRepository
{
    public function all()
    {
        return Device::all();
    }

    public function create(array $data)
    {
        return Device::create($data);
    }

    public function update(Device $device, array $data)
    {
        return $device->update($data);
    }

    public function delete(Device $device)
    {
        return $device->delete();
    }

    public function find($id)
    {
        return Device::find($id);
    }
}
