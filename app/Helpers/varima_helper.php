<?php

function adfTest($data, $maxLag = 1)
{
    $n = count($data);
    $deltas = [];
    for ($i = 1; $i < $n; $i++) {
        $deltas[] = $data[$i] - $data[$i - 1];
    }

    // Create the design matrix for the regression
    $Yt_1 = array_slice($data, 0, -1); // Y(t-1)
    $X = [];
    for ($i = 0; $i < count($deltas); $i++) {
        $row = [$Yt_1[$i]];
        // Add lagged differences
        for ($lag = 1; $lag <= $maxLag; $lag++) {
            $row[] = $deltas[$i - $lag] ?? 0; // Use 0 if index is out of bounds
        }
        $X[] = $row;
    }

    // Perform linear regression
    $regressionModel = multipleLinearRegression($deltas, $X);

    $adfStatistic = $regressionModel['coefficients'][0] / $regressionModel['stdErrors'][0];
    $criticalValue = -2.86; // Example critical value for 95% confidence, adjust as necessary

    return $adfStatistic < $criticalValue;
}

function multipleLinearRegression($y, $X)
{
    $n = count($y);
    $k = count($X[0]);

    // Transpose X
    $Xt = array_map(null, ...$X);

    // Calculate XtX
    $XtX = [];
    for ($i = 0; $i < $k; $i++) {
        for ($j = 0; $j < $k; $j++) {
            $XtX[$i][$j] = array_sum(array_map(fn ($x) => $x[$i] * $x[$j], $X));
        }
    }

    // Calculate XtY
    $XtY = [];
    for ($i = 0; $i < $k; $i++) {
        $XtY[$i] = array_sum(array_map(fn ($x, $yi) => $x[$i] * $yi, $X, $y));
    }

    // Inverse of XtX
    $XtX_inv = matrixInverse($XtX);

    // Calculate coefficients
    $coefficients = [];
    for ($i = 0; $i < $k; $i++) {
        $coefficients[$i] = array_sum(array_map(fn ($x, $y) => $x * $y, $XtX_inv[$i], $XtY));
    }

    // Calculate residuals and standard errors
    $residuals = array_map(fn ($yi, $xi) => $yi - array_sum(array_map(fn ($b, $xij) => $b * $xij, $coefficients, $xi)), $y, $X);
    $residualSumOfSquares = array_sum(array_map(fn ($e) => $e * $e, $residuals));
    $stdError = sqrt($residualSumOfSquares / ($n - $k));

    // Standard errors for coefficients
    $stdErrors = [];
    for ($i = 0; $i < $k; $i++) {
        $stdErrors[$i] = $stdError * sqrt($XtX_inv[$i][$i]);
    }

    return ['coefficients' => $coefficients, 'stdErrors' => $stdErrors];
}

function matrixInverse($matrix)
{
    $n = count($matrix);
    $identity = array_map(fn ($i) => array_map(fn ($j) => $i === $j ? 1 : 0, range(0, $n - 1)), range(0, $n - 1));
    return $identity; // Placeholder for actual inversion logic
}

function difference($data)
{
    $diffData = [];
    for ($i = 1; $i < count($data); $i++) {
        $diffData[] = $data[$i] - $data[$i - 1];
    }
    return $diffData;
}

function calculateACF($data, $maxLag = 21)
{
    $n = count($data);
    $mean = array_sum($data) / $n;
    $acf = [];

    for ($lag = 0; $lag <= $maxLag; $lag++) {
        $autoCorr = 0;
        for ($i = 0; $i < $n - $lag; $i++) {
            $autoCorr += ($data[$i] - $mean) * ($data[$i + $lag] - $mean);
        }
        $acf[] = $autoCorr / array_sum(array_map(function ($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $data));
    }

    return $acf;
}

function calculatePACF($data, $maxLag = 21)
{
    $n = count($data);
    $acf = calculateACF($data, $maxLag);
    $pacf = [];
    $pacf[0] = 1;

    for ($k = 1; $k <= $maxLag; $k++) {
        $sum = 0;
        for ($j = 1; $j < $k; $j++) {
            $sum += $pacf[$j] * $acf[$k - $j];
        }
        $pacf[$k] = ($acf[$k] - $sum) / (1 - $sum);
    }

    return $pacf;
}
