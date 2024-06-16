<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perankingan Penerima Bonus Karyawan </title>
</head>

<style>
    h3 {
        margin-top: 40px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
    }
    p {
        margin-bottom: 10px;
        text-align: right;
    }
    h5 {
        margin-top: 70px;
        text-align: right;
        text-decoration: underline;
        font-weight: normal;
        font-size: 16px;
    }
    .jabatan {
        text-align: right;
        font-weight: normal;
        font-size: 16px;
        margin-top: -15;
    }
    table {
        border-collapse: collapse;
        margin-bottom: 100px;
    }
    table, th, td {
        border: 1px solid black;
    }
    footer {
        color: grey;
        font-size: 12px;
        width: 100%;
        height: 50px;
        position: absolute;
        bottom: 0px;
    }
    thead {
        background: white;
    }
</style>

<body>
<h3>DATA HASIL PERANKINGAN</h3>

<table border="1" width="100%">
    <thead>
        <tr align="center">
            <th>Alternatif</th>
            <th>Nilai</th>
            <th width="15%">Ranking</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($hasil as $keys): ?>
        <tr align="center">
            <td align="center">
                <?= $keys->getHasilAlternatif($keys->id_alternatif)->nama ?>
            </td>
            <td><?= round($keys->nilai, 3) ?></td>
            <td><?= $no; ?></td>
        </tr>
        <?php
        $no++;
        endforeach ?>
    </tbody>
</table>

<p>
    <?= "Serang, " . Yii::$app->formatter->asDate('now', 'php:d F Y') ?>
</p>

<p>Mengetahui,</p>
<h5>A B S O R I</h5>
<p class="jabatan">Manager HRD</p>

<Footer>
Jl. Raya Serang Km. 68 Desa Nambo Ilir, Kec. Kibin-Banten, Indonesia Telp : (0254) 402301 – 03 Fax : (0254) 402304
</Footer>
</body>
</html>