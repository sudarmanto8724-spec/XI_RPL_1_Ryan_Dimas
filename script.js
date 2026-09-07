// === FUNGSI HALAMAN KONTAK ANGGOTA ===
function tampilkanNama(){
    document.getElementById("namaAnggota").innerHTML = `
    <ol
        style="list-style-type: decimal;
        padding-left:5%;">
        <li>Dimas (Dimas@gmail.com)</li>
        <li>Ryan (Ryan@gmail.com)</li>
    </ol>

       <button onClick="location.reload()">
         Tutup Kembali
       </button>
    `;
}

// === FUNGSI HALAMAN RESEP ===
function tampilkanPopUp() {
    document.getElementById("popupBox").style.display = "block";
}

function tutupPopUp() {
    document.getElementById("popupBox").style.display = "none";
}

// Tutup pop-up jika klik di luar kotak
window.onclick = function(event) {
    const popup = document.getElementById("popupBox");
    if (event.target == popup) {
        popup.style.display = "none";
    }
}

// === FUNGSI HALAMAN SURAT IZIN ===
function validasiFrom() {
    var tglMulai = document.getElementById("tglMulai").value;
    var tglSelesai = document.getElementById("tglSelesai").value;
}
    if(new Date(tglSelesai) < new Date(tglMulai)) {
        alert('Tanggal Selesai Tidak Boleh Lebih Awal Lebih Dari Tanggal Mulai');
    }
    return true;