function toggleMenu(){
  let menu = document.getElementById("menu");
  menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
}

document.addEventListener("DOMContentLoaded", function(){

  loadLaporan();
  loadAdmin();

  let form = document.getElementById("formKeluhan");

  if(form){
    form.addEventListener("submit", function(e){
      e.preventDefault();

      let formData = new FormData();
      formData.append("nama", document.getElementById("nama").value);
      formData.append("email", document.getElementById("email").value);
      formData.append("asal", document.getElementById("asal").value);
      formData.append("lokasi", document.getElementById("lokasi").value);
      formData.append("jenis", document.getElementById("jenis").value);
      formData.append("deskripsi", document.getElementById("deskripsi").value);
      formData.append("tanggal", document.getElementById("tanggal").value);

      fetch("simpan_laporan.php", {
        method: "POST",
        body: formData
      })
      .then(res => res.text())
      .then(data => {
        alert("Laporan berhasil dikirim!");
        form.reset();
        loadLaporan();
        loadAdmin();
      });
    });
  }

});

function loadLaporan(){
  fetch("ambil_laporan.php")
  .then(res => res.json())
  .then(data => {
    let container = document.getElementById("laporanContainer");

    if(container){
      container.innerHTML = "";

      data.forEach(l => {
        container.innerHTML += `
          <div class="laporan-card">
            <h3>${l.nama}</h3>
            <p><b>Lokasi:</b> ${l.lokasi}</p>
            <p><b>Jenis:</b> ${l.jenis}</p>
            <p>${l.deskripsi}</p>
            <p><b>Tanggal:</b> ${l.tanggal}</p>
            <p>Status: <b>${l.status}</b></p>
          </div>
        `;
      });
    }
  });
}

function loadAdmin(){
  fetch("ambil_laporan.php")
  .then(res => res.json())
  .then(data => {
    let table = document.getElementById("adminTable");

    if(table){
      table.innerHTML = "";

      data.forEach(l => {
        table.innerHTML += `
          <tr>
            <td>${l.nama}</td>
            <td>${l.lokasi}</td>
            <td>${l.jenis}</td>
            <td>${l.status}</td>
            <td>
              <button onclick="updateStatus(${l.id})">✔</button>
              <button onclick="hapusData(${l.id})">🗑</button>
            </td>
          </tr>
        `;
      });
    }
  });
}

function updateStatus(id){
  fetch("update_status.php?id=" + id)
  .then(() => {
    loadLaporan();
    loadAdmin();
  });
}

function hapusData(id){
  fetch("hapus_laporan.php?id=" + id)
  .then(() => {
    loadLaporan();
    loadAdmin();
  });
}
