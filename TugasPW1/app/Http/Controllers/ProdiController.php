<?php

namespace App\Http\Controllers;
a
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Fakultas;

class ProdiController extends Controller
{
    protected $fillable = ['nama', 'kode', 'fakultas_id'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi = Prodi::with('prodi_fakultas')->get();
        return response()->json ($prodi, 200);
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
                'nama' => 'required|unique:prodis',
                'kode' => 'required',
                'fakultas_id' => 'required||exists:fakultas,id'
            ]
        );
        $prodi = Prodi::create($validate); //simpan data
        if($prodi){
            $data['Success'] = true;
            $data['Message'] = "Data Prodi berhasil Disimpan";
            $data['Data'] = $prodi;
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
         // Mencari data fakultas berdasarkan ID
        $cariProdi = Prodi::find($id);
        if ($cariProdi) {
            // Validasi input
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'kode' => 'required',
                    'fakultas_id' => 'required||exists:fakultas,id'
                ]
            );

            $prodi = Prodi::where('id',$id)->update($validate); //simpan data
            if($prodi){
                $data['Success'] = true;
                $data['Message'] = "Data Fakultas Berhasil Diupdate";
                $data['Data'] = $prodi;
                return response()->json($data, 201);//201 biar berhasil (kodenya
            }
        }
        else {
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
        $cariProdi = Prodi::where('id',$id);
        if($cariProdi) {
            $cariProdi->delete();
            $data['Success'] = true;
            $data['Message'] = "Data Prodi Berhasil Dihapus";
            return response()->json($data, 200);//sama kayak 200 biar berhasil
        }
        else 
        {
            $data['Success'] = false;
            $data['Message'] = "Data Prodi Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }
}
