function sum() {
    // Definisi variable inputan
    var C1;
    var C2;
    var C3;
    var C4;
    var C5;
    var C6;
    var C7;
    var C8;
    var C9;

    // Definisi Variable Point Tambahan
    var JumlahYangDihasilkanC1_2;
    var JumlahYangDihasilkanC1_3;
    var JumlahYangDihasilkanC1_4;
    var JumlahYangDihasilkanC1_5;
    var JumlahYangDihasilkanC2_2;
    var JumlahYangDihasilkanC2_3;
    var JumlahYangDihasilkanC2_4;
    var JumlahYangDihasilkanC2_5;
    var JumlahYangDihasilkanC3_4;
    var JumlahYangDihasilkanC3_5;
    var JumlahYangDihasilkanC4_2;
    var JumlahYangDihasilkanC4_3;
    var JumlahYangDihasilkanC4_4;
    var JumlahYangDihasilkanC4_5;
    var JumlahYangDihasilkanC5_2;
    var JumlahYangDihasilkanC5_3;
    var JumlahYangDihasilkanC5_4;
    var JumlahYangDihasilkanC5_5;
    var JumlahYangDihasilkanC6_2;
    var JumlahYangDihasilkanC6_3;
    var JumlahYangDihasilkanC6_4;
    var JumlahYangDihasilkanC6_5;
    var JumlahYangDihasilkanC7_2;
    var JumlahYangDihasilkanC7_3;
    var JumlahYangDihasilkanC7_4;
    var JumlahYangDihasilkanC7_5;
    var JumlahYangDihasilkanC8_2;
    var JumlahYangDihasilkanC8_3;
    var JumlahYangDihasilkanC8_4;
    var JumlahYangDihasilkanC8_5;
    var JumlahYangDihasilkanC9_2;
    var JumlahYangDihasilkanC9_3;
    var JumlahYangDihasilkanC9_4;
    var JumlahYangDihasilkanC9_5;

    // Cek Input Radio pokok point
    if ($("input[name='C1']:checked").val() != null) {
        C1 = document.querySelector('input[name="C1"]:checked').value;
    } else {
        C1 = 0;
    }
    if ($("input[name='C2']:checked").val() != null) {
        C2 = document.querySelector('input[name="C2"]:checked').value;
    } else {
        C2 = 0;
    }
    if ($("input[name='C3']:checked").val() != null) {
        C3 = document.querySelector('input[name="C3"]:checked').value;
    } else {
        C3 = 0;
    }
    if ($("input[name='C4']:checked").val() != null) {
        C4 = document.querySelector('input[name="C4"]:checked').value;
    } else {
        C4 = 0;
    }
    if ($("input[name='C5']:checked").val() != null) {
        C5 = document.querySelector('input[name="C5"]:checked').value;
    } else {
        C5 = 0;
    }
    if ($("input[name='C6']:checked").val() != null) {
        C6 = document.querySelector('input[name="C6"]:checked').value;
    } else {
        C6 = 0;
    }
    if ($("input[name='C7']:checked").val() != null) {
        C7 = document.querySelector('input[name="C7"]:checked').value;
    } else {
        C7 = 0;
    }
    if ($("input[name='C8']:checked").val() != null) {
        C8 = document.querySelector('input[name="C8"]:checked').value;
    } else {
        C8 = 0;
    }
    if ($("input[name='C9']:checked").val() != null) {
        C9 = document.querySelector('input[name="C9"]:checked').value;
    } else {
        C9 = 0;
    }

    // Merubah nilai inputan ke integer Pokok point
    //Kalkulasi Nilai (SKOR)
    var SkorC1 = parseInt(C1);
    var SkorC2 = parseInt(C2);
    var SkorC3 = parseInt(C3);
    var SkorC4 = parseInt(C4);
    var SkorC5 = parseInt(C5);
    var SkorC6 = parseInt(C6);
    var SkorC7 = parseInt(C7);
    var SkorC8 = parseInt(C8);
    var SkorC9 = parseInt(C9);

    // Skor inputan nilai setelah di rubah ke integer di bagi 5
    //Kalkulasi Nilai (SKOR/SKOR MAKS)
    var skorMaksC1 = SkorC1 / 5;
    var skorMaksC2 = SkorC2 / 5;
    var skorMaksC3 = SkorC3 / 5;
    var skorMaksC4 = SkorC4 / 5;
    var skorMaksC5 = SkorC5 / 5;
    var skorMaksC6 = SkorC6 / 5;
    var skorMaksC7 = SkorC7 / 5;
    var skorMaksC8 = SkorC8 / 5;
    var skorMaksC9 = SkorC9 / 5;

    // nilai inputan setelah di bagi sekarang di kalikan sesuai rumus excel Pokok point
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='C1']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC1 = num.toFixed(3);
    } else {
        var scorSubItemC1 = ((skorMaksC1 * 10) / 100).toFixed(3);
    }
    if ($("input[name='C2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC2 = num.toFixed(3);
    } else {
        var scorSubItemC2 = ((skorMaksC2 * 5) / 100).toFixed(3);
    }
    if ($("input[name='C3']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC3 = num.toFixed(3);
    } else {
        var scorSubItemC3 = ((skorMaksC3 * 10) / 100).toFixed(3);
    }
    if ($("input[name='C4']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC4 = num.toFixed(3);
    } else {
        var scorSubItemC4 = ((skorMaksC4 * 10) / 100).toFixed(3);
    }
    if ($("input[name='C5']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC5 = num.toFixed(3);
    } else {
        var scorSubItemC5 = ((skorMaksC5 * 5) / 100).toFixed(3);
    }
    if ($("input[name='C6']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC6 = num.toFixed(3);
    } else {
        var scorSubItemC6 = ((skorMaksC6 * 8) / 100).toFixed(3);
    }
    if ($("input[name='C7']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC7 = num.toFixed(3);
    } else {
        var scorSubItemC7 = ((skorMaksC7 * 8) / 100).toFixed(3);
    }
    if ($("input[name='C8']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC8 = num.toFixed(3);
    } else {
        var scorSubItemC8 = ((skorMaksC8 * 10) / 100).toFixed(3);
    }
    if ($("input[name='C9']:checked").val() == 1) {
        var num = 0;
        var scorSubItemC9 = num.toFixed(3);
    } else {
        var scorSubItemC9 = ((skorMaksC9 * 8) / 100).toFixed(3);
    }

    // Pokok point menampilkan hasil nilai di interfaces jumlah point point
    // Menampilkan nilai skor di form disabled
    if (!isNaN(SkorC1)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC1").value = SkorC1;
    }
    if (!isNaN(SkorC2)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC2").value = SkorC2;
    }
    if (!isNaN(SkorC3)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC3").value = SkorC3;
    }
    if (!isNaN(SkorC4)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC4").value = SkorC4;
    }
    if (!isNaN(SkorC5)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC5").value = SkorC5;
    }
    if (!isNaN(SkorC6)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC6").value = SkorC6;
    }
    if (!isNaN(SkorC7)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC7").value = SkorC7;
    }
    if (!isNaN(SkorC8)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC8").value = SkorC8;
    }
    if (!isNaN(SkorC9)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorC9").value = SkorC9;
    }

    // Menampilkan nilai Pokok point skor / Skor Maks di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksC1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC1").value = skorMaksC1;
    }
    if (!isNaN(skorMaksC2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC2").value = skorMaksC2;
    }
    if (!isNaN(skorMaksC3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC3").value = skorMaksC3;
    }
    if (!isNaN(skorMaksC4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC4").value = skorMaksC4;
    }
    if (!isNaN(skorMaksC5)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC5").value = skorMaksC5;
    }
    if (!isNaN(skorMaksC6)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC6").value = skorMaksC6;
    }
    if (!isNaN(skorMaksC7)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC7").value = skorMaksC7;
    }
    if (!isNaN(skorMaksC8)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC8").value = skorMaksC8;
    }
    if (!isNaN(skorMaksC9)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxC9").value = skorMaksC9;
    }

    // Menampilkan nilai Pokok point skor * Bpbpt Sub Item di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemC1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC1").value = scorSubItemC1;
    }
    if (!isNaN(scorSubItemC2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC2").value = scorSubItemC2;
    }
    if (!isNaN(scorSubItemC3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC3").value = scorSubItemC3;
    }
    if (!isNaN(scorSubItemC4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC4").value = scorSubItemC4;
    }
    if (!isNaN(scorSubItemC5)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC5").value = scorSubItemC5;
    }
    if (!isNaN(scorSubItemC6)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC6").value = scorSubItemC6;
    }
    if (!isNaN(scorSubItemC7)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC7").value = scorSubItemC7;
    }
    if (!isNaN(scorSubItemC8)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC8").value = scorSubItemC8;
    }
    if (!isNaN(scorSubItemC9)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemC9").value = scorSubItemC9;
    }

    // Cek nilai Inputan Point Tambahan
    // Cek Nilai atau inputan ada isi atau tidak
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC1_2']").val() != "") {
        JumlahYangDihasilkanC1_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC1_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC1_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC1_3']").val() != "") {
        JumlahYangDihasilkanC1_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC1_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC1_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC1_4']").val() != "") {
        JumlahYangDihasilkanC1_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC1_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC1_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC1_5']").val() != "") {
        JumlahYangDihasilkanC1_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC1_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC1_5 = 0;
    }
    if ($("input[name='JumlahYangDihasilkanC2_2']").val() != "") {
        JumlahYangDihasilkanC2_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC2_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC2_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC2_3']").val() != "") {
        JumlahYangDihasilkanC2_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC2_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC2_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC2_4']").val() != "") {
        JumlahYangDihasilkanC2_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC2_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC2_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC2_5']").val() != "") {
        JumlahYangDihasilkanC2_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC2_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC2_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC3_4']").val() != "") {
        JumlahYangDihasilkanC3_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC3_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC3_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC3_5']").val() != "") {
        JumlahYangDihasilkanC3_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC3_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC3_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC4_2']").val() != "") {
        JumlahYangDihasilkanC4_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC4_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC4_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC4_3']").val() != "") {
        JumlahYangDihasilkanC4_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC4_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC4_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC4_4']").val() != "") {
        JumlahYangDihasilkanC4_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC4_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC4_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC4_5']").val() != "") {
        JumlahYangDihasilkanC4_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC4_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC4_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC5_2']").val() != "") {
        JumlahYangDihasilkanC5_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC5_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC5_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC5_3']").val() != "") {
        JumlahYangDihasilkanC5_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC5_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC5_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC5_4']").val() != "") {
        JumlahYangDihasilkanC5_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC5_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC5_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC5_5']").val() != "") {
        JumlahYangDihasilkanC5_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC5_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC5_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC6_2']").val() != "") {
        JumlahYangDihasilkanC6_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC6_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC6_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC6_3']").val() != "") {
        JumlahYangDihasilkanC6_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC6_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC6_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC6_4']").val() != "") {
        JumlahYangDihasilkanC6_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC6_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC6_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC6_5']").val() != "") {
        JumlahYangDihasilkanC6_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC6_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC6_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC7_2']").val() != "") {
        JumlahYangDihasilkanC7_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC7_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC7_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC7_3']").val() != "") {
        JumlahYangDihasilkanC7_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC7_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC7_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC7_4']").val() != "") {
        JumlahYangDihasilkanC7_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC7_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC7_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC7_5']").val() != "") {
        JumlahYangDihasilkanC7_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC7_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC7_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC8_2']").val() != "") {
        JumlahYangDihasilkanC8_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC8_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC8_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC8_3']").val() != "") {
        JumlahYangDihasilkanC8_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC8_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC8_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC8_4']").val() != "") {
        JumlahYangDihasilkanC8_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC8_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC8_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC8_5']").val() != "") {
        JumlahYangDihasilkanC8_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC8_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC8_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC9_2']").val() != "") {
        JumlahYangDihasilkanC9_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanC9_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanC9_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC9_3']").val() != "") {
        JumlahYangDihasilkanC9_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanC9_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanC9_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC9_4']").val() != "") {
        JumlahYangDihasilkanC9_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanC9_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanC9_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanC9_5']").val() != "") {
        JumlahYangDihasilkanC9_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanC9_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanC9_5 = 0;
    }

    // Point Tambahan
    // Merubah Kenilai Integer
    // Merubah nilai menjadi Int dan di jadikan variable
    var resultJumlahYangDihasilkanC1_2 = parseInt(JumlahYangDihasilkanC1_2);
    var resultJumlahYangDihasilkanC1_3 = parseInt(JumlahYangDihasilkanC1_3);
    var resultJumlahYangDihasilkanC1_4 = parseInt(JumlahYangDihasilkanC1_4);
    var resultJumlahYangDihasilkanC1_5 = parseInt(JumlahYangDihasilkanC1_5);
    var resultJumlahYangDihasilkanC2_2 = parseInt(JumlahYangDihasilkanC2_2);
    var resultJumlahYangDihasilkanC2_3 = parseInt(JumlahYangDihasilkanC2_3);
    var resultJumlahYangDihasilkanC2_4 = parseInt(JumlahYangDihasilkanC2_4);
    var resultJumlahYangDihasilkanC2_5 = parseInt(JumlahYangDihasilkanC2_5);
    var resultJumlahYangDihasilkanC3_4 = parseInt(JumlahYangDihasilkanC3_4);
    var resultJumlahYangDihasilkanC3_5 = parseInt(JumlahYangDihasilkanC3_5);
    var resultJumlahYangDihasilkanC4_2 = parseInt(JumlahYangDihasilkanC4_2);
    var resultJumlahYangDihasilkanC4_3 = parseInt(JumlahYangDihasilkanC4_3);
    var resultJumlahYangDihasilkanC4_4 = parseInt(JumlahYangDihasilkanC4_4);
    var resultJumlahYangDihasilkanC4_5 = parseInt(JumlahYangDihasilkanC4_5);
    var resultJumlahYangDihasilkanC5_2 = parseInt(JumlahYangDihasilkanC5_2);
    var resultJumlahYangDihasilkanC5_3 = parseInt(JumlahYangDihasilkanC5_3);
    var resultJumlahYangDihasilkanC5_4 = parseInt(JumlahYangDihasilkanC5_4);
    var resultJumlahYangDihasilkanC5_5 = parseInt(JumlahYangDihasilkanC5_5);
    var resultJumlahYangDihasilkanC6_2 = parseInt(JumlahYangDihasilkanC6_2);
    var resultJumlahYangDihasilkanC6_3 = parseInt(JumlahYangDihasilkanC6_3);
    var resultJumlahYangDihasilkanC6_4 = parseInt(JumlahYangDihasilkanC6_4);
    var resultJumlahYangDihasilkanC6_5 = parseInt(JumlahYangDihasilkanC6_5);
    var resultJumlahYangDihasilkanC7_2 = parseInt(JumlahYangDihasilkanC7_2);
    var resultJumlahYangDihasilkanC7_3 = parseInt(JumlahYangDihasilkanC7_3);
    var resultJumlahYangDihasilkanC7_4 = parseInt(JumlahYangDihasilkanC7_4);
    var resultJumlahYangDihasilkanC7_5 = parseInt(JumlahYangDihasilkanC7_5);
    var resultJumlahYangDihasilkanC8_2 = parseInt(JumlahYangDihasilkanC8_2);
    var resultJumlahYangDihasilkanC8_3 = parseInt(JumlahYangDihasilkanC8_3);
    var resultJumlahYangDihasilkanC8_4 = parseInt(JumlahYangDihasilkanC8_4);
    var resultJumlahYangDihasilkanC8_5 = parseInt(JumlahYangDihasilkanC8_5);
    var resultJumlahYangDihasilkanC9_2 = parseInt(JumlahYangDihasilkanC9_2);
    var resultJumlahYangDihasilkanC9_3 = parseInt(JumlahYangDihasilkanC9_3);
    var resultJumlahYangDihasilkanC9_4 = parseInt(JumlahYangDihasilkanC9_4);
    var resultJumlahYangDihasilkanC9_5 = parseInt(JumlahYangDihasilkanC9_5);

    // Point Tambahan Hasil Integer dikalikan nilai sesuai di excel
    // jumlah input nilai akan di kalikan 3 atau sesuai rumus excel
    var resultDikalikanC1_2 = resultJumlahYangDihasilkanC1_2 * 0.5;
    var resultDikalikanC1_3 = resultJumlahYangDihasilkanC1_3 * 2;
    var resultDikalikanC1_4 = resultJumlahYangDihasilkanC1_4 * 3.5;
    var resultDikalikanC1_5 = resultJumlahYangDihasilkanC1_5 * 5;
    var resultDikalikanC2_2 = resultJumlahYangDihasilkanC2_2 * 0.5;
    var resultDikalikanC2_3 = resultJumlahYangDihasilkanC2_3 * 1;
    var resultDikalikanC2_4 = resultJumlahYangDihasilkanC2_4 * 1.5;
    var resultDikalikanC2_5 = resultJumlahYangDihasilkanC2_5 * 2;
    var resultDikalikanC3_4 = resultJumlahYangDihasilkanC3_4 * 0.5;
    var resultDikalikanC3_5 = resultJumlahYangDihasilkanC3_5 * 1;
    var resultDikalikanC4_2 = resultJumlahYangDihasilkanC4_2 * 0.5;
    var resultDikalikanC4_3 = resultJumlahYangDihasilkanC4_3 * 2;
    var resultDikalikanC4_4 = resultJumlahYangDihasilkanC4_4 * 3.5;
    var resultDikalikanC4_5 = resultJumlahYangDihasilkanC4_5 * 5;
    var resultDikalikanC5_2 = resultJumlahYangDihasilkanC5_2 * 0.5;
    var resultDikalikanC5_3 = resultJumlahYangDihasilkanC5_3 * 1;
    var resultDikalikanC5_4 = resultJumlahYangDihasilkanC5_4 * 1.5;
    var resultDikalikanC5_5 = resultJumlahYangDihasilkanC5_5 * 2;
    var resultDikalikanC6_2 = resultJumlahYangDihasilkanC6_2 * 1;
    var resultDikalikanC6_3 = resultJumlahYangDihasilkanC6_3 * 3;
    var resultDikalikanC6_4 = resultJumlahYangDihasilkanC6_4 * 4;
    var resultDikalikanC6_5 = resultJumlahYangDihasilkanC6_5 * 5;
    var resultDikalikanC7_2 = resultJumlahYangDihasilkanC7_2 * 0.5;
    var resultDikalikanC7_3 = resultJumlahYangDihasilkanC7_3 * 1;
    var resultDikalikanC7_4 = resultJumlahYangDihasilkanC7_4 * 1.5;
    var resultDikalikanC7_5 = resultJumlahYangDihasilkanC7_5 * 2;
    var resultDikalikanC8_2 = resultJumlahYangDihasilkanC8_2 * 0.5;
    var resultDikalikanC8_3 = resultJumlahYangDihasilkanC8_3 * 1;
    var resultDikalikanC8_4 = resultJumlahYangDihasilkanC8_4 * 1.5;
    var resultDikalikanC8_5 = resultJumlahYangDihasilkanC8_5 * 2;
    var resultDikalikanC9_2 = resultJumlahYangDihasilkanC9_2 * 0.5;
    var resultDikalikanC9_3 = resultJumlahYangDihasilkanC9_3 * 1;
    var resultDikalikanC9_4 = resultJumlahYangDihasilkanC9_4 * 1.5;
    var resultDikalikanC9_5 = resultJumlahYangDihasilkanC9_5 * 2;

    // Menampilkan hasil di kalikan di baris Skor Tambahan dari jumlah Point Tambahan C.1
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC1_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC1_2").value = resultDikalikanC1_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC1_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC1_3").value = resultDikalikanC1_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC1_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC1_4").value = resultDikalikanC1_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC1_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC1_5").value = resultDikalikanC1_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC2_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC2_2").value = resultDikalikanC2_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC2_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC2_3").value = resultDikalikanC2_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC2_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC2_4").value = resultDikalikanC2_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC2_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC2_5").value = resultDikalikanC2_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC3_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC3_4").value = resultDikalikanC3_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC3_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC3_5").value = resultDikalikanC3_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC4_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC4_2").value = resultDikalikanC4_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC4_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC4_3").value = resultDikalikanC4_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC4_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC4_4").value = resultDikalikanC4_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC4_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC4_5").value = resultDikalikanC4_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC5_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC5_2").value = resultDikalikanC5_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC5_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC5_3").value = resultDikalikanC5_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC5_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC5_4").value = resultDikalikanC5_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC5_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC5_5").value = resultDikalikanC5_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC6_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC6_2").value = resultDikalikanC6_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC6_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC6_3").value = resultDikalikanC6_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC6_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC6_4").value = resultDikalikanC6_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC6_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC6_5").value = resultDikalikanC6_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC7_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC7_2").value = resultDikalikanC7_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC7_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC7_3").value = resultDikalikanC7_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC7_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC7_4").value = resultDikalikanC7_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC7_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC7_5").value = resultDikalikanC7_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC8_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC8_2").value = resultDikalikanC8_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC8_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC8_3").value = resultDikalikanC8_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC8_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC8_4").value = resultDikalikanC8_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC8_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC8_5").value = resultDikalikanC8_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC9_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC9_2").value = resultDikalikanC9_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC9_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC9_3").value = resultDikalikanC9_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC9_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC9_4").value = resultDikalikanC9_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanC9_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanC9_5").value = resultDikalikanC9_5;
    }

    // SUM C.1 kolom Bukti Pendukung
    // SUM Skor Point C.1
    if (
        resultDikalikanC1_2 == "" ||
        resultDikalikanC1_3 == "" ||
        resultDikalikanC1_4 == "" ||
        resultDikalikanC1_5 == ""
    ) {
        var sumResultC1 =
            resultDikalikanC1_2 +
            resultDikalikanC1_3 +
            resultDikalikanC1_4 +
            resultDikalikanC1_5;
    } else {
        var sumResultC1 =
            resultDikalikanC1_2 +
            resultDikalikanC1_3 +
            resultDikalikanC1_4 +
            resultDikalikanC1_5;
    }
    // SUM Skor Point C.2
    if (
        resultDikalikanC2_2 == "" ||
        resultDikalikanC2_3 == "" ||
        resultDikalikanC2_4 == "" ||
        resultDikalikanC2_5 == ""
    ) {
        var sumResultC2 =
            resultDikalikanC2_2 +
            resultDikalikanC2_3 +
            resultDikalikanC2_4 +
            resultDikalikanC2_5;
    } else {
        var sumResultC2 =
            resultDikalikanC2_2 +
            resultDikalikanC2_3 +
            resultDikalikanC2_4 +
            resultDikalikanC2_5;
    }
    // SUM Skor Point C.3
    if (resultDikalikanC3_4 == "" || resultDikalikanC3_5 == "") {
        var sumResultC3 = resultDikalikanC3_4 + resultDikalikanC3_5;
    } else {
        var sumResultC3 = resultDikalikanC3_4 + resultDikalikanC3_5;
    }
    // SUM Skor Point C.4
    if (
        resultDikalikanC4_2 == "" ||
        resultDikalikanC4_3 == "" ||
        resultDikalikanC4_4 == "" ||
        resultDikalikanC4_5 == ""
    ) {
        var sumResultC4 =
            resultDikalikanC4_2 +
            resultDikalikanC4_3 +
            resultDikalikanC4_4 +
            resultDikalikanC4_5;
    } else {
        var sumResultC4 =
            resultDikalikanC4_2 +
            resultDikalikanC4_3 +
            resultDikalikanC4_4 +
            resultDikalikanC4_5;
    }
    // SUM Skor Point C.5
    if (
        resultDikalikanC5_2 == "" ||
        resultDikalikanC5_3 == "" ||
        resultDikalikanC5_4 == "" ||
        resultDikalikanC5_5 == ""
    ) {
        var sumResultC5 =
            resultDikalikanC5_2 +
            resultDikalikanC5_3 +
            resultDikalikanC5_4 +
            resultDikalikanC5_5;
    } else {
        var sumResultC5 =
            resultDikalikanC5_2 +
            resultDikalikanC5_3 +
            resultDikalikanC5_4 +
            resultDikalikanC5_5;
    }
    // SUM Skor Point C.6
    if (
        resultDikalikanC6_2 == "" ||
        resultDikalikanC6_3 == "" ||
        resultDikalikanC6_4 == "" ||
        resultDikalikanC6_5 == ""
    ) {
        var sumResultC6 =
            resultDikalikanC6_2 +
            resultDikalikanC6_3 +
            resultDikalikanC6_4 +
            resultDikalikanC6_5;
    } else {
        var sumResultC6 =
            resultDikalikanC6_2 +
            resultDikalikanC6_3 +
            resultDikalikanC6_4 +
            resultDikalikanC6_5;
    }
    // SUM Skor Point C.7
    if (
        resultDikalikanC7_2 == "" ||
        resultDikalikanC7_3 == "" ||
        resultDikalikanC7_4 == "" ||
        resultDikalikanC7_5 == ""
    ) {
        var sumResultC7 =
            resultDikalikanC7_2 +
            resultDikalikanC7_3 +
            resultDikalikanC7_4 +
            resultDikalikanC7_5;
    } else {
        var sumResultC7 =
            resultDikalikanC7_2 +
            resultDikalikanC7_3 +
            resultDikalikanC7_4 +
            resultDikalikanC7_5;
    }
    // SUM Skor Point C.8
    if (
        resultDikalikanC8_2 == "" ||
        resultDikalikanC8_3 == "" ||
        resultDikalikanC8_4 == "" ||
        resultDikalikanC8_5 == ""
    ) {
        var sumResultC8 =
            resultDikalikanC8_2 +
            resultDikalikanC8_3 +
            resultDikalikanC8_4 +
            resultDikalikanC8_5;
    } else {
        var sumResultC8 =
            resultDikalikanC8_2 +
            resultDikalikanC8_3 +
            resultDikalikanC8_4 +
            resultDikalikanC8_5;
    }
    // SUM Skor Point C.9
    if (
        resultDikalikanC9_2 == "" ||
        resultDikalikanC9_3 == "" ||
        resultDikalikanC9_4 == "" ||
        resultDikalikanC9_5 == ""
    ) {
        var sumResultC9 =
            resultDikalikanC9_2 +
            resultDikalikanC9_3 +
            resultDikalikanC9_4 +
            resultDikalikanC9_5;
    } else {
        var sumResultC9 =
            resultDikalikanC9_2 +
            resultDikalikanC9_3 +
            resultDikalikanC9_4 +
            resultDikalikanC9_5;
    }

    // Point Tambahan
    // cwk nilai apakah nilai lebih dari samadengan, jika iya akan di bagi sesuai di excel jika tidak akan di bagi 0
    // C.1
    if (sumResultC1 >= 5) {
        var numC1 = 5;
        var nilaiDibagi100C1 = (numC1 / 100).toFixed(3);
    } else if (sumResultC1 <= 5) {
        var numC1 = sumResultC1;
        var nilaiDibagi100C1 = (numC1 / 100).toFixed(3);
    }
    // C.2
    if (sumResultC2 >= 2) {
        var numC2 = 2;
        var nilaiDibagi100C2 = (numC2 / 100).toFixed(3);
    } else if (sumResultC2 <= 2) {
        var numC2 = sumResultC2;
        var nilaiDibagi100C2 = (numC2 / 100).toFixed(3);
    }
    // C.3
    if (sumResultC3 >= 1) {
        var numC3 = 1;
        var nilaiDibagi100C3 = (numC3 / 100).toFixed(3);
    } else if (sumResultC3 <= 1) {
        var numC3 = sumResultC3;
        var nilaiDibagi100C3 = (numC3 / 100).toFixed(3);
    }
    // C.4
    if (sumResultC4 >= 5) {
        var numC4 = 5;
        var nilaiDibagi100C4 = (numC4 / 100).toFixed(3);
    } else if (sumResultC4 <= 5) {
        var numC4 = sumResultC4;
        var nilaiDibagi100C4 = (numC4 / 100).toFixed(3);
    }
    // C.5
    if (sumResultC5 >= 2) {
        var numC5 = 2;
        var nilaiDibagi100C5 = (numC5 / 100).toFixed(3);
    } else if (sumResultC5 <= 2) {
        var numC5 = sumResultC5;
        var nilaiDibagi100C5 = (numC5 / 100).toFixed(3);
    }
    // C.6
    if (sumResultC6 >= 5) {
        var numC6 = 5;
        var nilaiDibagi100C6 = (numC6 / 100).toFixed(3);
    } else if (sumResultC6 <= 5) {
        var numC6 = sumResultC6;
        var nilaiDibagi100C6 = (numC6 / 100).toFixed(3);
    }
    // C.7
    if (sumResultC7 >= 2) {
        var numC7 = 2;
        var nilaiDibagi100C7 = (numC7 / 100).toFixed(3);
    } else if (sumResultC7 <= 2) {
        var numC7 = sumResultC7;
        var nilaiDibagi100C7 = (numC7 / 100).toFixed(3);
    }
    // C.8
    if (sumResultC8 >= 2) {
        var numC8 = 2;
        var nilaiDibagi100C8 = (numC8 / 100).toFixed(3);
    } else if (sumResultC8 <= 2) {
        var numC8 = sumResultC8;
        var nilaiDibagi100C8 = (numC8 / 100).toFixed(3);
    }
    // C.9
    if (sumResultC9 >= 2) {
        var numC9 = 2;
        var nilaiDibagi100C9 = (numC9 / 100).toFixed(3);
    } else if (sumResultC9 <= 2) {
        var numC9 = sumResultC9;
        var nilaiDibagi100C9 = (numC9 / 100).toFixed(3);
    }

    //Kalkulasi Nilai (SUM) Point tambahan dan Point Pokok
    var resultSumC1 = parseFloat(nilaiDibagi100C1) + parseFloat(scorSubItemC1);
    var resultSumC2 = parseFloat(nilaiDibagi100C2) + parseFloat(scorSubItemC2);
    var resultSumC3 = parseFloat(nilaiDibagi100C3) + parseFloat(scorSubItemC3);
    var resultSumC4 = parseFloat(nilaiDibagi100C4) + parseFloat(scorSubItemC4);
    var resultSumC5 = parseFloat(nilaiDibagi100C5) + parseFloat(scorSubItemC5);
    var resultSumC6 = parseFloat(nilaiDibagi100C6) + parseFloat(scorSubItemC6);
    var resultSumC7 = parseFloat(nilaiDibagi100C7) + parseFloat(scorSubItemC7);
    var resultSumC8 = parseFloat(nilaiDibagi100C8) + parseFloat(scorSubItemC8);
    var resultSumC9 = parseFloat(nilaiDibagi100C9) + parseFloat(scorSubItemC9);

    // Merubah format nilai ke 0.000
    var resultSumtoFixedC1 = resultSumC1.toFixed(3);
    var resultSumtoFixedC2 = resultSumC2.toFixed(3);
    var resultSumtoFixedC3 = resultSumC3.toFixed(3);
    var resultSumtoFixedC4 = resultSumC4.toFixed(3);
    var resultSumtoFixedC5 = resultSumC5.toFixed(3);
    var resultSumtoFixedC6 = resultSumC6.toFixed(3);
    var resultSumtoFixedC7 = resultSumC7.toFixed(3);
    var resultSumtoFixedC8 = resultSumC8.toFixed(3);
    var resultSumtoFixedC9 = resultSumC9.toFixed(3);

    // Point Tambahan menampilkan hasil di interfaces skor/skor maks
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numC1)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC1").value = numC1;
    }
    if (!isNaN(numC2)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC2").value = numC2;
    }
    if (!isNaN(numC3)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC3").value = numC3;
    }
    if (!isNaN(numC4)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC4").value = numC4;
    }
    if (!isNaN(numC5)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC5").value = numC5;
    }
    if (!isNaN(numC6)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC6").value = numC6;
    }
    if (!isNaN(numC7)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC7").value = numC7;
    }
    if (!isNaN(numC8)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC8").value = numC8;
    }
    if (!isNaN(numC9)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanC9").value = numC9;
    }

    // Point Tambahan intefaces Skor X Bobot sub item
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100C1)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC1").value =
            nilaiDibagi100C1;
    }
    if (!isNaN(nilaiDibagi100C2)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC2").value =
            nilaiDibagi100C2;
    }
    if (!isNaN(nilaiDibagi100C3)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC3").value =
            nilaiDibagi100C3;
    }
    if (!isNaN(nilaiDibagi100C4)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC4").value =
            nilaiDibagi100C4;
    }
    if (!isNaN(nilaiDibagi100C5)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC5").value =
            nilaiDibagi100C5;
    }
    if (!isNaN(nilaiDibagi100C6)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC6").value =
            nilaiDibagi100C6;
    }
    if (!isNaN(nilaiDibagi100C7)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC7").value =
            nilaiDibagi100C7;
    }
    if (!isNaN(nilaiDibagi100C8)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC8").value =
            nilaiDibagi100C8;
    }
    if (!isNaN(nilaiDibagi100C9)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorC9").value =
            nilaiDibagi100C9;
    }

    // Result SUM Pokok Point + Point Tambahan dan di tampilkan di kolom skor X Bobot sub item baris Skor tambahan dari jumlah
    if (!isNaN(resultSumtoFixedC1)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC1").value =
            resultSumtoFixedC1;
    }
    if (!isNaN(resultSumtoFixedC2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC2").value =
            resultSumtoFixedC2;
    }
    if (!isNaN(resultSumtoFixedC3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC3").value =
            resultSumtoFixedC3;
    }
    if (!isNaN(resultSumtoFixedC4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC4").value =
            resultSumtoFixedC4;
    }
    if (!isNaN(resultSumtoFixedC5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC5").value =
            resultSumtoFixedC5;
    }
    if (!isNaN(resultSumtoFixedC6)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC6").value =
            resultSumtoFixedC6;
    }
    if (!isNaN(resultSumtoFixedC7)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC7").value =
            resultSumtoFixedC7;
    }
    if (!isNaN(resultSumtoFixedC8)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC8").value =
            resultSumtoFixedC8;
    }
    if (!isNaN(resultSumtoFixedC9)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemC9").value =
            resultSumtoFixedC9;
    }

    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC1)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC1").value = sumResultC1;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC2)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC2").value = sumResultC2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC3)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC3").value = sumResultC3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC4)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC4").value = sumResultC4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC5)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC5").value = sumResultC5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC6)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC6").value = sumResultC6;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC7)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC7").value = sumResultC7;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC8)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC8").value = sumResultC8;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultC9)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahC9").value = sumResultC9;
    }

    // SUM TOTAL POINT
    if (
        resultSumtoFixedC1 == "" ||
        resultSumtoFixedC2 == "" ||
        resultSumtoFixedC3 == "" ||
        resultSumtoFixedC4 == "" ||
        resultSumtoFixedC5 == "" ||
        resultSumtoFixedC6 == "" ||
        resultSumtoFixedC7 == "" ||
        resultSumtoFixedC8 == "" ||
        resultSumtoFixedC9 == ""
    ) {
        var sumTotal =
            parseFloat(resultSumtoFixedC1) +
            parseFloat(resultSumtoFixedC2) +
            parseFloat(resultSumtoFixedC3) +
            parseFloat(resultSumtoFixedC4) +
            parseFloat(resultSumtoFixedC5) +
            parseFloat(resultSumtoFixedC6) +
            parseFloat(resultSumtoFixedC7) +
            parseFloat(resultSumtoFixedC8) +
            parseFloat(resultSumtoFixedC9);
        var sumResult = sumTotal.toFixed(3);
    } else {
        var sumTotal =
            parseFloat(resultSumtoFixedC1) +
            parseFloat(resultSumtoFixedC2) +
            parseFloat(resultSumtoFixedC3) +
            parseFloat(resultSumtoFixedC4) +
            parseFloat(resultSumtoFixedC5) +
            parseFloat(resultSumtoFixedC6) +
            parseFloat(resultSumtoFixedC7) +
            parseFloat(resultSumtoFixedC8) +
            parseFloat(resultSumtoFixedC9);
        var sumResult = sumTotal.toFixed(3);
    }

    // Menampilkan hasil SUM TOTAL Point
    if (!isNaN(sumResult)) {
        // Tampilkan output pada input form
        document.getElementById("TotalSkorPengabdianKepadaMasyarakat").value =
            sumResult;
    }

    var NilaiPengabdian = parseFloat(sumResult);
    var ResultNilaiPengabdian = NilaiPengabdian * 20;
    var ResultNilaiPengabdian = ResultNilaiPengabdian.toFixed(2);

    // Hasil Nilai pengabdian * 20
    if (!isNaN(ResultNilaiPengabdian)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiPengabdianKepadaMasyarakat").value =
            ResultNilaiPengabdian;
    }

    // Perkalian Skor Kelebihan
    // C.1
    if (sumResultC1 >= 5) {
        var ResultNilaiDiKurangiC1 = sumResultC1 - 5;
        var resultHasilTambahaC1 = (ResultNilaiDiKurangiC1 * 5) / 100;
    } else {
        var resultHasilTambahaC1 = 0;
    }
    // C.2
    if (sumResultC2 >= 2) {
        var ResultNilaiDiKurangiC2 = sumResultC2 - 2;
        var resultHasilTambahaC2 = (ResultNilaiDiKurangiC2 * 2) / 100;
    } else {
        var resultHasilTambahaC2 = 0;
    }
    // C.3
    if (sumResultC3 >= 1) {
        var ResultNilaiDiKurangiC3 = sumResultC3 - 1;
        var resultHasilTambahaC3 = (ResultNilaiDiKurangiC3 * 1) / 100;
    } else {
        var resultHasilTambahaC3 = 0;
    }
    // C.4
    if (sumResultC4 >= 5) {
        var ResultNilaiDiKurangiC4 = sumResultC4 - 5;
        var resultHasilTambahaC4 = (ResultNilaiDiKurangiC4 * 5) / 100;
    } else {
        var resultHasilTambahaC4 = 0;
    }
    // C.5
    if (sumResultC5 >= 2) {
        var ResultNilaiDiKurangiC5 = sumResultC5 - 2;
        var resultHasilTambahaC5 = (ResultNilaiDiKurangiC5 * 2) / 100;
    } else {
        var resultHasilTambahaC5 = 0;
    }
    // C.6
    if (sumResultC6 >= 5) {
        var ResultNilaiDiKurangiC6 = sumResultC6 - 5;
        var resultHasilTambahaC6 = (ResultNilaiDiKurangiC6 * 5) / 100;
    } else {
        var resultHasilTambahaC6 = 0;
    }
    // C.7
    if (sumResultC7 >= 2) {
        var ResultNilaiDiKurangiC7 = sumResultC7 - 2;
        var resultHasilTambahaC7 = (ResultNilaiDiKurangiC7 * 2) / 100;
    } else {
        var resultHasilTambahaC7 = 0;
    }
    // C.8
    if (sumResultC8 >= 2) {
        var ResultNilaiDiKurangiC8 = sumResultC8 - 2;
        var resultHasilTambahaC8 = (ResultNilaiDiKurangiC8 * 2) / 100;
    } else {
        var resultHasilTambahaC8 = 0;
    }
    // C.9
    if (sumResultC9 >= 2) {
        var ResultNilaiDiKurangiC9 = sumResultC9 - 2;
        var resultHasilTambahaC9 = (ResultNilaiDiKurangiC9 * 2) / 100;
    } else {
        var resultHasilTambahaC9 = 0;
    }

    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaC1)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC1").value = resultHasilTambahaC1;
    }
    if (!isNaN(resultHasilTambahaC2)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC2").value = resultHasilTambahaC2;
    }
    if (!isNaN(resultHasilTambahaC3)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC3").value = resultHasilTambahaC3;
    }
    if (!isNaN(resultHasilTambahaC4)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC4").value = resultHasilTambahaC4;
    }
    if (!isNaN(resultHasilTambahaC5)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC5").value = resultHasilTambahaC5;
    }
    if (!isNaN(resultHasilTambahaC6)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC6").value = resultHasilTambahaC6;
    }
    if (!isNaN(resultHasilTambahaC7)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC7").value = resultHasilTambahaC7;
    }
    if (!isNaN(resultHasilTambahaC8)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC8").value = resultHasilTambahaC8;
    }
    if (!isNaN(resultHasilTambahaC9)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaC9").value = resultHasilTambahaC9;
    }

    // SUM result total kelebihan skor
    if (
        resultHasilTambahaC1 == "" ||
        resultHasilTambahaC2 == "" ||
        resultHasilTambahaC3 == "" ||
        resultHasilTambahaC4 == "" ||
        resultHasilTambahaC5 == "" ||
        resultHasilTambahaC6 == "" ||
        resultHasilTambahaC7 == "" ||
        resultHasilTambahaC8 == "" ||
        resultHasilTambahaC9 == ""
    ) {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaC1) +
            parseFloat(resultHasilTambahaC2) +
            parseFloat(resultHasilTambahaC3) +
            parseFloat(resultHasilTambahaC4) +
            parseFloat(resultHasilTambahaC5) +
            parseFloat(resultHasilTambahaC6) +
            parseFloat(resultHasilTambahaC7) +
            parseFloat(resultHasilTambahaC8) +
            parseFloat(resultHasilTambahaC9);
    } else {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaC1) +
            parseFloat(resultHasilTambahaC2) +
            parseFloat(resultHasilTambahaC3) +
            parseFloat(resultHasilTambahaC4) +
            parseFloat(resultHasilTambahaC5) +
            parseFloat(resultHasilTambahaC6) +
            parseFloat(resultHasilTambahaC7) +
            parseFloat(resultHasilTambahaC8) +
            parseFloat(resultHasilTambahaC9);
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
        document.getElementById("NilaiTambahPengabdianKepadaMasyarakat").value =
            resultHasilSumKelebihanSkor;
    }

    // SUM result nilai pendidikan dan pengajaran + nilai tambah pendidikan dan pengajaran
    if (ResultNilaiPengabdian == "" || resultHasilSumKelebihanSkor == "") {
        var ResultPengabdianDanNilaiTambahPengabdian =
            parseFloat(ResultNilaiPengabdian) +
            parseFloat(resultHasilSumKelebihanSkor);
    } else {
        var ResultPengabdianDanNilaiTambahPengabdian =
            parseFloat(ResultNilaiPengabdian) +
            parseFloat(resultHasilSumKelebihanSkor);
    }

    if (ResultPengabdianDanNilaiTambahPengabdian > 35) {
        var num = 35;
        var NilaiTotalPengabdianKepadaMasyarakat = num.toFixed(2);
    } else {
        var NilaiTotalPengabdianKepadaMasyarakat =
            ResultPengabdianDanNilaiTambahPengabdian.toFixed(2);
    }

    if (!isNaN(NilaiTotalPengabdianKepadaMasyarakat)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiTotalPengabdianKepadaMasyarakat").value =
            NilaiTotalPengabdianKepadaMasyarakat;
    }
}
