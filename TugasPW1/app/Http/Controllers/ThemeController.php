<?php

namespace App\Http\Controllers;
use App\Models\Theme;
use App\Models\Section;
use App\Models\Book;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    protected $fillable = ['name', 'code', 'section_id'];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theme = theme::with('theme_section')->get();
        return response()->json ($theme, 200);
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
                'name' => 'required',
                'code' => 'required',
                'section_id' => 'required||exists:fakultas,id'
            ]
        );
        $theme = Theme::create($validate); //simpan data
        if($theme){
            $data['Success'] = true;
            $data['Message'] = "Data Theme berhasil Disimpan";
            $data['Data'] = $theme;
            return response()->json($data, 201);//201 biar berhasil (kodenya)
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Theme $theme, sting $id)
    {
        $cariTheme = Theme::find($id);
        if ($cariTheme) {
            // Validasi input
            $validate = $request->validate(
                [
                    'name' => 'required',
                    'code' => 'required',
                    'section_id' => 'required||exists:section,id'
                ]
            );

            $theme = Theme::where('id',$id)->update($validate); //simpan data
            if($theme){
                $data['Success'] = true;
                $data['Message'] = "Data Theme Berhasil Diupdate";
                $data['Data'] = $theme;
                return response()->json($data, 201);//201 biar berhasil (kodenya
            }
        }
        else {
            $data['Success'] = false;
            $data['Message'] = "Data Theme Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme, string $id)
    {
        $cariTheme = Theme::where('id',$id);
        if($cariTheme) {
            $cariTheme->delete();
            $data['Success'] = true;
            $data['Message'] = "Data Theme Berhasil Dihapus";
            return response()->json($data, 200);//sama kayak 200 biar berhasil
        }
        else 
        {
            $data['Success'] = false;
            $data['Message'] = "Data Theme Tidak Ditemukan";
            return response()->json($data, 404); // 404 Not Found
        }
    }
}
