<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Events\StudentCreated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('name')->paginate(10);
        $votedCount = Student::where('has_voted', true)->count();

        return view('admin.students.index', compact('students', 'votedCount'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|unique:students,nis|digits_between:4,20',
            'name' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.digits_between' => 'NIS harus berupa angka antara 4-20 digit.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $student = Student::create([
                'nis' => $request->nis,
                'name' => $request->name,
                'has_voted' => false,
            ]);

            // Fire event untuk generate QR Code
            event(new StudentCreated($student));

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil ditambahkan dan QR Code telah dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|digits_between:4,20|unique:students,nis,' . $student->id,
            'name' => 'required|string|max:255',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
            'nis.digits_between' => 'NIS harus berupa angka antara 4-20 digit.',
            'name.required' => 'Nama siswa wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $oldNis = $student->nis;
            $student->update([
                'nis' => $request->nis,
                'name' => $request->name,
            ]);

            if ($oldNis !== $request->nis) {
                if ($student->qr_code_path && Storage::disk('public')->exists($student->qr_code_path)) {
                    Storage::disk('public')->delete($student->qr_code_path);
                }
                event(new StudentCreated($student));
            }

            return redirect()->route('students.index')
                ->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy(Student $student)
    {
        try {
            if ($student->has_voted) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus siswa yang sudah melakukan voting.');
            }

            // Hapus file QR Code jika ada
            if ($student->qr_code_path && Storage::disk('public')->exists($student->qr_code_path)) {
                Storage::disk('public')->delete($student->qr_code_path);
            }

            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Siswa berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}