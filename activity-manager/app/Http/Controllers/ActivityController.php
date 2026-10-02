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
    public function index(\Illuminate\Http\Request $request)
    {
        $activities = \App\Models\Activity::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($request->category_id, function ($query, $category) {
                $query->where('category_id', $category);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->sort, function ($query, $sort) {
                if ($sort === 'terlama') {
                    $query->oldest('activity_date');
                } else {
                    $query->latest('activity_date');
                }
            }, function ($query) {
                $query->latest('activity_date');
            })
            ->paginate(10)
            ->withQueryString();

        $categories = \App\Models\Category::all();

        return view('activities.index', compact('activities', 'categories'));
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

    public function publish(Activity $activity, ActivityService $service)
    {
        $service->publish($activity);
        return redirect()->route('activities.show', $activity)->with('success', 'Kegiatan berhasil dipublikasikan!');
    }

    public function complete(Activity $activity, ActivityService $service)
    {
        $service->complete($activity);
        
        return redirect()->route('activities.show', $activity)
                        ->with('success', 'Kegiatan berhasil diselesaikan!');
    }
}