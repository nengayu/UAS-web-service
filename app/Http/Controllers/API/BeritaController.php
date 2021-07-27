<?php

namespace App\Http\Controllers\API;

use App\Berita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        
    }
    public function index (){
  //  $data = Berita::all();
    $data = Berita::with('pny')->get();
        return response()->json($data);

    }
    public function Kategori() {
        return response()->json(Berita::all(), 200);
    }
    public function store (Request $request){
        $validasi = Validator::make($request->all(), [
        "judul" => "required",
        "tanggal" => "required",
        "isi" => "required",
        "pengirim" => "required",
        "kategori_id" => "required",
        ]);

        if ($validasi->passes()) {
            $data = Berita::create($request->all());
            return response()->json([
                "pesan" => "berhasil",
                "Data" => $data
            ], 200);
        }
        return response()->json([
            "pesan" => "gagal",
            "Data" => $validasi->errors->all()
        ], 404);
    }
    public function update (Request $request, $id){
        $data = Berita::where('id', $id)->first();
        if (!empty($data)) {
            $validasi = Validator::make($request->all(), [
                "judul" => "required",
                "tanggal" => "required",
                "isi" => "required",
                "pengirim" => "required",
                "kategori_id" => "required",
            ]);
            if ($validasi->passes()) {
                $data->update($request->all());
                return response()->json([
                    "pesan" => "berhasil ubah",
                    "Data" => $data
                ], 200);
            }
            return response()->json([
                "pesan" => "gagal ubah",
                "data" => $validasi->errors->all()
            ], 404);
        }
    }

    public function destroy($id)
    {
        $data = Berita::where('id', $id)->first();
        if (empty($data)) {
            return response()->json([
                "Pesan" => "Hapus Berita Gagal",
                "Data" => ""
            ], 404);
        }
        $data->delete();
        return response()->json([
            "Pesan" => "Data Berita Berhasil Dihapus",
            "Data" => $data
        ], 200);
    }


}




