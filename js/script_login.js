// Mencari nilai tinggi pada layar pada saat mouse digrakan ke atas atau kebawah
$(".pesanMenu").show();
$(".portfolio .gambar").addClass("muncul");
$(window).scroll(function () {
  var wScroll = $(this).scrollTop();
  if (wScroll > $(".portfolio").offset().top - 100) {
    $(".portfolio .gambar").each(function (i) {
      setTimeout(function () {
        $(".portfolio .gambar").eq(i).addClass("muncul");
      }, 300 * (i + 1));
    });
  } else {
    $(".portfolio .gambar").removeClass("muncul");
  }
});
