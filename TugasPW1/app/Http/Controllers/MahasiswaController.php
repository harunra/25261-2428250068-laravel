<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    protected $fillable = ['NPM', 'nama', 'prodi_id'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('mahasiswa_prodi.prodi_fakultas')->get();  //mahasiswa_prdoi.prodi_fakultas
        return response()->json($mahasiswa, 200);                               //itu nama class di model.
    }                                                                           //jadi harus diperhatikan

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
                'NPM' => 'required',
                'nama' => 'required',
                'prodi_id' => 'required|exists:prodis,id'
            ]
        );
        $mahasiswa = Mahasiswa::create($validate); //simpan data
        if($mahasiswa){
            $data['Success'] = true;
            $data['Message'] = "Data Mahasiswa Berhasil Disimpan";
            $data['Data'] = $mahasiswa;
            return response()->json($data, 201);//201 biar berhasil (kodenya)
        }
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
        $cariMahasiswa = Mahasiswa::find($id);
        if($cariMahasiswa) 
        {
            $validate = $request->validate(
                [
                    'NPM'=>'required',
                    'nama' => 'required',
                    'prodi_id' => 'required|exists:prodis,id'
                ]
            );  

            $mahasiswa = Mahasiswa::where('id', $id)->update($validate); //simpan data
            if($mahasiswa) {
                $data['Success'] = true;
                $data['Message'] = "Data Mahasiswa Berhasil Diupdate";
                $data['Data'] = $mahasiswa;
                return response()->json($data, 201);
            }
        }
        else 
        {
            $data['Success'] = false;
            $data['Message'] = "Data Mahasiswa Tidak Ditemukan";
            return response()->json($data, 404); //404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cariMahasiswa = Mahasiswa::where('id',$id);
        if(count($cariMahasiswa->get())){
            $cariMahasiswa->delete();
            $response['success'] = true;
            $response['message'] = 'Mahasiswa berhasil dihapus.';
            return response()->json($response, 200);
        } else {
            $response['success'] = false;
            $response['message'] = 'Mahasiswa tidak ditemukan.';
            return response()->json($response, 404);
        }

    }
}
