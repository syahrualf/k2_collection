<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {

        $data = [
            'title' => 'Data FAQ',
            'menuFaq' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data FAQ', 'url' => null],
            ],
            'faq' => Faq::all(),
        ];

        return view('admin/faq/index', $data);
    }

    public function create()
    {
        $faq = Faq::all();
        $data = [
            'title' => 'Tambah Data FAQ',
            'menuFaq' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data FAQ', 'url' => route('faq')],
                ['name' => 'Tambah FAQ', 'url' => null],
            ],
            'faq' => $faq,
        ];
        return view('admin/faq/create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|unique:faq,question',
            'answer' => 'required',
        ], [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'question.unique' => 'Pertanyaan sudah terdaftar',
            'answer.required' => 'Jawaban tidak boleh kosong',
        ]);

        $faq = new Faq;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faq')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data FAQ',
            'menuFaq' => 'active',
            'breadcrumb' => [
                ['name' => 'Dashboard', 'url' => route('dashboard')],
                ['name' => 'Data FAQ', 'url' => route('faq')],
                ['name' => 'Edit Data FAQ', 'url' => null],
            ],
            'faq' => Faq::findOrFail($id),
        ];
        return view('admin/faq/edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required|unique:faq,question,' . $id,
            'answer' => 'required',
        ], [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'question.unique' => 'Pertanyaan sudah terdaftar',
            'answer.required' => 'Jawaban tidak boleh kosong',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();

        return redirect()->route('faq')->with('success', 'FAQ berhasil diperbarui');
    }

     public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return redirect()->route('faq')->with('success', 'Data kategori berhasil dihapus');
    }

}
