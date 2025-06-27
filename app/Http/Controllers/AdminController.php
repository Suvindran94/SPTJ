<?php

namespace App\Http\Controllers;

use App\Models\bilik;
use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   // Pengurusan Bilik Page
    public function pengurusanBilik()
    {
        $biliks = Bilik::with('doctor')->latest()->get();
        $doctors = User::where('role', 'doctor')->get();
        
        return view('admin.index', compact('biliks', 'doctors'));
    }

    // Store New Bilik
    public function storeBilik(Request $request)
    {
        $request->validate([
            'nama_bilik' => 'required|string|max:255',
            'jenis_rawatan' => 'required|string|max:255',
            'doktor_id' => 'nullable|exists:users,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'keterangan' => 'nullable|string'
        ]);

        try {
            Bilik::create($request->all());
            return response()->json(['success' => true, 'message' => 'Bilik berjaya ditambah!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Update Existing Bilik
    public function updateBilik(Request $request, $id)
    {
        $request->validate([
            'nama_bilik' => 'required|string|max:255',
            'jenis_rawatan' => 'required|string|max:255',
            'doktor_id' => 'nullable|exists:users,id',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'keterangan' => 'nullable|string'
        ]);

        try {
            $bilik = Bilik::findOrFail($id);
            $bilik->update($request->all());
            return response()->json(['success' => true, 'message' => 'Bilik berjaya dikemaskini!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Delete Bilik
    public function destroyBilik($id)
    {
        try {
            $bilik = Bilik::findOrFail($id);
            $bilik->delete();
            return response()->json(['success' => true, 'message' => 'Bilik berjaya dipadam!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }


        // Pengurusan Staff Page
    public function pengurusanStaff()
    {
        $staffs = User::where('role', 'staff')->latest()->get();
        return view('admin.pengurusan-staff', compact('staffs'));
    }

    // Store New Staff
    public function storeStaff(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => 'required|in:A,I'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'staff',
                'status' => $request->status
            ]);

            return response()->json(['success' => true, 'message' => 'Staff berjaya ditambah!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Update Existing Staff
    public function updateStaff(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|max:20',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => 'required|in:A,I'
        ]);

        try {
            $staff = User::findOrFail($id);
            $data = [
                'name' => $request->name,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $staff->update($data);

            return response()->json(['success' => true, 'message' => 'Staff berjaya dikemaskini!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Delete Staff
    public function destroyStaff($id)
    {
        try {
            $staff = User::findOrFail($id);
            $staff->delete();
            return response()->json(['success' => true, 'message' => 'Staff berjaya dipadam!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }


      public function pengurusanDoctor()
    {
        $doctors = User::where('role', 'doctor')->latest()->get();
        return view('admin.pengurusan-doctor', compact('doctors'));
    }

    // Store New Doctor
    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'status' => 'required|in:A,I'
        ]);

        try {
            User::create([
                'name' => $request->name,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
                'status' => $request->status
            ]);

            return response()->json(['success' => true, 'message' => 'Doctor berjaya ditambah!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Update Existing Doctor
    public function updateDoctor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'phone' => 'required|string|max:20',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'status' => 'required|in:A,I'
        ]);

        try {
            $doctor = User::findOrFail($id);
            $data = [
                'name' => $request->name,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status
            ];

            if ($request->password) {
                $data['password'] = Hash::make($request->password);
            }

            $doctor->update($data);

            return response()->json(['success' => true, 'message' => 'Doctor berjaya dikemaskini!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

    // Delete Doctor
    public function destroyDoctor($id)
    {
        try {
            $doctor = User::findOrFail($id);
            $doctor->delete();
            return response()->json(['success' => true, 'message' => 'Doctor berjaya dipadam!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Ralat: ' . $e->getMessage()], 500);
        }
    }

        public function loginlogs()
    {
        $loginLogs = LoginLog::with('user')
            ->latest()
            ->paginate(20);
            
        return view('admin.login-logs', compact('loginLogs'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
