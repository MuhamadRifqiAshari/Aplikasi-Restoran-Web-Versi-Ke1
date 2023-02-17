window.setTimeout("waktu()", 1000);
function waktu() {
  var tanggal = new Date();
  setTimeout("waktu()", 1000);
  document.getElementById("jamKunjung").innerHTML =
    tanggal.getHours() +
    ":" +
    tanggal.getMinutes() +
    ":" +
    tanggal.getSeconds();
}

$(document).ready(function () {
  $(".money").simpleMoneyFormat();

  $(document).on("keypress", ".angkaSemua", function (e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
      return false;
    }
  });

  setTimeout(function () {
    $(".alert").alert("close");
  }, 3000);
});

const notifikasi = $(".info-data").data("infodata");

if (
  notifikasi == "Disimpan" ||
  notifikasi == "Dihapus" ||
  notifikasi == "Diupdate"
) {
  Swal.fire({
    icon: "success",
    title: "Sukses",
    text: "Data Berhasil " + notifikasi,
  });
} else if (
  notifikasi == "Gagal Disimpan" ||
  notifikasi == "Gagal Dihapus" ||
  notifikasi == "Gagal Diupdate"
) {
  Swal.fire({
    icon: "error",
    title: "GAGAL",
    text: "Data " + notifikasi,
  });
} else if (notifikasi == "Kosong") {
  Swal.fire({
    icon: "error",
    title: "GAGAL",
    text: "Data " + notifikasi,
  });
}

$(".delete-data").on("click", function (e) {
  e.preventDefault();
  var getLink = $(this).attr("href");

  Swal.fire({
    title: "Hapus Data?",
    text: "Data akan dihapus permanen",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#008000",
    confirmButtonText: "Hapus",
  }).then((result) => {
    if (result.value) {
      window.location.href = getLink;
    }
  });
});
