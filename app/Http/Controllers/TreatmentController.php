<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Student;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::with('student.kelas', 'medicines')->latest()->paginate(10);
        return view('treatments.index', compact('treatments'));
    }

    public function create()
    {
        $students = Student::with('kelas')->get();
        $medicines = Medicine::where('stok', '>', 0)->get();
        return view('treatments.create', compact('students', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'keluhan' => 'required|string',
            'diagnosa' => 'nullable|string',
            'tanggal' => 'required|date',
            'medicines' => 'nullable|array',
            'medicines.*' => 'exists:medicines,id',
            'quantities' => 'nullable|array',
            'quantities.*' => 'integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $treatment = Treatment::create([
                'student_id' => $request->student_id,
                'keluhan' => $request->keluhan,
                'diagnosa' => $request->diagnosa,
                'tanggal_kunjungan' => $request->tanggal, // mapping 'tanggal' from request to db column
            ]);

            if ($request->has('medicines') && count($request->medicines) > 0) {
                foreach ($request->medicines as $index => $medicine_id) {
                    $qty = $request->quantities[$index] ?? 1;
                    
                    // Check stock
                    $medicine = Medicine::lockForUpdate()->find($medicine_id);
                    if ($medicine->stok < $qty) {
                        throw new \Exception("Stok obat {$medicine->nama_obat} tidak mencukupi.");
                    }

                    // Attach to treatment (pivot treatment_details)
                    $treatment->medicines()->attach($medicine_id, ['quantity' => $qty]);

                    // Decrement stock
                    $medicine->decrement('stok', $qty);
                }
            }

            DB::commit();

            return redirect()->route('treatments.index')->with('success', 'Data kunjungan berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function show(Treatment $treatment)
    {
        $treatment->load('student.kelas', 'medicines');
        return view('treatments.show', compact('treatment'));
    }
}
