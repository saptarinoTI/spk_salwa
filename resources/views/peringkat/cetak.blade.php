<!DOCTYPE html>
<html>
<head>
  <title>Hasil Perangkingan</title>
</head>
<body>
  <style>
    table tr td,
    table tr th {
      font-size: 10pt;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 12px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

  </style>
  <center>
    <h4>Hasil Perangkingan Sistem Pendukung Keputusan Beasiswa</h5>
  </center>

  <table>
    <thead>
      <tr>
        <th>Perangkingan</th>
        <th>Alternatif</th>
        <th>Preverensi</th>
      </tr>
    </thead>
    <tbody>
      @php $i=1 @endphp
      @foreach($dataPendaftar as $p)
      <tr>
        <td>{{ $i++ }}</td>
        <td>{{ ucwords($p->siswa->pendaftar) }}</td>
        <td>{{ ucwords($p->hasil) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>
