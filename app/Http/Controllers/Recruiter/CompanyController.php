<?php

namespace App\Http\Controllers\Recruiter;

use Illuminate\Routing\Controller;
use App\Models\Company;
use App\Models\CompanyLocation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyUpdateRequest;
use Illuminate\Http\Request;

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
                    if ($location) {
                        $location->update($locationData);
                    }
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
        // Lấy danh sách các ngành (industry) duy nhất
        $industries = Company::distinct()
            ->whereNotNull('industry')
            ->pluck('industry');

        // Lấy danh sách tất cả các công ty (mặc định hiển thị tất cả)
        $companies = Company::paginate(12);

        return view('job-seeker.list-company', compact('industries', 'companies'));
    }

    public function fetchCompanies(Request $request)
    {
        $industry = $request->input('industry');

        $query = Company::query();

        if ($industry === 'featured') {
            $query->where('is_featured', 1);
        } elseif ($industry && $industry !== 'all') {
            $query->where('industry', $industry);
        }

        $companies = $query->paginate(12);

        // Render HTML của danh sách công ty
        $html = view('job-seeker.companies.company', compact('companies'))->render();

        // Render HTML của phân trang sử dụng template tùy chỉnh
        $pagination = view('job-seeker.pagination', compact('companies'))->render();

        return response()->json([
            'html' => $html,
            'pagination' => $pagination
        ]);
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
