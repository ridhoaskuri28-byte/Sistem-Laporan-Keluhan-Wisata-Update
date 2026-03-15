function showPage(page){
  document.querySelectorAll(".page").forEach(p => p.classList.add("hidden"));
  document.getElementById(page).classList.remove("hidden");
}

let form = document.getElementById("formKeluhan");

form.addEventListener("submit", function(e){
  e.preventDefault();

  let laporan = {
    nama: document.getElementById("nama").value,
    email: document.getElementById("email").value,
    asal: document.getElementById("asal").value,
    lokasi: document.getElementById("lokasi").value,
    jenis: document.getElementById("jenis").value,
    deskripsi: document.getElementById("deskripsi").value,
    tanggal: document.getElementById("tanggal").value,
    status: "Diproses"
  };

  let data = JSON.parse(localStorage.getItem("laporan")) || [];
  data.push(laporan);

  localStorage.setItem("laporan", JSON.stringify(data));

  form.reset();

  tampilNotifikasi();
  tampilLaporan();
  tampilAdmin();
});

function tampilNotifikasi(){
  let notif = document.getElementById("notifikasi");
  notif.style.display = "block";

  setTimeout(()=>{
    notif.style.display = "none";
    showPage("daftar");
  },2000);
}

function tampilLaporan(){
  let data = JSON.parse(localStorage.getItem("laporan")) || [];
  let container = document.getElementById("laporanContainer");

  container.innerHTML = "";

  data.forEach(l=>{
    container.innerHTML += `
    <div class="laporan-card">
      <h3>${l.nama}</h3>
      <p><b>Lokasi:</b> ${l.lokasi}</p>
      <p><b>Jenis:</b> ${l.jenis}</p>
      <p>${l.deskripsi}</p>
      <p><b>Tanggal:</b> ${l.tanggal}</p>
      <p>Status: <span class="status ${l.status}">${l.status}</span></p>
    </div>
    `;
  });
}

function tampilAdmin(){
  let data = JSON.parse(localStorage.getItem("laporan")) || [];
  let table = document.getElementById("adminTable");

  table.innerHTML = "";

  data.forEach((l,i)=>{
    table.innerHTML += `
    <tr>
      <td>${l.nama}</td>
      <td>${l.lokasi}</td>
      <td>${l.jenis}</td>
      <td>${l.status}</td>
      <td>
        <button onclick="selesai(${i})">✔</button>
        <button onclick="hapus(${i})">🗑</button>
      </td>
    </tr>
    `;
  });
}

function selesai(index){
  let data = JSON.parse(localStorage.getItem("laporan"));

  data[index].status = "Selesai";
  localStorage.setItem("laporan", JSON.stringify(data));

  tampilLaporan();
  tampilAdmin();
}

function hapus(index){
  let data = JSON.parse(localStorage.getItem("laporan"));

  data.splice(index,1);
  localStorage.setItem("laporan", JSON.stringify(data));

  tampilLaporan();
  tampilAdmin();
}
document.addEventListener("DOMContentLoaded", function(){
tampilLaporan();
tampilAdmin();

let params = new URLSearchParams(window.location.search);
let page = params.get("page");

if(page){
  showPage(page);
}
});