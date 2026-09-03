function  tampilkanNama(){
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