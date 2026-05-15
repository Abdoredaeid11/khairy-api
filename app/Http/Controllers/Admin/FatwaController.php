<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fatwa;
use App\Services\Fatwa\FatwaService;

class FatwaController extends Controller
{
    protected $service;

    public function __construct(FatwaService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'type', 'status']);
        $fatwas = $this->service->getAllFatwas($filters, 10);

        return view('Admin.fatwa.index', compact('fatwas'));
    }

    public function create()
    {
        return view('Admin.fatwa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:video,qa,ruling,article',
            'title' => 'required|string',
            'video_url' => 'nullable|string',
            'content' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
        
        $data['is_published'] = $request->has('is_published');
        
        $this->service->create($data);
        return redirect()->route('admin.fatwas.index')->with('success', 'تمت إضافة الفتوى بنجاح');
    }

    public function edit(Fatwa $fatwa)
    {
        return view('Admin.fatwa.edit', compact('fatwa'));
    }

    public function update(Request $request, Fatwa $fatwa)
    {
        $data = $request->validate([
            'type' => 'required|in:video,qa,ruling,article',
            'title' => 'required|string',
            'video_url' => 'nullable|string',
            'content' => 'nullable|string',
            'is_published' => 'nullable|boolean',
        ]);
        
        $data['is_published'] = $request->has('is_published');
        
        $this->service->update($data, $fatwa);
        return redirect()->route('admin.fatwas.index')->with('success', 'تم تحديث الفتوى بنجاح');
    }

    public function destroy(Fatwa $fatwa)
    {
        $this->service->delete($fatwa);
        return redirect()->route('admin.fatwas.index')->with('success', 'تم حذف الفتوى بنجاح');
    }
}
