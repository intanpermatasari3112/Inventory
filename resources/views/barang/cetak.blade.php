<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris</title>
    <style>
        @media print {
            .no_print, .no_print * {
                display: none !important;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="card-body">
        <div class="col-sm-12">
            <div style='text-align: center;'>
                <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data={{ $barang->kode_barang }}{{ $barang->nama_barang }}&code=Code128' />
            </div>
            <button type="button" onclick="window.print()" class="no_print">Cetak</button>
        </div>
    </div>
    </div>

</html>