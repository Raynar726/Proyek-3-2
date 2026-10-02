<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Services\ActivityService;
use DomainException;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = Activity::query()
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact('activities'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request, ActivityService $service): RedirectResponse
    {
        $activity = $service->create($request->validated());
        
        return redirect()->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::all();
        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->update($activity, $request->validated());
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['status' => $exception->getMessage()])
                ->withInput();
        }
        
        return redirect()->route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();
        
        return redirect()->route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}