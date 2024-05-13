<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\ParfumModel;

use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Laporan extends BaseController
{

    public function index()
    {
        // Simpan data ke dalam database menggunakan model
        $parfumModel = new ParfumModel();

        $data = [
            'parfum' => $parfumModel->findAll()
        ];
        return view('laporan/laporanharian', $data);
    }

    public function addData()
    {
        $tanggal = $this->request->getPost('tanggal');
        $pendapatan = $this->request->getPost('pendapatan');
        $modal = $this->request->getPost('modal');

        // Simpan data ke dalam database menggunakan model
        $parfumModel = new ParfumModel();
        $data = [
            'tanggal' => $tanggal,
            'pendapatan' => $pendapatan,
            'modal' => $modal,
        ];
        $parfumModel->insert($data);

        // Redirect atau berikan respons sesuai kebutuhan
        // Contoh: kembalikan ke halaman sebelumnya
        return redirect()->to(previous_url())->with('success', 'Data berhasil ditambahkan');
    }

    public function importData()
    {
        // Simpan data ke dalam database menggunakan model
        $parfumModel = new ParfumModel();

        $file = $this->request->getFile('file');
        $ext = $file->getExtension();

        // Periksa apakah file adalah XLS atau XLSX
        if ($ext === 'xls') {
            $reader = new Xls();
        } elseif ($ext === 'xlsx') {
            $reader = new Xlsx();
        } else {
            session()->setFlashdata('pesan', 'Format file tidak didukung. Harap unggah file XLS atau XLSX.');
            return redirect()->to(base_url('aset/aset_real'));
        }

        $spreadsheet = $reader->load($file);

        // Ambil daftar semua sheet dalam file Excel
        $sheetNames = $spreadsheet->getSheetNames();

        // Mulai impor data baru
        foreach ($sheetNames as $sheetName) {
            // Set aktifkan sheet sesuai dengan nama
            $spreadsheet->setActiveSheetIndexByName($sheetName);

            // Ambil data dari sheet yang aktif
            $sheet = $spreadsheet->getActiveSheet()->toArray();

            foreach ($sheet as $key => $item) {
                if ($key < 3) continue; // Skip the first 4 rows

                // Check if any column in the row contains data (you can choose a specific column to check)
                $parfumModel->insert([
                    'tanggal' => $item[1], // Sesuaikan indeks kolom dengan yang benar
                    'pendapatan' => $item[2], // Sesuaikan indeks kolom dengan yang benar
                    'modal' => $item[3], // Sesuaikan indeks kolom dengan yang benar
                ]);
            }
        }

        session()->setFlashdata('pesan', 'Data Berhasil Diimport!!!');
        return redirect()->to(base_url('Laporan'));
    }
}
