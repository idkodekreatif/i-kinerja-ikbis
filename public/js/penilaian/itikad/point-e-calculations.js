function sum() {
    // Definisi variable inputan
    var E1_1;
    var E1_2;
    var E1_3;
    var E1_4;
    var E1_5;
    var E1_6;
    var E2_1;
    var E2_2;
    var E2_3;
    var E2_4;

    // Cek Input Radio pokok point
    if ($("input[name='E1_1']:checked").val() != null) {
        E1_1 = document.querySelector('input[name="E1_1"]:checked').value;
    } else {
        E1_1 = 0;
    }
    if ($("input[name='E1_2']:checked").val() != null) {
        E1_2 = document.querySelector('input[name="E1_2"]:checked').value;
    } else {
        E1_2 = 0;
    }
    if ($("input[name='E1_3']:checked").val() != null) {
        E1_3 = document.querySelector('input[name="E1_3"]:checked').value;
    } else {
        E1_3 = 0;
    }
    if ($("input[name='E1_4']:checked").val() != null) {
        E1_4 = document.querySelector('input[name="E1_4"]:checked').value;
    } else {
        E1_4 = 0;
    }
    if ($("input[name='E1_5']:checked").val() != null) {
        E1_5 = document.querySelector('input[name="E1_5"]:checked').value;
    } else {
        E1_5 = 0;
    }
    if ($("input[name='E1_6']:checked").val() != null) {
        E1_6 = document.querySelector('input[name="E1_6"]:checked').value;
    } else {
        E1_6 = 0;
    }
    if ($("input[name='E2_1']:checked").val() != null) {
        E2_1 = document.querySelector('input[name="E2_1"]:checked').value;
    } else {
        E2_1 = 0;
    }
    if ($("input[name='E2_2']:checked").val() != null) {
        E2_2 = document.querySelector('input[name="E2_2"]:checked').value;
    } else {
        E2_2 = 0;
    }
    if ($("input[name='E2_3']:checked").val() != null) {
        E2_3 = document.querySelector('input[name="E2_3"]:checked').value;
    } else {
        E2_3 = 0;
    }
    if ($("input[name='E2_4']:checked").val() != null) {
        E2_4 = document.querySelector('input[name="E2_4"]:checked').value;
    } else {
        E2_4 = 0;
    }

    // Merubah nilai inputan ke integer Pokok point
    //Kalkulasi Nilai (SKOR)
    var SkorE1_1 = parseInt(E1_1);
    var SkorE1_2 = parseInt(E1_2);
    var SkorE1_3 = parseInt(E1_3);
    var SkorE1_4 = parseInt(E1_4);
    var SkorE1_5 = parseInt(E1_5);
    var SkorE1_6 = parseInt(E1_6);
    var SkorE2_1 = parseInt(E2_1);
    var SkorE2_2 = parseInt(E2_2);
    var SkorE2_3 = parseInt(E2_3);
    var SkorE2_4 = parseInt(E2_4);

    // Skor inputan nilai setelah di rubah ke integer di bagi 5
    //Kalkulasi Nilai (SKOR/SKOR MAKS)
    var skorMaksE1_1 = SkorE1_1 / 5;
    var skorMaksE1_2 = SkorE1_2 / 5;
    var skorMaksE1_3 = SkorE1_3 / 5;
    var skorMaksE1_4 = SkorE1_4 / 5;
    var skorMaksE1_5 = SkorE1_5 / 5;
    var skorMaksE1_6 = SkorE1_6 / 5;
    var skorMaksE2_1 = SkorE2_1 / 5;
    var skorMaksE2_2 = SkorE2_2 / 5;
    var skorMaksE2_3 = SkorE2_3 / 5;
    var skorMaksE2_4 = SkorE2_4 / 5;

    // nilai inputan setelah di bagi sekarang di kalikan sesuai rumus excel Pokok point
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='E1_1']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE1_1 = num.toFixed(3);
    } else {
        var scorSubItemE1_1 = ((skorMaksE1_1 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E1_2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE1_2 = num.toFixed(3);
    } else {
        var scorSubItemE1_2 = ((skorMaksE1_2 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E1_3']:checked").val() == 2) {
        var num = 0;
        var scorSubItemE1_3 = num.toFixed(3);
    } else {
        var scorSubItemE1_3 = ((skorMaksE1_3 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E1_4']:checked").val() == 2) {
        var num = 0;
        var scorSubItemE1_4 = num.toFixed(3);
    } else {
        var scorSubItemE1_4 = ((skorMaksE1_4 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E1_5']:checked").val() == 2) {
        var num = 0;
        var scorSubItemE1_5 = num.toFixed(3);
    } else {
        var scorSubItemE1_5 = ((skorMaksE1_5 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E1_6']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE1_6 = num.toFixed(3);
    } else {
        var scorSubItemE1_6 = ((skorMaksE1_6 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E2_1']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE2_1 = num.toFixed(3);
    } else {
        var scorSubItemE2_1 = ((skorMaksE2_1 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E2_2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE2_2 = num.toFixed(3);
    } else {
        var scorSubItemE2_2 = ((skorMaksE2_2 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E2_3']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE2_3 = num.toFixed(3);
    } else {
        var scorSubItemE2_3 = ((skorMaksE2_3 * 10) / 100).toFixed(3);
    }
    if ($("input[name='E2_4']:checked").val() == 1) {
        var num = 0;
        var scorSubItemE2_4 = num.toFixed(3);
    } else {
        var scorSubItemE2_4 = ((skorMaksE2_4 * 10) / 100).toFixed(3);
    }

    // Pokok point menampilkan hasil nilai di interfaces jumlah point point
    // Menampilkan nilai skor di form disabled
    if (!isNaN(SkorE1_1)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_1").value = SkorE1_1;
    }
    if (!isNaN(SkorE1_2)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_2").value = SkorE1_2;
    }
    if (!isNaN(SkorE1_3)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_3").value = SkorE1_3;
    }
    if (!isNaN(SkorE1_4)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_4").value = SkorE1_4;
    }
    if (!isNaN(SkorE1_5)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_5").value = SkorE1_5;
    }
    if (!isNaN(SkorE1_6)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE1_6").value = SkorE1_6;
    }
    if (!isNaN(SkorE2_1)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE2_1").value = SkorE2_1;
    }
    if (!isNaN(SkorE2_2)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE2_2").value = SkorE2_2;
    }
    if (!isNaN(SkorE2_3)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE2_3").value = SkorE2_3;
    }
    if (!isNaN(SkorE2_4)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorE2_4").value = SkorE2_4;
    }

    // Menampilkan nilai Pokok point skor / Skor Maks di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksE1_1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_1").value = skorMaksE1_1;
    }
    if (!isNaN(skorMaksE1_2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_2").value = skorMaksE1_2;
    }
    if (!isNaN(skorMaksE1_3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_3").value = skorMaksE1_3;
    }
    if (!isNaN(skorMaksE1_4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_4").value = skorMaksE1_4;
    }
    if (!isNaN(skorMaksE1_5)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_5").value = skorMaksE1_5;
    }
    if (!isNaN(skorMaksE1_6)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE1_6").value = skorMaksE1_6;
    }
    if (!isNaN(skorMaksE2_1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE2_1").value = skorMaksE2_1;
    }
    if (!isNaN(skorMaksE2_2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE2_2").value = skorMaksE2_2;
    }
    if (!isNaN(skorMaksE2_3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE2_3").value = skorMaksE2_3;
    }
    if (!isNaN(skorMaksE2_4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxE2_4").value = skorMaksE2_4;
    }

    // Menampilkan nilai Pokok point skor * Bpbpt Sub Item di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemE1_1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_1").value = scorSubItemE1_1;
    }
    if (!isNaN(scorSubItemE1_2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_2").value = scorSubItemE1_2;
    }
    if (!isNaN(scorSubItemE1_3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_3").value = scorSubItemE1_3;
    }
    if (!isNaN(scorSubItemE1_4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_4").value = scorSubItemE1_4;
    }
    if (!isNaN(scorSubItemE1_5)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_5").value = scorSubItemE1_5;
    }
    if (!isNaN(scorSubItemE1_6)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE1_6").value = scorSubItemE1_6;
    }
    if (!isNaN(scorSubItemE2_1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE2_1").value = scorSubItemE2_1;
    }
    if (!isNaN(scorSubItemE2_2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE2_2").value = scorSubItemE2_2;
    }
    if (!isNaN(scorSubItemE2_3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE2_3").value = scorSubItemE2_3;
    }
    if (!isNaN(scorSubItemE2_4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemE2_4").value = scorSubItemE2_4;
    }

    // SUM result total kelebihan skor
    if (
        scorSubItemE1_1 == "" ||
        scorSubItemE1_2 == "" ||
        scorSubItemE1_3 == "" ||
        scorSubItemE1_4 == "" ||
        scorSubItemE1_5 == "" ||
        scorSubItemE1_6 == "" ||
        scorSubItemE2_1 == "" ||
        scorSubItemE2_2 == "" ||
        scorSubItemE2_3 == "" ||
        scorSubItemE2_4 == ""
    ) {
        var resultTotalSkor =
            parseFloat(scorSubItemE1_1) +
            parseFloat(scorSubItemE1_2) +
            parseFloat(scorSubItemE1_3) +
            parseFloat(scorSubItemE1_4) +
            parseFloat(scorSubItemE1_5) +
            parseFloat(scorSubItemE1_6) +
            parseFloat(scorSubItemE2_1) +
            parseFloat(scorSubItemE2_2) +
            parseFloat(scorSubItemE2_3) +
            parseFloat(scorSubItemE2_4);
    } else {
        var resultTotalSkor =
            parseFloat(scorSubItemE1_1) +
            parseFloat(scorSubItemE1_2) +
            parseFloat(scorSubItemE1_3) +
            parseFloat(scorSubItemE1_4) +
            parseFloat(scorSubItemE1_5) +
            parseFloat(scorSubItemE1_6) +
            parseFloat(scorSubItemE2_1) +
            parseFloat(scorSubItemE2_2) +
            parseFloat(scorSubItemE2_3) +
            parseFloat(scorSubItemE2_4);
    }

    var resultHasilSumSkor = resultTotalSkor.toFixed(3);

    // TotalKelebihanSkor
    if (!isNaN(resultHasilSumSkor)) {
        // Tampilkan output pada input form
        document.getElementById("SumSkor").value = resultHasilSumSkor;
    }

    var ResultSumTotalSkor = parseFloat(resultHasilSumSkor);
    var ResultSumHasilPerkalian = ResultSumTotalSkor * 5.56;
    var TotalPerkalian = ResultSumHasilPerkalian.toFixed(2);

    // Hasil Nilai UnsurPenungjang * 20
    if (!isNaN(TotalPerkalian)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiUnsurPengabdian").value = TotalPerkalian;
    }
}
