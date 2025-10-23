<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
     
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fakultas = Fakultas::all(); // select * from Fakultas
        return response() -> json($fakultas ,200);
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
        $validate = $request->validate(
            [
                'nama' => 'required|unique:fakultas',
                'kode' => 'required'
            ]
        );


        $fakultas = Fakultas::create($validate); //simpan data
        if($fakultas){
            $data['Success'] = true;
            $data['Message'] = "Data Fakultas Berhasil Disimpan";
            $data['Data'] = $fakultas;
            return response()->json($data, 201);//201 biar berhasil (kodenya)
        }
    }
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
        // Mencari data fakultas berdasarkan ID
        $fakultas = Fakultas::find($id);
        if ($fakultas) {
            // Validasi input
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'kode' => 'required'
                ]
            );

            $fakultas = Fakultas::where('id',$id)->update($validate); //simpan data
            if($fakultas){
                $data['Success'] = true;
                $data['Message'] = "Data Fakultas Berhasil Diupdate";
                $data['Data'] = $fakultas;
                return response()->json($data, 201);//201 biar berhasil (kodenya
            }
        } else {
            $data['Success'] = false;
            $data['Message'] = "Data Fakultas Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cariFakultas = Fakultas::where('id',$id);
        if($cariFakultas) {
            $cariFakultas->delete();
            $data['Success'] = true;
            $data['Message'] = "Data Fakultas Berhasil Dihapus";
            return response()->json($data, 200);//sama kayak 200 biar berhasil (kodenya)
    } else {
            $data['Success'] = false;
            $data['Message'] = "Data Fakultas Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }
}
