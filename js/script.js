// About Otomatis muncul
// $(window).on("load", function () {
//   $(".pKiri").addClass("pMuncul");
//   $(".pKanan").addClass("pMuncul");
// });
// Belum login
$(".pesanMenu").hide();
$(".page-scroll").on("click", function (e) {
  // ambil isi href
  var tujuan = $(this).attr("href");
  // Tangkap elemen ... Tujuan
  var elementTujuan = $(tujuan);
  // Mengukur jarak ke paling atas
  // console.log(elementTujuan.offset().top);
  // Pakai body tidak bisa... pakai HTML
  // console.log($('html').scrollTop());

  // Menimbahkan ke posisi href berada. jika di klik
  // $('html').scrollTop(elementTujuan.offset().top);
  // Efek default bawaan jquey, swing dan linear

  $("html").animate(
    {
      scrollTop: elementTujuan.offset().top - 50,
    },
    2000,
    "easeOutBounce"
  );
  // preventDefault mematikan href
  e.preventDefault();
});

// Paralax -jumbotrin
// Mencari nilai tinggi pada layar pada saat mouse digrakan ke atas atau kebawah
$(window).scroll(function () {
  var wScroll = $(this).scrollTop();
  $(".jumbotron img").css({
    transform: "translate(0px, " + wScroll + "%)",
  });
  $(".jumbotron h1").css({
    transform: "translate(0px, " + wScroll + "%)",
  });
  $(".jumbotron p.kopi").css({
    transform: "translate(0px, " + wScroll / 10 + "%)",
  });

  // About
  if (wScroll > $(".about").offset().top - 200) {
    $(".pKiri").addClass("pMuncul");
    $(".pKanan").addClass("pMuncul");
  }

  //Portfolio
  if (wScroll > $(".portfolio").offset().top - 200) {
    $(".portfolio .gambar").each(function (i) {
      setTimeout(function () {
        $(".portfolio .gambar").eq(i).addClass("muncul");
      }, 300 * (i + 1));
    });
  } else {
    $(".portfolio .gambar").removeClass("muncul");
  }
  // console.log(wScroll);
});
