<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampaignDurationController extends Controller
{
    public function index()
    {
        return view('campaign-durations.index');
    }

    public function fetchCampaignDuration($id)
    {
        return response()->json(['id' => $id]);
    }

    public function create()
    {
        return view('campaign-durations.create');
    }

    public function edit($id)
    {
        return view('campaign-durations.edit', compact('id'));
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Campaign duration created successfully']);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Campaign duration updated successfully']);
    }

    public function delete($id)
    {
        return response()->json(['message' => 'Campaign duration deleted successfully']);
    }
}
