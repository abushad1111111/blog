<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function jobList()
    {
        $jobs = Job::all();
        return view('backend.jobs.list', compact('jobs'));
    }

    public function createJob()
    {
        return view('backend.jobs.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|nullable|string',
            'requirements' => 'required|nullable|string',
            'responsibilities' => 'required|nullable|string',
            'company' => 'required|nullable|string|max:255',
            'location' => 'required|nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'employment_type' => 'required|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'nullable|in:entry-level,mid-level,senior-level,manager,executive',
            'education_level' => 'required|nullable|in:high school,associate,bachelor,master,doctorate',
            'industry_id' => 'nullable|string|max:255',
            'job_type' => 'nullable|string|max:255',
            'posted_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:posted_at',
            'application_deadline' => 'nullable|date|after_or_equal:posted_at',
        ]);

        Job::create($validated);
        return redirect()->route('job.list')->with('success', 'Job created successfully.');
    }

    public function editJob($id)
    {
        $jobEdit = Job::find($id);
        return view('job.edit', compact('jobEdit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'company' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|gte:salary_min',
            'employment_type' => 'required|in:full-time,part-time,contract,temporary,internship',
            'experience_level' => 'nullable|in:entry-level,mid-level,senior-level,manager,executive',
            'education_level' => 'nullable|in:high school,associate,bachelor,master,doctorate',
            'industry_id' => 'nullable|string|max:255',
            'job_type' => 'nullable|string|max:255',
            'posted_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:posted_at',
            'application_deadline' => 'nullable|date|after_or_equal:posted_at',
        ]);

        $job = Job::find($id);
        $job->update($validated);
        return redirect()->route('job.list')->with('success', 'Job updated successfully.');
    }

    public function destroyJob($id)
    {
        $job = Job::find($id);
        $job->delete(); 
        return redirect()->route('job.list')->with('success', 'Job deleted successfully.');
    }

}
