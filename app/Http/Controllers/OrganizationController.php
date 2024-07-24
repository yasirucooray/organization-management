<?php
namespace App\Http\Controllers;

use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    protected $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function index()
    {
        $organizations = $this->organizationRepository->all();
        return view('organizations.index', compact('organizations'));
    }

    public function create()
    {
        return view('organizations.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:organizations,code',
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->organizationRepository->create($request->only(['code', 'name']));
        return redirect()->route('organizations.index');
    }

    public function edit($id)
    {
        $organization = $this->organizationRepository->find($id);
        return view('organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:organizations,code,' . $id,
            'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $organization = $this->organizationRepository->find($id);
        $this->organizationRepository->update($organization, $request->only(['code', 'name']));
        return redirect()->route('organizations.index');
    }

    public function destroy($id)
    {
        $organization = $this->organizationRepository->find($id);
        $this->organizationRepository->delete($organization);
        return redirect()->route('organizations.index');
    }
}
