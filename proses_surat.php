<?php
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $nis         = htmlspecialchars(trim($_POST['nis'] ?? ''));
    $kelas       = htmlspecialchars(trim($_POST['kelas'] ?? ''));
    $alasan      = htmlspecialchars(trim($_POST['alasan'] ?? ''));
    $tgl_mulai   = !empty($_POST['tgl_mulai']) ? date('d F Y', strtotime($_POST['tgl_mulai'])) : '';
    $tgl_selesai = !empty($_POST['tgl_selesai']) ? date('d F Y', strtotime($_POST['tgl_selesai'])) : '';
    $keterangan  = htmlspecialchars(trim($_POST['keterangan'] ?? ''));
    $tgl_sekarang = date('d F Y');

    $filename = preg_replace('/[^A-Za-z0-9]+/', '_', trim($nama)) ?: 'surat_izin';

    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cetak Surat</title>
        <style>
            body {
                font-family: "Times New Roman";
                font-size: 12pt;
                margin: 20px;
            }
            .kop {
                font-family: "Century Gothic";
                text-align: center;
                border-bottom: 3px double #000;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            .kop h2 {
                margin: 0;
                font-size: 16pt;
                text-transform: uppercase;
            }
            .kop p {
                margin: 2px;
                font-size: 10pt;
            }
            .title {
                text-align: center;
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: 25px;
            }
            .content {
                line-height: 1.6;
                text-align: justify;
            }
            .table-data {
                margin: 15px;
                width: 100%;
            }
            .table-data td {
                padding: 4px 0;
                vertical-align: top;
            }
            .ttd-container {
                margin-top: 30px;
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="kop">
            <h2>SMK TEXMACO SEMARANG</h2>
            <p>Jl. Raya Mangkang Kulon | Telp: (024) 223-8889</p>
        </div>

        <div class="title">SURAT IZIN MENINGGALKAN KELAS</div>

        <div class="content">
            <p>Yang bertanda tangan dibawah ini:</p>
            <table class="table-data">
                <tr>
                    <td width="130">Nama</td>
                    <td width="15">:</td>
                    <td><b>' . $nama . '</b></td>
                </tr>
                <tr>
                    <td width="130">NIS</td>
                    <td>:</td>
                    <td>' . $nis . '</td>
                </tr>
                <tr>
                    <td width="130">Kelas</td>
                    <td>:</td>
                    <td>' . $kelas . '</td>
                </tr>
            </table>

            <p>
                Bermaksud untuk mengajukan izin meninggalkan kelas pada tanggal
                <b>' . $tgl_mulai . '</b> sampai dengan <b>' . $tgl_selesai . '</b>
                dikarenakan <b>' . $alasan . '</b>.
            </p>

            ' . ($keterangan ? '<p>Keterangan : <b>' . $keterangan . '</b></p>' : '') . '

            <p>
                Demikian surat pengajuan izin ini saya buat. Atas perhatian dan pengertian
                Bapak/Ibu, saya ucapkan terima kasih.
            </p>

            <div class="ttd-container">
                <p>Semarang, ' . $tgl_sekarang . '<br>Hormat Saya,</p>
                <br><br><br>
                <p><b>(' . $nama . ')</b></p>
            </div>
        </div>
    </body>
    </html>
    ';

    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('Surat_Izin_' . $filename . '.pdf', ['Attachment' => false]);
    exit;
}
?>