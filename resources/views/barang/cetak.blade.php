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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="container">
        <div style='text-align: center;'>
            <img alt='Barcode Generator TEC-IT' class="img mt-5" width="100" src=' https://barcode.tec-it.com/barcode.ashx?data={{ $barang->kode_barang }}{{ $barang->nama_barang }}&code=QRCode' /> <p>{{ $barang->kode_barang }} {{ $barang->nama_barang }}</p>           
        </div>
        <div class="text-center">
            <button onclick="window.print()" class="no_print mt-2 btn btn-outline-secondary d-print-none" style="text-align: center"> 
                <i class="fas fa-print"></i>
                Cetak Halaman
            </button>
        </div>
        
    </div>
</body>

</html>