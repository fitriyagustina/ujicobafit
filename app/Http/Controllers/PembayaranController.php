<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\pembayaran;
use Illuminate\Http\Request;
use Illumiate\Support\Facades\Storage;


class PembayaranController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
          //get pembayaran
          $pembayaran = pembayaran::latest()->paginate(5);

          //render view with siswa
          return view('pembayaran.index', compact('pembayaran'));
    }


    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $data = siswa::all();
        return view('pembayaran.create', compact('data'));
    }

    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'siswa_id'     => 'required',
            'tgl_bayar'     => 'required',
            'jumlah_bayar'     => 'required',


        ]);

        //create pembayaran
        pembayaran::create([
            'siswa_id'     => $request->siswa_id,
            'tgl_bayar'     => $request->tgl_bayar,
            'jumlah_bayar'     => $request->jumlah_bayar,

        ]);
        //redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $pembayaran
     * @return void
     */
    public function edit(pembayaran $pembayaran)
    {
        $data = Siswa::all();
        $bayar = pembayaran::all();
        return view('pembayaran.edit', compact('pembayaran', 'data', 'bayar'));
    }



    public function destroy(pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Didelete!']);
    }
    public function update(Request $request, pembayaran $pembayaran)
    {
        //validate form
        $this->validate($request, [
            'siswa_id'     => 'required',
            'tgl_bayar'     => 'required',
            'jumlah_bayar'     => 'required',
        ]);

            //update post without image
            $pembayaran->update([
                'siswa_id'     => $request->siswa_id,
                'tgl_bayar'     => $request->tgl_bayar,
                'jumlah_bayar'     => $request->jumlah_bayar,
            ]);


        //redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
}
