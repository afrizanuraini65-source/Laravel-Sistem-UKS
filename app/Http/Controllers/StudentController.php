<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Kelas;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('kelas');

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('nis', 'like', "%{$search}%");
        }

        $students = $query->latest()->paginate(10);
        return view('students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load(['kelas', 'treatments' => function($q) {
            $q->with('medicines')->latest('tanggal_kunjungan');
        }]);

        return view('students.show', compact('student'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('students.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:students',
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jk' => 'required|in:L,P',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit(Student $student)
    {
        $kelas = Kelas::all();
        return view('students.edit', compact('student', 'kelas'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'nama' => 'required|string',
            'kelas_id' => 'required|exists:kelas,id',
            'jk' => 'required|in:L,P',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
