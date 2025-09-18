<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Http\Requests\StoreFieldRequest;
use App\Http\Requests\UpdateFieldRequest;
use Illuminate\Support\Facades\Storage;
use App\Services\FieldService;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FieldController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Field::class);

        $fields = Field::paginate(10);
        return view('dashboard.fields.index', compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Field::class);

        return view('dashboard.fields.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFieldRequest $request)
    {
        $this->authorize('create', Field::class);

        $data = $request->validated();
        $photo = $request->hasFile('photo') ? $request->file('photo') : null;

        FieldService::createField($data, $photo);

        return redirect()->route('fields.index')->with('success', 'Field created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Field $field)
    {
        $this->authorize('view', $field);

        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Field $field)
    {
        $this->authorize('update', $field);

        return view('dashboard.fields.edit', compact('field'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFieldRequest $request, Field $field)
    {
        $this->authorize('update', $field);

        $data = $request->validated();
        $photo = $request->hasFile('photo') ? $request->file('photo') : null;

        FieldService::updateField($field, $data, $photo);

        return redirect()->route('fields.index')->with('success', 'Field updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Field $field)
    {
        $this->authorize('delete', $field);

        FieldService::deleteField($field);
        return redirect()->route('fields.index')->with('success', 'Field deleted successfully.');
    }
}
