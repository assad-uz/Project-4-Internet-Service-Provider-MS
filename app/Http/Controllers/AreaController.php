<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    // 1. INDEX: সমস্ত এরিয়া দেখানোর জন্য
    public function index()
    {
        $areas = Area::orderBy('id', 'desc')->paginate(10);
        return view('pages.admin.areas.index', compact('areas'));
    }

    // 2. CREATE: নতুন ফর্ম দেখানোর জন্য
    public function create()
    {
        return view('pages.admin.areas.create');
    }

    // 3. STORE: নতুন ডেটা সেভ করার জন্য
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:areas,name',
        ]);

        Area::create($validated);

        return redirect()->route('areas.index')
            ->with('success', 'Area created successfully.');
    }

    // 4. EDIT: এডিট ফর্ম দেখানোর জন্য
    public function edit(Area $area)
    {
        return view('pages.admin.areas.edit', compact('area'));
    }

    // 5. UPDATE: ডেটা আপডেট করার জন্য
    public function update(Request $request, Area $area)
    {
        $validated = $request->validate([
            // বর্তমান row-টিকে বাদ দিয়ে uniqueness চেক করা হচ্ছে
            'name' => 'required|string|max:100|unique:areas,name,' . $area->id,
        ]);

        $area->update($validated);

        return redirect()->route('areas.index')
            ->with('success', 'Area updated successfully.');
    }

    // 6. DESTROY: ডেটা ডিলিট করার জন্য
    public function destroy(Area $area)
    {
        // 💡 যদি ভবিষ্যতে এরিয়ার সাথে অন্য কোনো টেবিলের সম্পর্ক থাকে (যেমন: কাস্টমার), 
        // তবে ডিলিট করার আগে সেই সম্পর্কটি চেক করা উচিত। আপাতত সরাসরি ডিলিট করা হচ্ছে।
        $area->delete();

        return redirect()->route('areas.index')
            ->with('success', 'Area deleted successfully.');
    }
}
