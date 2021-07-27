<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kategori;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
        
    }
    public function index (){
        $data = Kategori::all();
            return response()->json($data);
        }
    
        public function Kategori() {
            return response()->json(Kategori::all(), 200);
        }
        public function store (Request $request){
            $validasi = Validator::make($request->all(), [
                "nama_kategori"=>"required",
                "penerbit" => "required",
                "tempat_terbit" => "required",
                "keterangan" =>"required",
            ]);
    
            if ($validasi->passes()) {
                $data = Kategori::create($request->all());
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
            $data = Kategori::where('id', $id)->first();
            if (!empty($data)) {
                $validasi = Validator::make($request->all(), [
                "nama_kategori"=>"required",
                "penerbit" => "required",
                "tempat_terbit" => "required",
                "keterangan" =>"required",
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
            $data = Kategori::where('id', $id)->first();
            if (empty($data)) {
                return response()->json([
                    "Pesan" => "Hapus Kategori Gagal",
                    "Data" => ""
                ], 404);
            }
            $data->delete();
            return response()->json([
                "Pesan" => "Data Kategori Berhasil Dihapus",
                "Data" => $data
            ], 200);
        }
}
