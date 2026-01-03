function sum() {
    // Definisi variable point
    var A1;
    var A2;
    var A3;
    var A4;
    var A5;
    var A6;
    var A7;
    var A8;
    var A9;
    var A10;
    var A11;
    var A12;
    var A13;

    // Variable Point Tambahan
    var JumlahYangDihasilkanA11_5;
    var JumlahYangDihasilkanA12_3;
    var JumlahYangDihasilkanA12_4;
    var JumlahYangDihasilkanA12_5;

    // Cek Input Radio
    if ($("input[name='A1']:checked").val() != null) {
        A1 = document.querySelector('input[name="A1"]:checked').value;
    } else {
        A1 = 0;
    }
    if ($("input[name='A2']:checked").val() != null) {
        A2 = document.querySelector('input[name="A2"]:checked').value;
    } else {
        A2 = 0;
    }
    if ($("input[name='A3']:checked").val() != null) {
        A3 = document.querySelector('input[name="A3"]:checked').value;
    } else {
        A3 = 0;
    }
    if ($("input[name='A4']:checked").val() != null) {
        A4 = document.querySelector('input[name="A4"]:checked').value;
    } else {
        A4 = 0;
    }
    if ($("input[name='A5']:checked").val() != null) {
        A5 = document.querySelector('input[name="A5"]:checked').value;
    } else {
        A5 = 0;
    }
    if ($("input[name='A6']:checked").val() != null) {
        A6 = document.querySelector('input[name="A6"]:checked').value;
    } else {
        A6 = 0;
    }
    if ($("input[name='A7']:checked").val() != null) {
        A7 = document.querySelector('input[name="A7"]:checked').value;
    } else {
        A7 = 0;
    }
    if ($("input[name='A8']:checked").val() != null) {
        A8 = document.querySelector('input[name="A8"]:checked').value;
    } else {
        A8 = 0;
    }
    if ($("input[name='A9']:checked").val() != null) {
        A9 = document.querySelector('input[name="A9"]:checked').value;
    } else {
        A9 = 0;
    }
    if ($("input[name='A10']:checked").val() != null) {
        A10 = document.querySelector('input[name="A10"]:checked').value;
    } else {
        A10 = 0;
    }
    if ($("input[name='A11']:checked").val() != null) {
        A11 = document.querySelector('input[name="A11"]:checked').value;
    } else {
        A11 = 0;
    }
    // Point Tambahan
    // Cek Nilai atau inputan ada isi atau tidak
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanA11_5']").val() != "") {
        JumlahYangDihasilkanA11_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanA11_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanA11_5 = 0;
    }

    if ($("input[name='A12']:checked").val() != null) {
        A12 = document.querySelector('input[name="A12"]:checked').value;
    } else {
        A12 = 0;
    }
    // Point Tambahan
    // Cek Nilai atau inputan ada isi atau tidak
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanA12_3']").val() != "") {
        JumlahYangDihasilkanA12_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanA12_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanA12_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanA12_4']").val() != "") {
        JumlahYangDihasilkanA12_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanA12_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanA12_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanA12_5']").val() != "") {
        JumlahYangDihasilkanA12_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanA12_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanA12_5 = 0;
    }
    if ($("input[name='A13']:checked").val() != null) {
        A13 = document.querySelector('input[name="A13"]:checked').value;
    } else {
        A13 = 0;
    }

    //Kalkulasi Nilai (SKOR)
    var SkorA1 = parseInt(A1);
    var SkorA2 = parseInt(A2);
    var SkorA3 = parseInt(A3);
    var SkorA4 = parseInt(A4);
    var SkorA5 = parseInt(A5);
    var SkorA6 = parseInt(A6);
    var SkorA7 = parseInt(A7);
    var SkorA8 = parseInt(A8);
    var SkorA9 = parseInt(A9);
    var SkorA10 = parseInt(A10);
    var SkorA11 = parseInt(A11);
    // Point Tambahan
    // Merubah Kenilai Integer
    // Merubah nilai menjadi Int dan di jadikan variable
    var resultJumlahYangDihasilkanA11_5 = parseInt(JumlahYangDihasilkanA11_5);
    var SkorA12 = parseInt(A12);
    // Point Tambahan
    // Merubah Kenilai Integer
    // Merubah nilai menjadi Int dan di jadikan variable
    var resultJumlahYangDihasilkanA12_3 = parseInt(JumlahYangDihasilkanA12_3);
    var resultJumlahYangDihasilkanA12_4 = parseInt(JumlahYangDihasilkanA12_4);
    var resultJumlahYangDihasilkanA12_5 = parseInt(JumlahYangDihasilkanA12_5);
    var SkorA13 = parseInt(A13);

    //Kalkulasi Nilai (SKOR/SKOR MAKS)
    var skorMaksA1 = SkorA1 / 5;
    var skorMaksA2 = SkorA2 / 5;
    var skorMaksA3 = SkorA3 / 5;
    var skorMaksA4 = SkorA4 / 5;
    var skorMaksA5 = SkorA5 / 5;
    var skorMaksA6 = SkorA6 / 5;
    var skorMaksA7 = SkorA7 / 5;
    var skorMaksA8 = SkorA8 / 5;
    var skorMaksA9 = SkorA9 / 5 - 1;
    var skorMaksA10 = SkorA10 / 5;
    var skorMaksA11 = SkorA11 / 5;
    var skorMaksA12 = SkorA12 / 5;
    var skorMaksA13 = SkorA13 / 5;

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    var scorSubItemA1 = ((skorMaksA1 * 10) / 100).toFixed(3);

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA2 = num.toFixed(3);
    } else {
        var scorSubItemA2 = ((skorMaksA2 * 8) / 100).toFixed(3);
    }

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    var scorSubItemA3 = ((skorMaksA3 * 10) / 100).toFixed(3);

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A4']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA4 = num.toFixed(3);
    } else {
        var scorSubItemA4 = ((skorMaksA4 * 7.5) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A5']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA5 = num.toFixed(3);
    } else {
        var scorSubItemA5 = ((skorMaksA5 * 7.5) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A6']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA6 = num.toFixed(3);
    } else {
        var scorSubItemA6 = ((skorMaksA6 * 10) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A7']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA7 = num.toFixed(3);
    } else {
        var scorSubItemA7 = ((skorMaksA7 * 10) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A8']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA8 = num.toFixed(3);
    } else {
        var scorSubItemA8 = ((skorMaksA8 * 10) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A9']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA9 = num.toFixed(3);
    } else {
        var scorSubItemA9 = ((skorMaksA9 * 10) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A10']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA10 = num.toFixed(3);
    } else {
        var scorSubItemA10 = ((skorMaksA10 * 7) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A11']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA11 = num.toFixed(3);
    } else {
        var scorSubItemA11 = ((skorMaksA11 * 7) / 100).toFixed(3);
    }

    // Point Tambahan
    // jumlah input nilai akan di kalikan 3 atau sesuai rumus excel
    var resultDibagi3A11_5 = resultJumlahYangDihasilkanA11_5 * 3;

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A12']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA12 = num.toFixed(3);
    } else {
        var scorSubItemA12 = ((skorMaksA12 * 7) / 100).toFixed(3);
    }

    // Point Tambahan
    // jumlah input nilai akan di kalikan 3 atau sesuai rumus excel
    var resultDibagi05A12_3 = resultJumlahYangDihasilkanA12_3 * 0.5;
    var resultDibagi1A12_4 = resultJumlahYangDihasilkanA12_4 * 1;
    var resultDibagi3A12_5 = resultJumlahYangDihasilkanA12_5 * 3;

    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='A13']:checked").val() == 1) {
        var num = 0;
        var scorSubItemA13 = num.toFixed(3);
    } else {
        var scorSubItemA13 = ((skorMaksA13 * 10) / 100).toFixed(3);
    }

    // Point Tambahan
    // Menampilkan Nilai Di Form Interfaces
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDibagi3A11_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanA11_5").value = resultDibagi3A11_5;
        // Skor SUM A.11 kolom Bukti Pendukung
        document.getElementById("SkorTambahanJumlahA11_5").value =
            resultDibagi3A11_5;
    }

    // Menampilkan hasil di bagi di baris Skor Tambahan dari jumlah Point Tambahan A.12
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDibagi05A12_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanA12_3").value =
            resultDibagi05A12_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDibagi1A12_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanA12_4").value = resultDibagi1A12_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDibagi3A12_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanA12_5").value = resultDibagi3A12_5;
    }

    // SUM A.12 kolom Bukti Pendukung
    // SUM Skor Point A.12
    if (
        resultDibagi05A12_3 == "" ||
        resultDibagi1A12_4 == "" ||
        resultDibagi3A12_5 == ""
    ) {
        var sumResultA12 =
            resultDibagi05A12_3 + resultDibagi1A12_4 + resultDibagi3A12_5;
    } else {
        var sumResultA12 =
            resultDibagi05A12_3 + resultDibagi1A12_4 + resultDibagi3A12_5;
    }
    // Menampilkan Hasil SUM Point tambahan di kolom Bukti Pendukung A.12
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultA12)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahA12").value = sumResultA12;
    }

    // Point Tambahan
    // cwk nilai apakah nilai lebih dari 3, jika iya akan di bagi 3 jika tidak akan di bagi 0
    if (resultDibagi3A11_5 >= 3) {
        var numA11 = 3;
        var nilaiDibagi100A11_5 = (numA11 / 100).toFixed(3);
    } else if (resultDibagi3A11_5 <= 3) {
        var numA11 = 0;
        var nilaiDibagi100A11_5 = (numA11 / 100).toFixed(3);
    }
    if (sumResultA12 >= 3) {
        var numA12 = 3;
        var nilaiDibagi100A12_5 = (numA12 / 100).toFixed(3);
    } else if (sumResultA12 <= 3) {
        var numA12 = sumResultA12;
        var nilaiDibagi100A12_5 = (numA12 / 100).toFixed(3);
    }

    // Point tambahan di kolom SKOR
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numA11)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanA11_5").value = numA11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numA12)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanA12").value = numA12;
    }

    // Point tambahan di kolom SKOR X Bobot Sub Item
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100A11_5)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById(
            "JumlahSkorYangDiHasilkanBobotSubItemA11_5"
        ).value = nilaiDibagi100A11_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100A12_5)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorA12").value =
            nilaiDibagi100A12_5;
    }

    //Kalkulasi Nilai (SUM) Point tambahan
    var resultSumA11 =
        parseFloat(nilaiDibagi100A11_5) + parseFloat(scorSubItemA11);
    var resultSumA12 =
        parseFloat(nilaiDibagi100A12_5) + parseFloat(scorSubItemA12);

    // Merubah format nilai ke 0.000
    var resultSumtoFixedA11_5 = resultSumA11.toFixed(3);
    var resultSumtoFixedA12 = resultSumA12.toFixed(3);

    // Menampilkan hasil SUM Point Tambahan + Point Pokok
    if (!isNaN(resultSumtoFixedA11_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemA11_5").value =
            resultSumtoFixedA11_5;
    }
    if (!isNaN(resultSumtoFixedA12)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemA12").value =
            resultSumtoFixedA12;
    }

    // Pokok Point
    // Menampilkan nilai skor di form disabled
    if (!isNaN(SkorA1)) {
        // format Point merubah ( , ) menjadi ( . )
        // var resultScorSubItemA1 = scorSubItemA1.toFixed(3).replace(".", ".");

        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorA1").value = SkorA1;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA2)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA2").value = SkorA2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA3)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA3").value = SkorA3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA4)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA4").value = SkorA4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA5)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA5").value = SkorA5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA6)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA6").value = SkorA6;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA7)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA7").value = SkorA7;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA8)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA8").value = SkorA8;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA9)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA9").value = SkorA9;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA10)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA10").value = SkorA10;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA11)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA11").value = SkorA11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA12)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA12").value = SkorA12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(SkorA13)) {
        // Tampilkan output pada input form skor
        document.getElementById("scorA13").value = SkorA13;
    }

    // Menampilkan nilai skor / Skor Maks di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA1").value = skorMaksA1;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA2").value = skorMaksA2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA3").value = skorMaksA3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA4").value = skorMaksA4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA5)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA5").value = skorMaksA5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA6)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA6").value = skorMaksA6;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA7)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA7").value = skorMaksA7;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA8)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA8").value = skorMaksA8;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA9)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA9").value = skorMaksA9;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA10)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA10").value = skorMaksA10;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA11)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA11").value = skorMaksA11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA12)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA12").value = skorMaksA12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksA13)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxA13").value = skorMaksA13;
    }

    // Menampilkan nilai skor * Bpbpt Sub Item di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA1").value = scorSubItemA1;
    }

    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA2").value = scorSubItemA2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA3").value = scorSubItemA3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA4").value = scorSubItemA4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA5)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA5").value = scorSubItemA5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA6)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA6").value = scorSubItemA6;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA7)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA7").value = scorSubItemA7;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA8)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA8").value = scorSubItemA8;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA9)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA9").value = scorSubItemA9;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA10)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA10").value = scorSubItemA10;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA11)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA11").value = scorSubItemA11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA12)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA12").value = scorSubItemA12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemA13)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemA13").value = scorSubItemA13;
    }

    // Full total Point Tambahan dan Point Pokok
    // Perkalian Skor Kelebihan
    // A.11
    if (resultDibagi3A11_5 >= 3) {
        var ResultNilaiDiKurangi3 = resultDibagi3A11_5 - 3;
        var resultHasilTambahanA11 = (ResultNilaiDiKurangi3 * 3) / 100;
    } else {
        var resultHasilTambahanA11 = 0;
    }
    // A.12
    if (sumResultA12 >= 3) {
        var ResultNilaiDiKurangi3 = sumResultA12 - 3;
        var resultHasilTambahanA12 = (ResultNilaiDiKurangi3 * 3) / 100;
    } else {
        var resultHasilTambahanA12 = 0;
    }

    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahanA11)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihanA11").value =
            resultHasilTambahanA11;
    }
    if (!isNaN(resultHasilTambahanA12)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihanA12").value =
            resultHasilTambahanA12;
    }

    // SUM result total kelebihan skor
    if (resultHasilTambahanA11 == "" || resultHasilTambahanA12 == "") {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahanA11) +
            parseFloat(resultHasilTambahanA12);
    } else {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahanA11) +
            parseFloat(resultHasilTambahanA12);
    }

    // TotalKelebihanSkor
    if (!isNaN(resultTotalKelebihanSkor)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihanSkor").value =
            resultTotalKelebihanSkor;
    }
    // nilai tambah pendidikan dan pengajaran
    if (!isNaN(resultTotalKelebihanSkor)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiTambahPendidikanDanPengajaran").value =
            resultTotalKelebihanSkor;
    }

    if (
        scorSubItemA1 == "" ||
        scorSubItemA2 == "" ||
        scorSubItemA3 == "" ||
        scorSubItemA4 == "" ||
        scorSubItemA5 == "" ||
        scorSubItemA6 == "" ||
        scorSubItemA7 == "" ||
        scorSubItemA8 == "" ||
        scorSubItemA9 == "" ||
        scorSubItemA10 == "" ||
        resultSumtoFixedA11_5 == "" ||
        resultSumtoFixedA12 == "" ||
        scorSubItemA13 == ""
    ) {
        var sumTotal =
            parseFloat(scorSubItemA1) +
            parseFloat(scorSubItemA2) +
            parseFloat(scorSubItemA3) +
            parseFloat(scorSubItemA4) +
            parseFloat(scorSubItemA5) +
            parseFloat(scorSubItemA6) +
            parseFloat(scorSubItemA7) +
            parseFloat(scorSubItemA8) +
            parseFloat(scorSubItemA9) +
            parseFloat(scorSubItemA10) +
            parseFloat(resultSumtoFixedA11_5) +
            parseFloat(resultSumtoFixedA12) +
            parseFloat(scorSubItemA13);
        var sumResult = sumTotal.toFixed(3);
    } else {
        var sumTotal =
            parseFloat(scorSubItemA1) +
            parseFloat(scorSubItemA2) +
            parseFloat(scorSubItemA3) +
            parseFloat(scorSubItemA4) +
            parseFloat(scorSubItemA5) +
            parseFloat(scorSubItemA6) +
            parseFloat(scorSubItemA7) +
            parseFloat(scorSubItemA8) +
            parseFloat(scorSubItemA9) +
            parseFloat(scorSubItemA10) +
            parseFloat(resultSumtoFixedA11_5) +
            parseFloat(resultSumtoFixedA12) +
            parseFloat(scorSubItemA13);
        var sumResult = sumTotal.toFixed(3);
    }

    if (!isNaN(sumResult)) {
        // Tampilkan output pada input form
        document.getElementById("TotalSkorPendidikanPointA").value = sumResult;
    }

    var NilaiPendidikanDanPengajar = parseFloat(sumResult);
    var resultNilaiPendidikanDanPengajar = NilaiPendidikanDanPengajar * 35;
    // old interfaces
    // var resultPerkalianPendidikanDanPengajar =
    //     resultNilaiPendidikanDanPengajar.toFixed(2);

    if (!isNaN(resultNilaiPendidikanDanPengajar)) {
        // Tampilkan output pada input form
        document.getElementById("nilaiPendidikandanPengajaran").value =
            resultNilaiPendidikanDanPengajar;
    }

    // SUM result nilai pendidikan dan pengajaran + nilai tambah pendidikan dan pengajaran
    if (
        resultNilaiPendidikanDanPengajar == "" ||
        resultTotalKelebihanSkor == ""
    ) {
        var ResultTotalPendidikanDanPengajaran =
            parseFloat(resultNilaiPendidikanDanPengajar) +
            parseFloat(resultTotalKelebihanSkor);
    } else {
        var ResultTotalPendidikanDanPengajaran =
            parseFloat(resultNilaiPendidikanDanPengajar) +
            parseFloat(resultTotalKelebihanSkor);
    }

    if (ResultTotalPendidikanDanPengajaran > 40) {
        var num = 40;
        var NilaiTotalPendidikanDanPengajaran = num.toFixed(2);
    } else {
        var NilaiTotalPendidikanDanPengajaran =
            ResultTotalPendidikanDanPengajaran.toFixed(2);
    }

    if (!isNaN(NilaiTotalPendidikanDanPengajaran)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiTotalPendidikanDanPengajaran").value =
            NilaiTotalPendidikanDanPengajaran;
    }
}
