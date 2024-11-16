<?php

namespace App\Http\Controllers\Recruiter;

use Illuminate\Routing\Controller;
use App\Models\Company;
use App\Models\CompanyLocation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyUpdateRequest;

class CompanyController extends Controller
{
    public function edit()
    {
        $company = Auth::user()->recruiter->company;
        return view('recruiter.company.edit', compact('company'));
    }

    public function update(CompanyUpdateRequest $request)
    {
        $company = Auth::user()->recruiter->company;

        $data = $request->validated();

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::delete($company->logo);
            }
            $data['logo'] = $request->file('logo')->store('company-logos', 'public');
        }

        $company->update($data);

        // Handle locations
        if ($request->has('locations')) {
            foreach ($request->locations as $locationData) {
                if (isset($locationData['id'])) {
                    $location = CompanyLocation::find($locationData['id']);
                    $location->update($locationData);
                } else {
                    $company->locations()->create($locationData);
                }
            }
        }

        return redirect()->route('recruiter.company.edit')
            ->with('success', 'Company information updated successfully.');
    }
    public function index()
    {
        // Lấy danh sách công ty
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);

        return view('job-seeker.list-company', compact('companies'));
    }
    public function topCompanies()
    {
        // Lấy danh sách công ty hàng đầu dựa trên số lượng nhân viên, sắp xếp giảm dần
        $companies = Company::orderBy('employee_count', 'desc')
            ->take(10)
            ->get();

        return view('general.top-company', compact('companies'));
    }
}
