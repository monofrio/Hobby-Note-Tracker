<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $query = Plant::query();

        if ($request->has('archived') && $request->archived == 'true') {
            $query = $query->archived();
        } else {
            $query = $query->active();
        }

        $plants = $query->get();
        $plantCount = $plants->count();

        return view('plants.index', compact('plants', 'plantCount'));
    }

    public function show(Plant $plant)
    {
        $plant->load('notes');
        $activePlants = Plant::where('batch_number', $plant->batch_number)
            ->where('archived', false)
            ->count();

        return view('plants.show', compact('plant', 'activePlants'));
    }

    public function create()
    {
        return view('plants.create');
    }

    public function store(Request $request)
    {
        Log::info('Incoming Request:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_type' => 'required|in:indoor,outdoor',
            'quantity' => 'required|integer|min:0',
            'start_type' => 'required|in:seed,transplant,clone',
        ]);

        $batchNumber = date('Ymd') . '-' . uniqid();
        $quantity = $request->input('quantity');

        foreach (range(1, $quantity) as $i) {
            Plant::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'location_type' => $request->input('location_type'),
                'start_type' => $request->input('start_type'),
                'batch_number' => $batchNumber,
                'batch_plant_number' => $i,
            ]);
        }

        return redirect()->route('plants.index')->with('success', 'Plant created successfully.');
    }

    public function edit(Plant $plant)
    {
        return view('plants.edit', compact('plant'));
    }

    public function update(Request $request, Plant $plant)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_type' => 'required|in:indoor,outdoor',
            'start_type' => 'required|in:seed,transplant,clone',
        ]);

        $plant->update($request->only(['name', 'description', 'location_type', 'start_type']));

        return redirect()->route('plants.show', $plant)->with('success', 'Plant updated successfully.');
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }

    public function export()
    {
        $plants = Plant::where('is_exported', false)->get();

        if ($plants->isEmpty()) {
            return back()->with('message', 'No plants available for export.');
        }

        return $this->generateCSV($plants, 'plants_export');
    }

    public function showExportPage()
    {
        $plants = Plant::where('is_exported', false)->get();

        return view('plants.export', compact('plants'));
    }

    public function showReviewPage()
    {
        $plants = Plant::all();
        return view('plants.review', compact('plants'));
    }

    public function exportSelectedPlants(Request $request)
    {
        $selectedPlantIds = $request->input('plant_ids', []);

        if (empty($selectedPlantIds)) {
            return back()->with('message', 'No plants selected for export.');
        }

        $plants = Plant::whereIn('id', $selectedPlantIds)->get();

        return $this->generateCSV($plants, 'selected_plants_export');
    }

    public function addToExport(Request $request)
    {
        $selectedPlantIds = $request->input('plant_ids', []);

        if (empty($selectedPlantIds)) {
            return back()->with('message', 'No plants selected for export.');
        }

        $plants = Plant::whereIn('id', $selectedPlantIds)->get();

        return $this->generateCSV($plants, 'plants_review_export');
    }

    private function generateCSV($plants, $filePrefix)
    {
        $fileName = $filePrefix . '_' . now()->format('Y_m_d_H_i_s') . '.csv';
        $filePath = storage_path("app/public/exports/{$fileName}");

        if (!file_exists(storage_path('app/public/exports'))) {
            mkdir(storage_path('app/public/exports'), 0755, true);
        }

        $handle = fopen($filePath, 'w');
        fputcsv($handle, ['ID', 'Name', 'Type', 'Date Added', 'Batch Number', 'Batch Plant Number', 'Batch Quantity', 'URL']);

        foreach ($plants as $plant) {
            fputcsv($handle, [
                $plant->id,
                $plant->name,
                $plant->start_type,
                $plant->created_at->toDateString(),
                $plant->batch_number,
                $plant->batch_plant_number,
                Plant::where('batch_number', $plant->batch_number)->count(),
                url("/plants/{$plant->id}/edit"),
            ]);
        }

        fclose($handle);

        Plant::whereIn('id', $plants->pluck('id'))->update([
            'is_exported' => true,
            'exported_at' => now(),
        ]);

        return response()->download($filePath)->deleteFileAfterSend();
    }

    public function showBatch($batchNumber)
    {
        $plants = Plant::where('batch_number', $batchNumber)->get();

        if ($plants->isEmpty()) {
            return redirect()->route('plants.index')->with('error', 'Batch not found.');
        }

        $batchDescription = $plants->first()->description ?? 'No description available';

        return view('plants.batch', compact('plants', 'batchNumber', 'batchDescription'));
    }

    public function archive(Plant $plant)
    {
        $plant->archived = true;
        $plant->save();

        Plant::updateBatchCount($plant->batch_number);

        return redirect()->route('plants.index')->with('success', 'Plant archived successfully.');
    }

    public function archiveBatch($batchNumber)
    {
        Plant::where('batch_number', $batchNumber)->update(['archived' => true]);

        Plant::updateBatchCount($batchNumber);

        return redirect()->route('plants.index')->with('success', 'Batch archived successfully.');
    }

    public function archiveList()
    {
        $archivedPlants = Plant::archived()->get();

        return view('plants.archive', compact('archivedPlants'));
    }

    public function restore(Plant $plant)
    {
        $plant->update(['archived' => false]);
        return redirect()->route('plants.archive.list')->with('success', 'Plant restored successfully.');
    }

    public function restoreBatch($batchNumber)
    {
        Plant::where('batch_number', $batchNumber)->update(['archived' => false]);
        return redirect()->route('plants.archive.list')->with('success', 'Batch restored successfully.');
    }
}
