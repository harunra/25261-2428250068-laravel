<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Theme;
use App\Models\Book;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = Section::all(); // select * from Section
        return response() -> json($section ,200);
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
        $validate = $request->Validate(
            [
                'name' => 'required|unique:sections',
                'code' => 'required',

            ]
        );

        $section = Section::create($validate); //simpan data
        if($section){
            $data['Success'] = true;
            $data['Message'] = "Data Section Berhasil Disimpan";
            $data['Data'] = $section;
            return response()->json($data, 201);//201 biar berhasil (kodenya
        }   
    }
    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section, string $id)
    {
        $section = Section::find($id);
        if($section) {
            $validate = $request->validate(
                [
                    'name' => 'required',
                    'location' => 'required',
                    'kode' => 'required'
                ]
            );
        $section = Section::where('id',$id)->update($validate); //simpan data
            if($section){
                $data['Success'] = true;
                $data['Message'] = "Data Section Berhasil Diupdate";
                $data['Data'] = $section;
                return response()->json($data, 201);//201 biar berhasil (kodenya
            }
        } else {
            $data['Success'] = false;
            $data['Message'] = "Data Section Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section, string $id)
    {
        
        $cariSection = Sectoin::where('id',$id);
        if($cariSection) {
            $cariSection->delete();
            $data['Success'] = true;
            $data['Message'] = "Data Section Berhasil Dihapus";
            return response()->json($data, 200);//sama kayak 200 biar berhasil (kodenya)
    } else {
            $data['Success'] = false;
            $data['Message'] = "Data Section Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    
    }
}
