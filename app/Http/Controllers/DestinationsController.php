<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Destinations;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDestinationsRequest;
use App\Http\Requests\UpdateDestinationsRequest;

class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $des = Destinations::all();

        if ($des->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada Destinations yang ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'message' => 'Destinations ditemukan.',
            'data' => $des
        ], Response::HTTP_OK);
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
    public function store(StoreDestinationsRequest $request)
    {
        $validate = $request->validate(
            [
                'nama' => 'required|unique:fakultas',
                'deskripsi' => 'required',
                'jarak' => 'required'
            ]
        );

        $des = Destinations::create($validate);
        if($des){
            $data['Success'] = true;
            $data['Message'] = "Data Fakultas Berhasil Disimpan";
            $data['Data'] = $des;
            return response()->json($data, 201);//201 biar berhasil (kodenya)
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Destinations $destinations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destinations $destinations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDestinationsRequest $request, Destinations $destinations)
    {
        // Mencari data fakultas berdasarkan ID
        $des = Destinations::find($id);
        if ($des) {
            // Validasi input
            $validate = $request->validate(
                [
                    'nama' => 'required',
                    'deskripsi' => 'required',
                    'jarak' => 'required'
                ]
            );

            $des = Destinations::where('id',$id)->update($validate); //simpan data
            if($des){
                $data['Success'] = true;
                $data['Message'] = "Data Destinations Berhasil Diupdate";
                $data['Data'] = $des;
                return response()->json($data, 201);//201 biar berhasil (kodenya
            }
        } else {
            $data['Success'] = false;
            $data['Message'] = "Data Destinations Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destinations $destinations)
    {
        //
    }
}
