<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Document</title>
  <style>
    @media print {

      .no_print,
      .no_print * {
        display: none !important;
      }
    }

    main {
      max-width: 720px;
      margin: 0 auto;
    }

    table.table {
      border-collapse: collapse;
      width: 100%;
    }

    table.table tr td,
    table.table tr th {
      padding: 4px 6px;
      border: 1px solid teal;
    }

    h2,
    p {
      margin: 0;
    }
  </style>
</head>

<body>
  <main>
    <table style="width: 100%;">
      <tr align="center">
        <td>
          <img src="{{asset('assets/dist/img/logo.png')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; max-width: 64px;">
        </td>
        <td>
          @stack('judul')
          <p>
            <small>PT Lauwba Techno Indonesia</small>
          </p>
        </td>
      </tr>
    </table>
    <hr>
    @yield('content')

    <div class="no_print" style="padding: 8px 0;text-align: right;">
      <button onclick="window.print()" style="text-align: center">
        <i class="fas fa-print"></i>
        Cetak Halaman
      </button>
    </div>
  </main>
</body>

</html>