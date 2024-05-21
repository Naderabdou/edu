<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::all();
        return view('dashboard.certificates.index', compact('certificates'));
    }
    public function create()
    {
        return view('dashboard.certificates.create');
    }

    public function store(Request $request)
    {
      $data=  $request->validate([
            'html' => 'required',
            'image' => 'required',
        ]);

    //    $data = $request->all();

       Certificate::create($data);

        return redirect()->route('admin.certificates.index')->with('success', transWord('certificate created successfully'));
    }

    public function destroy(Certificate $certificate)
    {
        $certificate->delete();
        return response()->json(['message' => transWord('certificate deleted successfully')]);
    }

    public function show($id){
        return redirect()->route('admin.certificates.index');
    }
}
