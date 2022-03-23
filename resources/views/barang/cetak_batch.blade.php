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
<title>Title</title>
</head>
<body>
    <div class="container p-4">
        <div class="text-center pb-4"> 
            <a href="javascript:void(0)" onclick="window.print()" class="btn btn-sm btn-outline-success d-print-none">
               <i class="fas fa-print    "></i> Cetak Halaman
            </a>
        </div>
        <div class="row d-flex justify-content-center align-content-center">
            <?php foreach($barang as $b){?>
                <div class="col-md-2 p-4 text-center border">
                    <!-- insert your custom barcode setting your data in the GET parameter "data" -->
                    <img alt='Barcode Gerenator TEC-IT' class="img" width="100" src='https://barcode.tec-it.com/barcode.ashx?data={{ $b->kode_barang }}{{ $b->nama_barang }}&code=QRCode&dmsize=Default&eclevel=L' />
                    <p class="mt-2 small">{{ $b->kode_barang }}{{ $b->nama_barang }}</p>
                </div>
            <?php }?>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>
</html>