<?php
$matkul = [
    ['nama' => 'Pemrograman Web',   'sks' => 3, 'nilai' => 88],
    ['nama' => 'Basis Data',        'sks' => 3, 'nilai' => 76],
    ['nama' => 'Algoritma',         'sks' => 4, 'nilai' => 58],
    ['nama' => 'Jaringan Komputer', 'sks' => 3, 'nilai' => 45],
    ['nama' => 'Statistika',        'sks' => 2, 'nilai' => 30],
];

function hitungBobot($nilai) {
    if ($nilai >= 85) return ['huruf' => 'A', 'bobot' => 4.0];
    if ($nilai >= 70) return ['huruf' => 'B', 'bobot' => 3.0];
    if ($nilai >= 55) return ['huruf' => 'C', 'bobot' => 2.0];
    if ($nilai >= 40) return ['huruf' => 'D', 'bobot' => 1.0];
    return ['huruf' => 'E', 'bobot' => 0.0];
}

$totalSks = 0;
$totalMutu = 0;
foreach ($matkul as $mk) {
    $totalSks += $mk['sks'];
    $totalMutu += hitungBobot($mk['nilai'])['bobot'] * $mk['sks'];
}
$ips = $totalMutu / $totalSks;
$maks = $ips >= 3.00 ? 24 : 20;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Hasil Studi</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e1b4b, #4c1d95);
            min-height: 100vh;
            margin: 0;
            padding: 40px 15px;
            color: #1f2937;
        }
        .kartu {
            max-width: 720px;
            margin: auto;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,.35);
        }
        .kepala {
            background: #7c3aed;
            color: #fff;
            padding: 22px 28px;
        }
        .kepala h1 { margin: 0; font-size: 22px; }
        .kepala p { margin: 4px 0 0; opacity: .8; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th {
            text-align: left;
            padding: 12px 20px;
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #6b7280;
            border-bottom: 2px solid #ede9fe;
        }
        td { padding: 14px 20px; border-bottom: 1px solid #f3f4f6; }
        tr.mengulang td { background: #fee2e2; color: #b91c1c; font-weight: 600; }
        .huruf {
            display: inline-block;
            width: 30px; height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            background: #ede9fe;
            font-weight: bold;
        }
        .mengulang .huruf { background: #fca5a5; }
        .ringkasan {
            display: flex;
            background: #f5f3ff;
            padding: 20px 28px;
            gap: 20px;
            text-align: center;
        }
        .ringkasan div { flex: 1; }
        .ringkasan small { color: #6b7280; }
        .ringkasan strong { display: block; font-size: 26px; color: #7c3aed; }
    </style>
</head>
<body>
    <div class="kartu">
        <div class="kepala">
            <h1>Kartu Hasil Studi</h1>
            <p>Semester Ini</p>
        </div>

        <table>
            <tr>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai</th>
                <th>Huruf</th>
                <th>Status</th>
            </tr>
            <?php foreach ($matkul as $mk):
                $h = hitungBobot($mk['nilai']);
                $status = $h['bobot'] >= 2.0 ? 'LULUS' : 'MENGULANG';
            ?>
            <tr class="<?= $status == 'MENGULANG' ? 'mengulang' : '' ?>">
                <td><?= $mk['nama'] ?></td>
                <td><?= $mk['sks'] ?></td>
                <td><?= $mk['nilai'] ?></td>
                <td><span class="huruf"><?= $h['huruf'] ?></span></td>
                <td><?= $status ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="ringkasan">
            <div><small>Total SKS</small><strong><?= $totalSks ?></strong></div>
            <div><small>IPS</small><strong><?= number_format($ips, 2) ?></strong></div>
            <div><small>Maks. SKS Depan</small><strong><?= $maks ?></strong></div>
        </div>
    </div>
</body>
</html>