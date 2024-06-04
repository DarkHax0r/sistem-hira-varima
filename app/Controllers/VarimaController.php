<?php

namespace App\Controllers;

use App\Models\VarimaModel;
use Yusser\ARIMA\ARIMA;

class VarimaController extends BaseController
{
    public function index()
    {
        helper('varima_helper');

        $dataModel = new VarimaModel();
        $dataRecords = $dataModel->getData();

        $pendapatan = array_column($dataRecords, 'pendapatan');
        $modal = array_column($dataRecords, 'modal');

        // Simpan data asli sebelum differencing
        $originalPendapatan = $pendapatan;
        $originalModal = $modal;

        // Perform ADF test on Pendapatan
        $resultPendapatan = adfTest($pendapatan);
        if (!$resultPendapatan) {
            $pendapatan = difference($pendapatan);
            $resultPendapatan = adfTest($pendapatan);
        }

        // Perform ADF test on Modal
        $resultModal = adfTest($modal);
        if (!$resultModal) {
            $modal = difference($modal);
            $resultModal = adfTest($modal);
        }

        // Calculate ACF and PACF for Pendapatan
        $acfPendapatan = calculateACF($pendapatan);
        $pacfPendapatan = calculatePACF($pendapatan);

        // Calculate ACF and PACF for Modal
        $acfModal = calculateACF($modal);
        $pacfModal = calculatePACF($modal);

        return view('results', [
            'originalPendapatan' => $originalPendapatan,
            'differencedPendapatan' => $pendapatan,
            'resultPendapatan' => $resultPendapatan,
            'acfPendapatan' => $acfPendapatan,
            'pacfPendapatan' => $pacfPendapatan,
            'originalModal' => $originalModal,
            'differencedModal' => $modal,
            'resultModal' => $resultModal,
            'acfModal' => $acfModal,
            'pacfModal' => $pacfModal,
        ]);
    }
}
