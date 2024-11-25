<?php

namespace Modules\Monitor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Monitor\Models\Monitor;
use App\Helpers\SendPulse;
use Modules\Settings\Models\Setting;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('monitor::monitors', [
            'monitors' => Monitor::with('pulses')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('monitor::monitor_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'monitor_type' => ['required', 'int'],
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'interval' => ['required', 'int'],
            'expected_status_code' => ['required', 'int'],
            'notification_type' => ['required', 'int'],
        ]);

        Monitor::create([
            'name' => $validated['name'],
            'type' => $validated['monitor_type'],
            'url' => $validated['url'],
            'interval' => $validated['interval'],
            'expected_status_code' => $validated['expected_status_code'],
            'notification_type' => $validated['notification_type'],
        ]);

        return redirect(route('monitor.index'))->with('success', 'Monitor has been added!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('monitor::monitors');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('monitor::monitor_edit', [
            'monitor' => Monitor::where('id', $id)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'monitor_type' => ['required', 'int'],
            'name' => ['required', 'string'],
            'url' => ['required', 'string'],
            'interval' => ['required', 'int'],
            'expected_status_code' => ['required', 'int'],
            'notification_type' => ['required', 'int'],
        ]);

        $monitor = Monitor::where('id', $id)->first();

        $monitor->update([
            'name' => $validated['name'],
            'type' => $validated['monitor_type'],
            'url' => $validated['url'],
            'interval' => $validated['interval'],
            'expected_status_code' => $validated['expected_status_code'],
            'notification_type' => $validated['notification_type'],
        ]);

        return redirect(route('monitor.index'))->with('success', 'Monitor has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $monitor = Monitor::find($id)->with('pulses')->first();

        $monitor->pulses()->detach();
        $monitor->delete();

        return redirect()->back()->with('success', 'Monitor has been deleted');
    }
}
