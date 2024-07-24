<?php

namespace App\Http\Controllers;

use App\Repositories\LocationRepository;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    protected $locationRepository;
    protected $organizationRepository;

    public function __construct(LocationRepository $locationRepository, OrganizationRepository $organizationRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->organizationRepository = $organizationRepository;
    }

    public function index($organizationId)
    {
        $organization = $this->organizationRepository->find($organizationId);
        $locations = $this->locationRepository->findByOrganization($organizationId);
        return view('locations.index', compact('organization', 'locations'));
    }

    public function create($organizationId)
    {
        $organization = $this->organizationRepository->find($organizationId);
        return view('locations.create', compact('organization'));
    }

    public function store(Request $request, $organizationId)
    {
        $organization = $this->organizationRepository->find($organizationId);

        if ($organization->locations()->count() >= 5) {
            return redirect()->back()->withErrors(['error' => 'Cannot have more than 5 locations per organization'])->withInput();
        }

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|string|unique:locations,serial_number',
            'name' => 'required|string',
            'ipv4_address' => 'required|ipv4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['serial_number', 'name', 'ipv4_address']);
        $data['organization_id'] = $organizationId;
        $this->locationRepository->create($data);

        return redirect()->route('organizations.locations.index', $organizationId);
    }

    public function show($organizationId, $locationId)
    {
        $organization = $this->organizationRepository->find($organizationId);
        $location = $this->locationRepository->find($locationId);
        return view('devices.index', compact('organization', 'location'));
    }

    public function edit($organizationId, $locationId)
    {
        $organization = $this->organizationRepository->find($organizationId);
        $location = $this->locationRepository->find($locationId);
        return view('locations.edit', compact('organization', 'location'));
    }

    public function update(Request $request, $organizationId, $locationId)
    {
        $location = $this->locationRepository->find($locationId);

        $validator = Validator::make($request->all(), [
            'serial_number' => 'required|string|unique:locations,serial_number,' . $locationId,
            'name' => 'required|string',
            'ipv4_address' => 'required|ipv4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['serial_number', 'name', 'ipv4_address']);
        $this->locationRepository->update($location, $data);
        return redirect()->route('organizations.locations.index', $organizationId);
    }

    public function destroy($organizationId, $locationId)
    {
        $location = $this->locationRepository->find($locationId);
        $this->locationRepository->delete($location);
        return redirect()->route('organizations.locations.index', $organizationId);
    }
}
