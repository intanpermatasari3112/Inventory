<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Cetak Barcode</title>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <button type="button" onclick="window.print()" class="no_print mt-2 btn btn-outline-secondary d-print-none"> 
                <i class="fas fa-print    "></i>
                Cetak Halaman</button>
        </div>      
        <div class="row ">
            @foreach ($barang as $item)
            <div class="col-sm-3 p-4">
                <div style='text-align: center; '>
                    <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                    {{-- <img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data={{ $barang->kode_barang }}{{ $barang->nama_barang }}&code=Code128' /> --}}
                    <img alt='Barcode Generator TEC-IT' class="img" width="100" src=' https://barcode.tec-it.com/barcode.ashx?data={{ $item->kode_barang }}{{ $item->nama_barang }}&code=QRCode' /> <p>{{ $item->kode_barang }}{{ $item->nama_barang }}</p>           
                </div>
            </div>
            @endforeach
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>