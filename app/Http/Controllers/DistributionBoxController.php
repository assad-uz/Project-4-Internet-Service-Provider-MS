<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DistributionBox;
use Illuminate\Http\Request;

class DistributionBoxController extends Controller
{
    // 1. INDEX: সমস্ত ডিস্ট্রিবিউশন বক্স দেখানোর জন্য
    public function index()
    {
        // 'area' রিলেশনশিপ লোড করে একবারে সব ডেটা আনা হচ্ছে (Eager Loading)
        $distributionBoxes = DistributionBox::with('area')->orderBy('id', 'desc')->paginate(10); 
        return view('pages.admin.distribution_boxes.index', compact('distributionBoxes'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        // ফর্মের জন্য এরিয়া লিস্ট দরকার
        $areas = Area::orderBy('name')->get(); 
        return view('pages.admin.distribution_boxes.create', compact('areas'));
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'box_code' => 'required|string|max:50|unique:distribution_boxes,box_code',
            'name' => 'nullable|string|max:150',
            'area_id' => 'required|exists:areas,id', // নিশ্চিত করা হচ্ছে area_id টি areas টেবিলের id তে আছে
        ]);
        
        DistributionBox::create($validated);

        return redirect()->route('distribution_boxes.index')
                         ->with('success', 'Distribution Box created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(DistributionBox $distributionBox)
    {
        // এডিট ফর্মের জন্য এরিয়া লিস্ট দরকার
        $areas = Area::orderBy('name')->get(); 
        return view('pages.admin.distribution_boxes.edit', compact('distributionBox', 'areas'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, DistributionBox $distributionBox)
    {
        $validated = $request->validate([
            // বর্তমান row-টিকে বাদ দিয়ে uniqueness চেক করা হচ্ছে
            'box_code' => 'required|string|max:50|unique:distribution_boxes,box_code,' . $distributionBox->id,
            'name' => 'nullable|string|max:150',
            'area_id' => 'required|exists:areas,id',
        ]);

        $distributionBox->update($validated);

        return redirect()->route('distribution_boxes.index')
                         ->with('success', 'Distribution Box updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(DistributionBox $distributionBox)
    {
        $distributionBox->delete();
        
        return redirect()->route('distribution_boxes.index')
                         ->with('success', 'Distribution Box deleted successfully.');
    }
}