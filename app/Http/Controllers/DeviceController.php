<?php

namespace App\Http\Controllers;

use App\Repositories\DeviceRepository;
use App\Repositories\LocationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    protected $deviceRepository;
    protected $locationRepository;

    public function __construct(DeviceRepository $deviceRepository, LocationRepository $locationRepository)
    {
        $this->deviceRepository = $deviceRepository;
        $this->locationRepository = $locationRepository;
    }

    public function index($locationId)
    {
        $location = $this->locationRepository->find($locationId);
        $devices = $location->devices;
        return view('devices.index', compact('location', 'devices'));
    }

    public function create($locationId)
    {
        $location = $this->locationRepository->find($locationId);
        return view('devices.create', compact('location'));
    }

    public function store(Request $request, $locationId)
    {
        $location = $this->locationRepository->find($locationId);

        if ($location->devices()->count() >= 10) {
            return redirect()->back()->withErrors(['error' => 'Cannot have more than 10 devices per location'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'number' => 'required|integer|unique:devices,number',
            'type' => 'required|in:pos,kiosk,digital-signage',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $path = $request->file('image')->store('public/images');
        $this->deviceRepository->create($request->only(['number', 'type', 'status']) + ['image' => $path, 'location_id' => $locationId]);
        return redirect()->route('locations.devices.index', $locationId);
    }


    public function edit($locationId, $deviceId)
    {
        $location = $this->locationRepository->find($locationId);
        $device = $this->deviceRepository->find($deviceId);
        return view('devices.edit', compact('location', 'device'));
    }

    public function update(Request $request, $locationId, $deviceId)
    {
        $device = $this->deviceRepository->find($deviceId);

        $validator = Validator::make($request->all(), [
            'number' => 'required|integer|unique:devices,number,' . $deviceId,
            'type' => 'required|in:pos,kiosk,digital signage',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');

            $imagePath = $path;
        } else {
            $imagePath = $device->image;
        }
        $this->deviceRepository->update($device, [
            'number' => $request->input('number'),
            'type' => $request->input('type'),
            'image' => $imagePath,
            'status' => $request->input('status'),
        ]);
        return redirect()->route('locations.devices.index', $locationId);
    }

    public function destroy($locationId, $deviceId)
    {
        $device = $this->deviceRepository->find($deviceId);
        $this->deviceRepository->delete($device);
        return redirect()->back();
    }
}
