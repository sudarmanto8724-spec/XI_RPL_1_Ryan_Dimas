<?php
//masukkan library DomPDF
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\option;
use Dompdf\Options;

//instansiasi objrk Dompdf
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //ambil data dari form html
    $nama           = htmlspecialchars($_POST['nama']);
    $nis            = htmlspecialchars($_POST['nis']);
    $kelas          = htmlspecialchars($_POST['kelas']);
    $alasan         = htmlspecialchars($_POST['alasan']);
    $tgl_mulai      = date('d F Y', strtotime($_POST['tgl_mulai']));
    $tgl_selesai    = date('d F Y', strtotime($_POST['tgl_selesai']));
    $keterangan     = htmlspecialchars($_POST['keterangan']);
    $tgl_sekarang   = date('d F Y');
   //template halaman pdf
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>
        body{
            font-family: "Times New Roman";
            font-size: 12pt;
            margin: 20px;
        }
        .kop{
           font-family: "Century Gothic";
           text-align: center;
           border-bottom: 3px double #000; 
           padding-bottom: 10px;
           margin-bottom: 20px;
        }
           .kop h2{
           margin:0;
           font-size: 16pt;
           text-transform: uppercase;
        }
        .kop p{
            margin: 2px;
            font-size:10pt;
        }
            .title{
            text-align: center;
            font-weight : bold;
            text-decoration: underline;
            margin-bottom: 25px;
        }
            .content{
               line-height:1.6;
               text-align: justufy:
            }
        .table-data{
            margin: 15px;
            width: 100%;
        }
        .table-data td{
            padding: 4px 0;
            vertical-align: top;
        }
        .ttd-box{
           float: right;
           width: 200px;
           text-align: center;
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
                <td><b>' .$nama .'</b></td>
            </tr>
            <tr>
               <td width="130">NIS</td>
               <td>:</td>
               <td>' . $nis . '</td>
            </tr>
        </table>
        <p>Bermaksud untuk mengajukan izin meninggalkan kelas,pada tanggal <b>' .$tgl_mulai . '</b>
        sampai dengan <b>' .$tgl_selesai . '</b>
        dikarenakan <b>' .$alasan . '</b>
        </p>
        ' .($keterangan ? '<p>Keterangan : <b>' 
        .$keterangan . '</b></p>' : '') .'
        <p>Demikian surat pengajuan izin ini saya buat.
        Atas perhatian dan pengertian Bapak/Ibu, saya ucapkan temika kasih.
        </p>
        <div class="ttd-container">
        <p> Semarang, '.$tgl_sekarang .'<br>Hormat Saya,</p>
        <br><br><br>
        <p><b>('.$nama .')</b></p>

    </div>
    </div>
</body>
</html>
';

//3. konfigurasi dan inisialisasi Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); //Memunggkinkan load gambar eksternal jika ada 
$dompdf = new Dompdf($options);

//4. Render HTML ke PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

//5. Stream PDF ke Browser
$dompdf->stream("Surat_Izin_" . str_replace('',
'_',$nama) .".pdf", ["Attachment" => false]);
}
?>