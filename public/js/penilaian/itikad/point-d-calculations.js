function sum() {
    // Definisi variable inputan
    var D1;
    var D2;
    var D3;
    var D4;
    var D5;
    var D6;
    var D7;
    var D8;
    var D9;
    var D10;
    var D11;

    // Definisi Variable Point Tambahan
    var JumlahYangDihasilkanD2_2;
    var JumlahYangDihasilkanD2_3;
    var JumlahYangDihasilkanD2_4;
    var JumlahYangDihasilkanD2_5;
    var JumlahYangDihasilkanD3_2;
    var JumlahYangDihasilkanD3_3;
    var JumlahYangDihasilkanD3_4;
    var JumlahYangDihasilkanD3_5;
    var JumlahYangDihasilkanD4_3;
    var JumlahYangDihasilkanD4_4;
    var JumlahYangDihasilkanD4_5;
    var JumlahYangDihasilkanD5_3;
    var JumlahYangDihasilkanD5_4;
    var JumlahYangDihasilkanD5_5;
    var JumlahYangDihasilkanD6_2;
    var JumlahYangDihasilkanD6_3;
    var JumlahYangDihasilkanD6_4;
    var JumlahYangDihasilkanD6_5;
    var JumlahYangDihasilkanD7_5;
    var JumlahYangDihasilkanD8_3;
    var JumlahYangDihasilkanD8_4;
    var JumlahYangDihasilkanD8_5;
    var JumlahYangDihasilkanD9_2;
    var JumlahYangDihasilkanD9_3;
    var JumlahYangDihasilkanD9_4;
    var JumlahYangDihasilkanD9_5;
    var JumlahYangDihasilkanD10_3;
    var JumlahYangDihasilkanD10_4;
    var JumlahYangDihasilkanD10_5;
    var JumlahYangDihasilkanD11_3;
    var JumlahYangDihasilkanD11_4;
    var JumlahYangDihasilkanD11_5;

    // Cek Input Radio pokok point
    if ($("input[name='D1']:checked").val() != null) {
        D1 = document.querySelector('input[name="D1"]:checked').value;
    } else {
        D1 = 0;
    }
    if ($("input[name='D2']:checked").val() != null) {
        D2 = document.querySelector('input[name="D2"]:checked').value;
    } else {
        D2 = 0;
    }
    if ($("input[name='D3']:checked").val() != null) {
        D3 = document.querySelector('input[name="D3"]:checked').value;
    } else {
        D3 = 0;
    }
    if ($("input[name='D4']:checked").val() != null) {
        D4 = document.querySelector('input[name="D4"]:checked').value;
    } else {
        D4 = 0;
    }
    if ($("input[name='D5']:checked").val() != null) {
        D5 = document.querySelector('input[name="D5"]:checked').value;
    } else {
        D5 = 0;
    }
    if ($("input[name='D6']:checked").val() != null) {
        D6 = document.querySelector('input[name="D6"]:checked').value;
    } else {
        D6 = 0;
    }
    if ($("input[name='D7']:checked").val() != null) {
        D7 = document.querySelector('input[name="D7"]:checked').value;
    } else {
        D7 = 0;
    }
    if ($("input[name='D8']:checked").val() != null) {
        D8 = document.querySelector('input[name="D8"]:checked').value;
    } else {
        D8 = 0;
    }
    if ($("input[name='D9']:checked").val() != null) {
        D9 = document.querySelector('input[name="D9"]:checked').value;
    } else {
        D9 = 0;
    }
    if ($("input[name='D10']:checked").val() != null) {
        D10 = document.querySelector('input[name="D10"]:checked').value;
    } else {
        D10 = 0;
    }
    if ($("input[name='D11']:checked").val() != null) {
        D11 = document.querySelector('input[name="D11"]:checked').value;
    } else {
        D11 = 0;
    }

    // Merubah nilai inputan ke integer Pokok point
    //Kalkulasi Nilai (SKOR)
    var SkorD1 = parseInt(D1);
    var SkorD2 = parseInt(D2);
    var SkorD3 = parseInt(D3);
    var SkorD4 = parseInt(D4);
    var SkorD5 = parseInt(D5);
    var SkorD6 = parseInt(D6);
    var SkorD7 = parseInt(D7);
    var SkorD8 = parseInt(D8);
    var SkorD9 = parseInt(D9);
    var SkorD10 = parseInt(D10);
    var SkorD11 = parseInt(D11);

    // Skor inputan nilai setelah di rubah ke integer di bagi 5
    //Kalkulasi Nilai (SKOR/SKOR MAKS)
    var skorMaksD1 = SkorD1 / 5;
    var skorMaksD2 = SkorD2 / 5;
    var skorMaksD3 = SkorD3 / 5;
    var skorMaksD4 = SkorD4 / 5;
    var skorMaksD5 = SkorD5 / 5;
    var skorMaksD6 = SkorD6 / 5;
    var skorMaksD7 = SkorD7 / 5;
    var skorMaksD8 = SkorD8 / 5;
    var skorMaksD9 = SkorD9 / 5;
    var skorMaksD10 = SkorD10 / 5;
    var skorMaksD11 = SkorD11 / 5;

    // nilai inputan setelah di bagi sekarang di kalikan sesuai rumus excel Pokok point
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D1']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD1 = num.toFixed(3);
    } else {
        var scorSubItemD1 = ((skorMaksD1 * 10) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD2 = num.toFixed(3);
    } else {
        var scorSubItemD2 = ((skorMaksD2 * 8) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D3']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD3 = num.toFixed(3);
    } else {
        var scorSubItemD3 = ((skorMaksD3 * 6) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D4']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD4 = num.toFixed(3);
    } else {
        var scorSubItemD4 = ((skorMaksD4 * 8) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D5']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD5 = num.toFixed(3);
    } else {
        var scorSubItemD5 = ((skorMaksD5 * 6) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D6']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD6 = num.toFixed(3);
    } else {
        var scorSubItemD6 = ((skorMaksD6 * 8) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D7']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD7 = num.toFixed(3);
    } else {
        var scorSubItemD7 = ((skorMaksD7 * 8) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D8']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD8 = num.toFixed(3);
    } else {
        var scorSubItemD8 = ((skorMaksD8 * 7) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D9']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD9 = num.toFixed(3);
    } else {
        var scorSubItemD9 = ((skorMaksD9 * 7) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D10']:checked").val() == 1) {
        var num = 0;
        var scorSubItemD10 = num.toFixed(3);
    } else {
        var scorSubItemD10 = ((skorMaksD10 * 6) / 100).toFixed(3);
    }
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='D11']:checked").val() == 2) {
        var num = 0;
        var scorSubItemD11 = num.toFixed(3);
    } else {
        var scorSubItemD11 = ((skorMaksD11 * 6) / 100).toFixed(3);
    }

    // Pokok point menampilkan hasil nilai di interfaces jumlah point point
    // Menampilkan nilai skor di form disabled
    if (!isNaN(SkorD1)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD1").value = SkorD1;
    }
    if (!isNaN(SkorD2)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD2").value = SkorD2;
    }
    if (!isNaN(SkorD3)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD3").value = SkorD3;
    }
    if (!isNaN(SkorD4)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD4").value = SkorD4;
    }
    if (!isNaN(SkorD5)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD5").value = SkorD5;
    }
    if (!isNaN(SkorD6)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD6").value = SkorD6;
    }
    if (!isNaN(SkorD7)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD7").value = SkorD7;
    }
    if (!isNaN(SkorD8)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD8").value = SkorD8;
    }
    if (!isNaN(SkorD9)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD9").value = SkorD9;
    }
    if (!isNaN(SkorD10)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD10").value = SkorD10;
    }
    if (!isNaN(SkorD11)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorD11").value = SkorD11;
    }

    // Menampilkan nilai Pokok point skor / Skor Maks di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksD1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD1").value = skorMaksD1;
    }
    if (!isNaN(skorMaksD2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD2").value = skorMaksD2;
    }
    if (!isNaN(skorMaksD3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD3").value = skorMaksD3;
    }
    if (!isNaN(skorMaksD4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD4").value = skorMaksD4;
    }
    if (!isNaN(skorMaksD5)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD5").value = skorMaksD5;
    }
    if (!isNaN(skorMaksD6)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD6").value = skorMaksD6;
    }
    if (!isNaN(skorMaksD7)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD7").value = skorMaksD7;
    }
    if (!isNaN(skorMaksD8)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD8").value = skorMaksD8;
    }
    if (!isNaN(skorMaksD9)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD9").value = skorMaksD9;
    }
    if (!isNaN(skorMaksD10)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD10").value = skorMaksD10;
    }
    if (!isNaN(skorMaksD9)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD9").value = skorMaksD9;
    }
    if (!isNaN(skorMaksD11)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxD11").value = skorMaksD11;
    }

    // Menampilkan nilai Pokok point skor * Bpbpt Sub Item di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemD1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD1").value = scorSubItemD1;
    }
    if (!isNaN(scorSubItemD2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD2").value = scorSubItemD2;
    }
    if (!isNaN(scorSubItemD3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD3").value = scorSubItemD3;
    }
    if (!isNaN(scorSubItemD4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD4").value = scorSubItemD4;
    }
    if (!isNaN(scorSubItemD5)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD5").value = scorSubItemD5;
    }
    if (!isNaN(scorSubItemD6)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD6").value = scorSubItemD6;
    }
    if (!isNaN(scorSubItemD7)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD7").value = scorSubItemD7;
    }
    if (!isNaN(scorSubItemD8)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD8").value = scorSubItemD8;
    }
    if (!isNaN(scorSubItemD9)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD9").value = scorSubItemD9;
    }
    if (!isNaN(scorSubItemD10)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD10").value = scorSubItemD10;
    }
    if (!isNaN(scorSubItemD11)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemD11").value = scorSubItemD11;
    }

    // Cek nilai Inputan Point Tambahan
    // Cek Nilai atau inputan ada isi atau tidak
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD2_2']").val() != "") {
        JumlahYangDihasilkanD2_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanD2_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanD2_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD2_3']").val() != "") {
        JumlahYangDihasilkanD2_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD2_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD2_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD2_4']").val() != "") {
        JumlahYangDihasilkanD2_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD2_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD2_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD2_5']").val() != "") {
        JumlahYangDihasilkanD2_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD2_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD2_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD3_2']").val() != "") {
        JumlahYangDihasilkanD3_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanD3_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanD3_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD3_3']").val() != "") {
        JumlahYangDihasilkanD3_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD3_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD3_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD3_4']").val() != "") {
        JumlahYangDihasilkanD3_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD3_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD3_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD3_5']").val() != "") {
        JumlahYangDihasilkanD3_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD3_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD3_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD4_3']").val() != "") {
        JumlahYangDihasilkanD4_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD4_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD4_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD4_4']").val() != "") {
        JumlahYangDihasilkanD4_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD4_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD4_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD4_5']").val() != "") {
        JumlahYangDihasilkanD4_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD4_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD4_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD5_3']").val() != "") {
        JumlahYangDihasilkanD5_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD5_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD5_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD5_4']").val() != "") {
        JumlahYangDihasilkanD5_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD5_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD5_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD5_5']").val() != "") {
        JumlahYangDihasilkanD5_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD5_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD5_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD6_2']").val() != "") {
        JumlahYangDihasilkanD6_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanD6_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanD6_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD6_3']").val() != "") {
        JumlahYangDihasilkanD6_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD6_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD6_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD6_4']").val() != "") {
        JumlahYangDihasilkanD6_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD6_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD6_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD6_5']").val() != "") {
        JumlahYangDihasilkanD6_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD6_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD6_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD7_5']").val() != "") {
        JumlahYangDihasilkanD7_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD7_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD7_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD8_3']").val() != "") {
        JumlahYangDihasilkanD8_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD8_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD8_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD8_4']").val() != "") {
        JumlahYangDihasilkanD8_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD8_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD8_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD8_5']").val() != "") {
        JumlahYangDihasilkanD8_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD8_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD8_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD9_2']").val() != "") {
        JumlahYangDihasilkanD9_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanD9_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanD9_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD9_3']").val() != "") {
        JumlahYangDihasilkanD9_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD9_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD9_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD9_4']").val() != "") {
        JumlahYangDihasilkanD9_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD9_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD9_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD9_5']").val() != "") {
        JumlahYangDihasilkanD9_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD9_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD9_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD10_3']").val() != "") {
        JumlahYangDihasilkanD10_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD10_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD10_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD10_4']").val() != "") {
        JumlahYangDihasilkanD10_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD10_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD10_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD10_5']").val() != "") {
        JumlahYangDihasilkanD10_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD10_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD10_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD11_3']").val() != "") {
        JumlahYangDihasilkanD11_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanD11_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanD11_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD11_4']").val() != "") {
        JumlahYangDihasilkanD11_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanD11_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanD11_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanD11_5']").val() != "") {
        JumlahYangDihasilkanD11_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanD11_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanD11_5 = 0;
    }

    // Point Tambahan
    // Merubah Kenilai Integer
    // Merubah nilai menjadi Int dan di jadikan variable
    var resultJumlahYangDihasilkanD2_2 = parseInt(JumlahYangDihasilkanD2_2);
    var resultJumlahYangDihasilkanD2_3 = parseInt(JumlahYangDihasilkanD2_3);
    var resultJumlahYangDihasilkanD2_4 = parseInt(JumlahYangDihasilkanD2_4);
    var resultJumlahYangDihasilkanD2_5 = parseInt(JumlahYangDihasilkanD2_5);
    var resultJumlahYangDihasilkanD3_2 = parseInt(JumlahYangDihasilkanD3_2);
    var resultJumlahYangDihasilkanD3_3 = parseInt(JumlahYangDihasilkanD3_3);
    var resultJumlahYangDihasilkanD3_4 = parseInt(JumlahYangDihasilkanD3_4);
    var resultJumlahYangDihasilkanD3_5 = parseInt(JumlahYangDihasilkanD3_5);
    var resultJumlahYangDihasilkanD4_3 = parseInt(JumlahYangDihasilkanD4_3);
    var resultJumlahYangDihasilkanD4_4 = parseInt(JumlahYangDihasilkanD4_4);
    var resultJumlahYangDihasilkanD4_5 = parseInt(JumlahYangDihasilkanD4_5);
    var resultJumlahYangDihasilkanD5_3 = parseInt(JumlahYangDihasilkanD5_3);
    var resultJumlahYangDihasilkanD5_4 = parseInt(JumlahYangDihasilkanD5_4);
    var resultJumlahYangDihasilkanD5_5 = parseInt(JumlahYangDihasilkanD5_5);
    var resultJumlahYangDihasilkanD6_2 = parseInt(JumlahYangDihasilkanD6_2);
    var resultJumlahYangDihasilkanD6_3 = parseInt(JumlahYangDihasilkanD6_3);
    var resultJumlahYangDihasilkanD6_4 = parseInt(JumlahYangDihasilkanD6_4);
    var resultJumlahYangDihasilkanD6_5 = parseInt(JumlahYangDihasilkanD6_5);
    var resultJumlahYangDihasilkanD7_5 = parseInt(JumlahYangDihasilkanD7_5);
    var resultJumlahYangDihasilkanD8_3 = parseInt(JumlahYangDihasilkanD8_3);
    var resultJumlahYangDihasilkanD8_4 = parseInt(JumlahYangDihasilkanD8_4);
    var resultJumlahYangDihasilkanD8_5 = parseInt(JumlahYangDihasilkanD8_5);
    var resultJumlahYangDihasilkanD9_2 = parseInt(JumlahYangDihasilkanD9_2);
    var resultJumlahYangDihasilkanD9_3 = parseInt(JumlahYangDihasilkanD9_3);
    var resultJumlahYangDihasilkanD9_4 = parseInt(JumlahYangDihasilkanD9_4);
    var resultJumlahYangDihasilkanD9_5 = parseInt(JumlahYangDihasilkanD9_5);
    var resultJumlahYangDihasilkanD10_3 = parseInt(JumlahYangDihasilkanD10_3);
    var resultJumlahYangDihasilkanD10_4 = parseInt(JumlahYangDihasilkanD10_4);
    var resultJumlahYangDihasilkanD10_5 = parseInt(JumlahYangDihasilkanD10_5);
    var resultJumlahYangDihasilkanD11_3 = parseInt(JumlahYangDihasilkanD11_3);
    var resultJumlahYangDihasilkanD11_4 = parseInt(JumlahYangDihasilkanD11_4);
    var resultJumlahYangDihasilkanD11_5 = parseInt(JumlahYangDihasilkanD11_5);

    // Point Tambahan Hasil Integer dikalikan nilai sesuai di excel
    // jumlah input nilai akan di kalikan 3 atau sesuai rumus excel
    var resultDikalikanD2_2 = resultJumlahYangDihasilkanD2_2 * 0.5;
    var resultDikalikanD2_3 = resultJumlahYangDihasilkanD2_3 * 1;
    var resultDikalikanD2_4 = resultJumlahYangDihasilkanD2_4 * 1.5;
    var resultDikalikanD2_5 = resultJumlahYangDihasilkanD2_5 * 2;
    var resultDikalikanD3_2 = resultJumlahYangDihasilkanD3_2 * 0.5;
    var resultDikalikanD3_3 = resultJumlahYangDihasilkanD3_3 * 1;
    var resultDikalikanD3_4 = resultJumlahYangDihasilkanD3_4 * 1.5;
    var resultDikalikanD3_5 = resultJumlahYangDihasilkanD3_5 * 2;
    var resultDikalikanD4_3 = resultJumlahYangDihasilkanD4_3 * 1;
    var resultDikalikanD4_4 = resultJumlahYangDihasilkanD4_4 * 1.5;
    var resultDikalikanD4_5 = resultJumlahYangDihasilkanD4_5 * 2;
    var resultDikalikanD5_3 = resultJumlahYangDihasilkanD5_3 * 1;
    var resultDikalikanD5_4 = resultJumlahYangDihasilkanD5_4 * 1.5;
    var resultDikalikanD5_5 = resultJumlahYangDihasilkanD5_5 * 2;
    var resultDikalikanD6_2 = resultJumlahYangDihasilkanD6_2 * 0.5;
    var resultDikalikanD6_3 = resultJumlahYangDihasilkanD6_3 * 1;
    var resultDikalikanD6_4 = resultJumlahYangDihasilkanD6_4 * 1.5;
    var resultDikalikanD6_5 = resultJumlahYangDihasilkanD6_5 * 2;
    var resultDikalikanD7_5 = resultJumlahYangDihasilkanD7_5 * 2;
    var resultDikalikanD8_3 = resultJumlahYangDihasilkanD8_3 * 1;
    var resultDikalikanD8_4 = resultJumlahYangDihasilkanD8_4 * 1.5;
    var resultDikalikanD8_5 = resultJumlahYangDihasilkanD8_5 * 2;
    var resultDikalikanD9_2 = resultJumlahYangDihasilkanD9_2 * 0.5;
    var resultDikalikanD9_3 = resultJumlahYangDihasilkanD9_3 * 1;
    var resultDikalikanD9_4 = resultJumlahYangDihasilkanD9_4 * 1.5;
    var resultDikalikanD9_5 = resultJumlahYangDihasilkanD9_5 * 2;
    var resultDikalikanD10_3 = resultJumlahYangDihasilkanD10_3 * 1;
    var resultDikalikanD10_4 = resultJumlahYangDihasilkanD10_4 * 1.5;
    var resultDikalikanD10_5 = resultJumlahYangDihasilkanD10_5 * 2;
    var resultDikalikanD11_3 = resultJumlahYangDihasilkanD11_3 * 1;
    var resultDikalikanD11_4 = resultJumlahYangDihasilkanD11_4 * 1.5;
    var resultDikalikanD11_5 = resultJumlahYangDihasilkanD11_5 * 2;

    // Menampilkan hasil di kalikan di baris Skor Tambahan dari jumlah Point Tambahan C.1
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD2_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD2_2").value = resultDikalikanD2_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD2_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD2_3").value = resultDikalikanD2_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD2_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD2_4").value = resultDikalikanD2_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD2_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD2_5").value = resultDikalikanD2_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD3_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD3_2").value = resultDikalikanD3_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD3_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD3_3").value = resultDikalikanD3_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD3_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD3_4").value = resultDikalikanD3_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD3_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD3_5").value = resultDikalikanD3_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD4_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD4_3").value = resultDikalikanD4_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD4_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD4_4").value = resultDikalikanD4_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD4_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD4_5").value = resultDikalikanD4_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD5_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD5_3").value = resultDikalikanD5_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD5_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD5_4").value = resultDikalikanD5_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD5_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD5_5").value = resultDikalikanD5_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD6_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD6_2").value = resultDikalikanD6_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD6_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD6_3").value = resultDikalikanD6_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD6_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD6_4").value = resultDikalikanD6_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD6_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD6_5").value = resultDikalikanD6_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD7_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD7_5").value = resultDikalikanD7_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD8_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD8_3").value = resultDikalikanD8_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD8_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD8_4").value = resultDikalikanD8_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD8_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD8_5").value = resultDikalikanD8_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD9_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD9_2").value = resultDikalikanD9_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD9_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD9_3").value = resultDikalikanD9_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD9_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD9_4").value = resultDikalikanD9_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD9_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD9_5").value = resultDikalikanD9_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD10_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD10_3").value =
            resultDikalikanD10_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD10_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD10_4").value =
            resultDikalikanD10_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD10_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD10_5").value =
            resultDikalikanD10_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD11_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD11_3").value =
            resultDikalikanD11_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD11_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD11_4").value =
            resultDikalikanD11_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanD11_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanD11_5").value =
            resultDikalikanD11_5;
    }

    // SUM D.2 kolom Bukti Pendukung
    // SUM Skor Point D.2
    if (
        resultDikalikanD2_2 == "" ||
        resultDikalikanD2_3 == "" ||
        resultDikalikanD2_4 == "" ||
        resultDikalikanD2_5 == ""
    ) {
        var sumResultD2 =
            resultDikalikanD2_2 +
            resultDikalikanD2_3 +
            resultDikalikanD2_4 +
            resultDikalikanD2_5;
    } else {
        var sumResultD2 =
            resultDikalikanD2_2 +
            resultDikalikanD2_3 +
            resultDikalikanD2_4 +
            resultDikalikanD2_5;
    }
    // SUM Skor Point D.3
    if (
        resultDikalikanD3_2 == "" ||
        resultDikalikanD3_3 == "" ||
        resultDikalikanD3_4 == "" ||
        resultDikalikanD3_5 == ""
    ) {
        var sumResultD3 =
            resultDikalikanD3_2 +
            resultDikalikanD3_3 +
            resultDikalikanD3_4 +
            resultDikalikanD3_5;
    } else {
        var sumResultD3 =
            resultDikalikanD3_2 +
            resultDikalikanD3_3 +
            resultDikalikanD3_4 +
            resultDikalikanD3_5;
    }
    // SUM Skor Point D.4
    if (
        resultDikalikanD4_3 == "" ||
        resultDikalikanD4_4 == "" ||
        resultDikalikanD4_5 == ""
    ) {
        var sumResultD4 =
            resultDikalikanD4_3 + resultDikalikanD4_4 + resultDikalikanD4_5;
    } else {
        var sumResultD4 =
            resultDikalikanD4_3 + resultDikalikanD4_4 + resultDikalikanD4_5;
    }
    // SUM Skor Point D.5
    if (
        resultDikalikanD5_3 == "" ||
        resultDikalikanD5_4 == "" ||
        resultDikalikanD5_5 == ""
    ) {
        var sumResultD5 =
            resultDikalikanD5_3 + resultDikalikanD5_4 + resultDikalikanD5_5;
    } else {
        var sumResultD5 =
            resultDikalikanD5_3 + resultDikalikanD5_4 + resultDikalikanD5_5;
    }
    // SUM Skor Point D.6
    if (
        resultDikalikanD6_2 == "" ||
        resultDikalikanD6_3 == "" ||
        resultDikalikanD6_4 == "" ||
        resultDikalikanD6_5 == ""
    ) {
        var sumResultD6 =
            resultDikalikanD6_2 +
            resultDikalikanD6_3 +
            resultDikalikanD6_4 +
            resultDikalikanD6_5;
    } else {
        var sumResultD6 =
            resultDikalikanD6_2 +
            resultDikalikanD6_3 +
            resultDikalikanD6_4 +
            resultDikalikanD6_5;
    }
    // SUM Skor Point D.7
    if (resultDikalikanD7_5 == "") {
        var sumResultD7 = resultDikalikanD7_5;
    } else {
        var sumResultD7 = resultDikalikanD7_5;
    }
    // SUM Skor Point D.8
    if (
        resultDikalikanD8_3 == "" ||
        resultDikalikanD8_4 == "" ||
        resultDikalikanD8_5 == ""
    ) {
        var sumResultD8 =
            resultDikalikanD8_3 + resultDikalikanD8_4 + resultDikalikanD8_5;
    } else {
        var sumResultD8 =
            resultDikalikanD8_3 + resultDikalikanD8_4 + resultDikalikanD8_5;
    }
    // SUM Skor Point D.9
    if (
        resultDikalikanD9_2 == "" ||
        resultDikalikanD9_3 == "" ||
        resultDikalikanD9_4 == "" ||
        resultDikalikanD9_5 == ""
    ) {
        var sumResultD9 =
            resultDikalikanD9_2 +
            resultDikalikanD9_3 +
            resultDikalikanD9_4 +
            resultDikalikanD9_5;
    } else {
        var sumResultD9 =
            resultDikalikanD9_2 +
            resultDikalikanD9_3 +
            resultDikalikanD9_4 +
            resultDikalikanD9_5;
    }
    // SUM Skor Point D.10
    if (
        resultDikalikanD10_3 == "" ||
        resultDikalikanD10_4 == "" ||
        resultDikalikanD10_5 == ""
    ) {
        var sumResultD10 =
            resultDikalikanD10_3 + resultDikalikanD10_4 + resultDikalikanD10_5;
    } else {
        var sumResultD10 =
            resultDikalikanD10_3 + resultDikalikanD10_4 + resultDikalikanD10_5;
    }
    // SUM Skor Point D.11
    if (
        resultDikalikanD11_3 == "" ||
        resultDikalikanD11_4 == "" ||
        resultDikalikanD11_5 == ""
    ) {
        var sumResultD11 =
            resultDikalikanD11_3 + resultDikalikanD11_4 + resultDikalikanD11_5;
    } else {
        var sumResultD11 =
            resultDikalikanD11_3 + resultDikalikanD11_4 + resultDikalikanD11_5;
    }

    // Point Tambahan
    // cwk nilai apakah nilai lebih dari samadengan, jika iya akan di bagi sesuai di excel jika tidak akan di bagi 0
    // D.2
    if (sumResultD2 >= 2) {
        var numD2 = 2;
        var nilaiDibagi100D2 = (numD2 / 100).toFixed(3);
    } else if (sumResultD2 <= 2) {
        var numD2 = sumResultD2;
        var nilaiDibagi100D2 = (numD2 / 100).toFixed(3);
    }
    // D.3
    if (sumResultD3 >= 4) {
        var numD3 = 4;
        var nilaiDibagi100D3 = (numD3 / 100).toFixed(3);
    } else if (sumResultD3 <= 4) {
        var numD3 = sumResultD3;
        var nilaiDibagi100D3 = (numD3 / 100).toFixed(3);
    }
    // D.4
    if (sumResultD4 >= 2) {
        var numD4 = 2;
        var nilaiDibagi100D4 = (numD4 / 100).toFixed(3);
    } else if (sumResultD4 <= 2) {
        var numD4 = sumResultD4;
        var nilaiDibagi100D4 = (numD4 / 100).toFixed(3);
    }
    // D.5
    if (sumResultD5 >= 2) {
        var numD5 = 2;
        var nilaiDibagi100D5 = (numD5 / 100).toFixed(3);
    } else if (sumResultD5 <= 2) {
        var numD5 = sumResultD5;
        var nilaiDibagi100D5 = (numD5 / 100).toFixed(3);
    }
    // D.6
    if (sumResultD6 >= 2) {
        var numD6 = 2;
        var nilaiDibagi100D6 = (numD6 / 100).toFixed(3);
    } else if (sumResultD6 <= 2) {
        var numD6 = sumResultD6;
        var nilaiDibagi100D6 = (numD6 / 100).toFixed(3);
    }
    // D.7
    if (sumResultD7 >= 2) {
        var numD7 = 2;
        var nilaiDibagi100D7 = (numD7 / 100).toFixed(3);
    } else if (sumResultD7 <= 2) {
        var numD7 = sumResultD7;
        var nilaiDibagi100D7 = (numD7 / 100).toFixed(3);
    }
    // D.8
    if (sumResultD8 >= 2) {
        var numD8 = 2;
        var nilaiDibagi100D8 = (numD8 / 100).toFixed(3);
    } else if (sumResultD8 <= 2) {
        var numD8 = sumResultD8;
        var nilaiDibagi100D8 = (numD8 / 100).toFixed(3);
    }
    // D.6
    if (sumResultD9 >= 2) {
        var numD9 = 2;
        var nilaiDibagi100D9 = (numD9 / 100).toFixed(3);
    } else if (sumResultD9 <= 2) {
        var numD9 = sumResultD9;
        var nilaiDibagi100D9 = (numD9 / 100).toFixed(3);
    }
    // D.10
    if (sumResultD10 >= 2) {
        var numD10 = 2;
        var nilaiDibagi100D10 = (numD10 / 100).toFixed(3);
    } else if (sumResultD10 <= 2) {
        var numD10 = sumResultD10;
        var nilaiDibagi100D10 = (numD10 / 100).toFixed(3);
    }
    // D.11
    if (sumResultD11 >= 2) {
        var numD11 = 2;
        var nilaiDibagi100D11 = (numD11 / 100).toFixed(3);
    } else if (sumResultD11 <= 2) {
        var numD11 = sumResultD11;
        var nilaiDibagi100D11 = (numD11 / 100).toFixed(3);
    }

    //Kalkulasi Nilai (SUM) Point tambahan dan Point Pokok
    var resultSumD2 = parseFloat(nilaiDibagi100D2) + parseFloat(scorSubItemD2);
    var resultSumD3 = parseFloat(nilaiDibagi100D3) + parseFloat(scorSubItemD3);
    var resultSumD4 = parseFloat(nilaiDibagi100D4) + parseFloat(scorSubItemD4);
    var resultSumD5 = parseFloat(nilaiDibagi100D5) + parseFloat(scorSubItemD5);
    var resultSumD6 = parseFloat(nilaiDibagi100D6) + parseFloat(scorSubItemD6);
    var resultSumD7 = parseFloat(nilaiDibagi100D7) + parseFloat(scorSubItemD7);
    var resultSumD8 = parseFloat(nilaiDibagi100D8) + parseFloat(scorSubItemD8);
    var resultSumD9 = parseFloat(nilaiDibagi100D9) + parseFloat(scorSubItemD9);
    var resultSumD10 =
        parseFloat(nilaiDibagi100D10) + parseFloat(scorSubItemD10);
    var resultSumD11 =
        parseFloat(nilaiDibagi100D11) + parseFloat(scorSubItemD11);

    // Merubah format nilai ke 0.000
    var resultSumtoFixedD2 = resultSumD2.toFixed(3);
    var resultSumtoFixedD3 = resultSumD3.toFixed(3);
    var resultSumtoFixedD4 = resultSumD4.toFixed(3);
    var resultSumtoFixedD5 = resultSumD5.toFixed(3);
    var resultSumtoFixedD6 = resultSumD6.toFixed(3);
    var resultSumtoFixedD7 = resultSumD7.toFixed(3);
    var resultSumtoFixedD8 = resultSumD8.toFixed(3);
    var resultSumtoFixedD9 = resultSumD9.toFixed(3);
    var resultSumtoFixedD10 = resultSumD10.toFixed(3);
    var resultSumtoFixedD11 = resultSumD11.toFixed(3);

    // Point Tambahan menampilkan hasil di interfaces skor/skor maks
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numD2)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD2").value = numD2;
    }
    if (!isNaN(numD3)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD3").value = numD3;
    }
    if (!isNaN(numD4)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD4").value = numD4;
    }
    if (!isNaN(numD5)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD5").value = numD5;
    }
    if (!isNaN(numD6)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD6").value = numD6;
    }
    if (!isNaN(numD7)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD7").value = numD7;
    }
    if (!isNaN(numD8)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD8").value = numD8;
    }
    if (!isNaN(numD9)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD9").value = numD9;
    }
    if (!isNaN(numD10)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD10").value = numD10;
    }
    if (!isNaN(numD11)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanD11").value = numD11;
    }

    // Point Tambahan intefaces Skor X Bobot sub item
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100D2)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD2").value =
            nilaiDibagi100D2;
    }
    if (!isNaN(nilaiDibagi100D3)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD3").value =
            nilaiDibagi100D3;
    }
    if (!isNaN(nilaiDibagi100D4)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD4").value =
            nilaiDibagi100D4;
    }
    if (!isNaN(nilaiDibagi100D5)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD5").value =
            nilaiDibagi100D5;
    }
    if (!isNaN(nilaiDibagi100D6)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD6").value =
            nilaiDibagi100D6;
    }
    if (!isNaN(nilaiDibagi100D7)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD7").value =
            nilaiDibagi100D7;
    }
    if (!isNaN(nilaiDibagi100D8)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD8").value =
            nilaiDibagi100D8;
    }
    if (!isNaN(nilaiDibagi100D9)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD9").value =
            nilaiDibagi100D9;
    }
    if (!isNaN(nilaiDibagi100D10)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD10").value =
            nilaiDibagi100D10;
    }
    if (!isNaN(nilaiDibagi100D11)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorD11").value =
            nilaiDibagi100D11;
    }

    // Result SUM Pokok Point + Point Tambahan dan di tampilkan di kolom skor X Bobot sub item baris Skor tambahan dari jumlah
    if (!isNaN(resultSumtoFixedD2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD2").value =
            resultSumtoFixedD2;
    }
    if (!isNaN(resultSumtoFixedD3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD3").value =
            resultSumtoFixedD3;
    }
    if (!isNaN(resultSumtoFixedD4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD4").value =
            resultSumtoFixedD4;
    }
    if (!isNaN(resultSumtoFixedD5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD5").value =
            resultSumtoFixedD5;
    }
    if (!isNaN(resultSumtoFixedD6)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD6").value =
            resultSumtoFixedD6;
    }
    if (!isNaN(resultSumtoFixedD7)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD7").value =
            resultSumtoFixedD7;
    }
    if (!isNaN(resultSumtoFixedD8)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD8").value =
            resultSumtoFixedD8;
    }
    if (!isNaN(resultSumtoFixedD9)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD9").value =
            resultSumtoFixedD9;
    }
    if (!isNaN(resultSumtoFixedD10)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD10").value =
            resultSumtoFixedD10;
    }
    if (!isNaN(resultSumtoFixedD11)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemD11").value =
            resultSumtoFixedD11;
    }

    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultD2)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD2").value = sumResultD2;
    }
    if (!isNaN(sumResultD3)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD3").value = sumResultD3;
    }
    if (!isNaN(sumResultD4)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD4").value = sumResultD4;
    }
    if (!isNaN(sumResultD5)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD5").value = sumResultD5;
    }
    if (!isNaN(sumResultD6)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD6").value = sumResultD6;
    }
    if (!isNaN(sumResultD7)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD7").value = sumResultD7;
    }
    if (!isNaN(sumResultD8)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD8").value = sumResultD8;
    }
    if (!isNaN(sumResultD9)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD9").value = sumResultD9;
    }
    if (!isNaN(sumResultD10)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD10").value = sumResultD10;
    }
    if (!isNaN(sumResultD11)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahD11").value = sumResultD11;
    }

    // SUM TOTAL POINT
    if (
        scorSubItemD1 == "" ||
        resultSumtoFixedD2 == "" ||
        resultSumtoFixedD3 == "" ||
        resultSumtoFixedD4 == "" ||
        resultSumtoFixedD5 == "" ||
        resultSumtoFixedD6 == "" ||
        resultSumtoFixedD7 == "" ||
        resultSumtoFixedD8 == "" ||
        resultSumtoFixedD9 == "" ||
        resultSumtoFixedD10 == "" ||
        resultSumtoFixedD11 == ""
    ) {
        var sumTotal =
            parseFloat(scorSubItemD1) +
            parseFloat(resultSumtoFixedD2) +
            parseFloat(resultSumtoFixedD3) +
            parseFloat(resultSumtoFixedD4) +
            parseFloat(resultSumtoFixedD5) +
            parseFloat(resultSumtoFixedD6) +
            parseFloat(resultSumtoFixedD7) +
            parseFloat(resultSumtoFixedD8) +
            parseFloat(resultSumtoFixedD9) +
            parseFloat(resultSumtoFixedD10) +
            parseFloat(resultSumtoFixedD11);
        var sumResult = sumTotal.toFixed(3);
    } else {
        var sumTotal =
            parseFloat(scorSubItemD1) +
            parseFloat(resultSumtoFixedD2) +
            parseFloat(resultSumtoFixedD3) +
            parseFloat(resultSumtoFixedD4) +
            parseFloat(resultSumtoFixedD5) +
            parseFloat(resultSumtoFixedD6) +
            parseFloat(resultSumtoFixedD7) +
            parseFloat(resultSumtoFixedD8) +
            parseFloat(resultSumtoFixedD9) +
            parseFloat(resultSumtoFixedD10) +
            parseFloat(resultSumtoFixedD11);
        var sumResult = sumTotal.toFixed(3);
    }

    // / Menampilkan hasil SUM TOTAL Point
    if (!isNaN(sumResult)) {
        // Tampilkan output pada input form
        document.getElementById("TotalSkorUnsurPenunjang").value = sumResult;
    }

    var NilaiUnsurPenunjang = parseFloat(sumResult);
    var UnsurPenungjang = NilaiUnsurPenunjang * 10;
    var ResultNilaiUnsurPenunjang = UnsurPenungjang.toFixed(2);

    // Hasil Nilai UnsurPenungjang * 20
    if (!isNaN(ResultNilaiUnsurPenunjang)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiUnsurPenunjang").value =
            ResultNilaiUnsurPenunjang;
    }

    // Perkalian Skor Kelebihan
    // D.2
    if (sumResultD2 >= 2) {
        var ResultNilaiDiKurangiD2 = sumResultD2 - 2;
        var resultHasilTambahaD2 = (ResultNilaiDiKurangiD2 * 2) / 100;
    } else {
        var resultHasilTambahaD2 = 0;
    }
    // D.3
    if (sumResultD3 >= 2) {
        var ResultNilaiDiKurangiD3 = sumResultD3 - 2;
        var resultHasilTambahaD3 = (ResultNilaiDiKurangiD3 * 2) / 100;
    } else {
        var resultHasilTambahaD3 = 0;
    }
    // D.4
    if (sumResultD4 >= 2) {
        var ResultNilaiDiKurangiD4 = sumResultD4 - 2;
        var resultHasilTambahaD4 = (ResultNilaiDiKurangiD4 * 2) / 100;
    } else {
        var resultHasilTambahaD4 = 0;
    }
    // D.5
    if (sumResultD5 >= 2) {
        var ResultNilaiDiKurangiD5 = sumResultD5 - 2;
        var resultHasilTambahaD5 = (ResultNilaiDiKurangiD5 * 2) / 100;
    } else {
        var resultHasilTambahaD5 = 0;
    }
    // D.6
    if (sumResultD6 >= 2) {
        var ResultNilaiDiKurangiD6 = sumResultD6 - 2;
        var resultHasilTambahaD6 = (ResultNilaiDiKurangiD6 * 2) / 100;
    } else {
        var resultHasilTambahaD6 = 0;
    }
    // D.7
    if (sumResultD7 >= 2) {
        var ResultNilaiDiKurangiD7 = sumResultD7 - 2;
        var resultHasilTambahaD7 = (ResultNilaiDiKurangiD7 * 2) / 100;
    } else {
        var resultHasilTambahaD7 = 0;
    }
    // D.8
    if (sumResultD8 >= 2) {
        var ResultNilaiDiKurangiD8 = sumResultD8 - 2;
        var resultHasilTambahaD8 = (ResultNilaiDiKurangiD8 * 2) / 100;
    } else {
        var resultHasilTambahaD8 = 0;
    }
    // D.9
    if (sumResultD9 >= 2) {
        var ResultNilaiDiKurangiD9 = sumResultD9 - 2;
        var resultHasilTambahaD9 = (ResultNilaiDiKurangiD9 * 2) / 100;
    } else {
        var resultHasilTambahaD9 = 0;
    }
    // D.10
    if (sumResultD10 >= 2) {
        var ResultNilaiDiKurangiD10 = sumResultD10 - 2;
        var resultHasilTambahaD10 = (ResultNilaiDiKurangiD10 * 2) / 100;
    } else {
        var resultHasilTambahaD10 = 0;
    }
    // D.11
    if (sumResultD11 >= 2) {
        var ResultNilaiDiKurangiD11 = sumResultD11 - 2;
        var resultHasilTambahaD11 = (ResultNilaiDiKurangiD11 * 2) / 100;
    } else {
        var resultHasilTambahaD11 = 0;
    }

    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD2)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD2").value = resultHasilTambahaD2;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD3)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD3").value = resultHasilTambahaD3;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD4)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD4").value = resultHasilTambahaD4;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD5)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD5").value = resultHasilTambahaD5;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD6)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD6").value = resultHasilTambahaD6;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD7)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD7").value = resultHasilTambahaD7;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD8)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD8").value = resultHasilTambahaD8;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD9)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD9").value = resultHasilTambahaD9;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD10)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD10").value =
            resultHasilTambahaD10;
    }
    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaD11)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaD11").value =
            resultHasilTambahaD11;
    }

    // SUM result total kelebihan skor
    if (
        resultHasilTambahaD2 == "" ||
        resultHasilTambahaD3 == "" ||
        resultHasilTambahaD4 == "" ||
        resultHasilTambahaD5 == "" ||
        resultHasilTambahaD6 == "" ||
        resultHasilTambahaD7 == "" ||
        resultHasilTambahaD8 == "" ||
        resultHasilTambahaD9 == "" ||
        resultHasilTambahaD10 == "" ||
        resultHasilTambahaD11 == ""
    ) {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaD2) +
            parseFloat(resultHasilTambahaD3) +
            parseFloat(resultHasilTambahaD4) +
            parseFloat(resultHasilTambahaD5) +
            parseFloat(resultHasilTambahaD6) +
            parseFloat(resultHasilTambahaD7) +
            parseFloat(resultHasilTambahaD8) +
            parseFloat(resultHasilTambahaD9) +
            parseFloat(resultHasilTambahaD10) +
            parseFloat(resultHasilTambahaD11);
    } else {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaD2) +
            parseFloat(resultHasilTambahaD3) +
            parseFloat(resultHasilTambahaD4) +
            parseFloat(resultHasilTambahaD5) +
            parseFloat(resultHasilTambahaD6) +
            parseFloat(resultHasilTambahaD7) +
            parseFloat(resultHasilTambahaD8) +
            parseFloat(resultHasilTambahaD9) +
            parseFloat(resultHasilTambahaD10) +
            parseFloat(resultHasilTambahaD11);
    }

    var resultHasilSumKelebihanSkor = resultTotalKelebihanSkor;

    // TotalKelebihanSkor
    if (!isNaN(resultHasilSumKelebihanSkor)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihanSkor").value =
            resultHasilSumKelebihanSkor;
    }
    // // nilai tambah pendidikan dan pengajaran
    if (!isNaN(resultHasilSumKelebihanSkor)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiTambahUnsurPenunjang").value =
            resultHasilSumKelebihanSkor;
    }

    if (ResultNilaiUnsurPenunjang == "" || resultHasilSumKelebihanSkor == "") {
        var ResultSumNilaiTotalUnsurPenunjang =
            parseFloat(ResultNilaiUnsurPenunjang) +
            parseFloat(resultHasilSumKelebihanSkor);
    } else {
        var ResultSumNilaiTotalUnsurPenunjang =
            parseFloat(ResultNilaiUnsurPenunjang) +
            parseFloat(resultHasilSumKelebihanSkor);
    }

    // if (ResultSumNilaiTotalUnsurPenunjang > 35) {
    //     var num = 35;
    //     var NilaiTotalPengabdianKepadaMasyarakat = num.toFixed(2);
    // } else {
    //     var NilaiTotalPengabdianKepadaMasyarakat =
    //         ResultSumNilaiTotalUnsurPenunjang.toFixed(2);
    // }

    // if (!isNaN(NilaiTotalPengabdianKepadaMasyarakat)) {
    //     // Tampilkan output pada input form
    //     document.getElementById("NilaiTotalPengabdianKepadaMasyarakat").value =
    //         NilaiTotalPengabdianKepadaMasyarakat;
    // }

    if (!isNaN(ResultSumNilaiTotalUnsurPenunjang)) {
        // Tampilkan output pada input form
        document.getElementById("ResultSumNilaiTotalUnsurPenunjang").value =
            ResultSumNilaiTotalUnsurPenunjang;
    }
}
