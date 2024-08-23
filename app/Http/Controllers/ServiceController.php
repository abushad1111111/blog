<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function serviceList()
    {
        $services = Service::all();
        return view('backend.services.list', compact('services'));
    }

    public function createServiceForm()
    {
        return view('backend.services.create');
    }

    // Store a new service in the database
    public function createService(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Service::create($validatedData);
        return redirect()->route('services.list')->with('success', 'Service created successfully.');
    }

    public function editService($id)
    {
        $service = Service::find($id);
        return view('services.edit', compact('service'));
    }

    public function updateService(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $service->update($validatedData);
        return redirect()->route('services.list')->with('success', 'Service updated successfully.');
    }

    public function destroyService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->route('services.list')->with('success', 'Service deleted successfully.');
    }
}
