<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pelamar</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Data Pelamar (Applicants)</h2>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>NIK</th>
                <th>Instansi</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applicants as $index => $applicant)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $applicant->name }}</td>
                    <td>{{ $applicant->email }}</td>
                    <td>{{ $applicant->phone_number }}</td>
                    <td>{{ $applicant->nik }}</td>
                    <td>{{ $applicant->institution_name }}</td>
                    <td>{{ $applicant->created_at?->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
