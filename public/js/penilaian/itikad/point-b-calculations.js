function sum() {
    // Definisi variabel inputan pokok point
    var B1;
    var B2;
    var B3;
    var B4;
    var B5;
    var B6;
    var B7;
    var B8;
    var B9;
    var B10;
    var B11;
    var B12;
    var B13;
    var B14;
    var B15;
    var B16;
    var B17;
    var B18;

    // Definisi Variable Point Tambahan
    var JumlahYangDihasilkanB1_2;
    var JumlahYangDihasilkanB1_3;
    var JumlahYangDihasilkanB1_4;
    var JumlahYangDihasilkanB1_5;
    var JumlahYangDihasilkanB2_4;
    var JumlahYangDihasilkanB2_5;
    var JumlahYangDihasilkanB3_4;
    var JumlahYangDihasilkanB3_5;
    var JumlahYangDihasilkanB5_5;
    var JumlahYangDihasilkanB6_5;
    var JumlahYangDihasilkanB7_5;
    var JumlahYangDihasilkanB9_3;
    var JumlahYangDihasilkanB9_5;
    var JumlahYangDihasilkanB10_3;
    var JumlahYangDihasilkanB10_5;
    var JumlahYangDihasilkanB11_5;
    var JumlahYangDihasilkanB12_5;
    var JumlahYangDihasilkanB13_3;
    var JumlahYangDihasilkanB13_4;
    var JumlahYangDihasilkanB13_5;
    var JumlahYangDihasilkanB14_2;
    var JumlahYangDihasilkanB14_3;
    var JumlahYangDihasilkanB14_4;
    var JumlahYangDihasilkanB14_5;
    var JumlahYangDihasilkanB15_3;
    var JumlahYangDihasilkanB15_4;
    var JumlahYangDihasilkanB15_5;
    var JumlahYangDihasilkanB17_2;
    var JumlahYangDihasilkanB17_3;
    var JumlahYangDihasilkanB17_4;
    var JumlahYangDihasilkanB17_5;

    // Cek Input Radio pokok point
    if ($("input[name='B1']:checked").val() != null) {
        B1 = document.querySelector('input[name="B1"]:checked').value;
    } else {
        B1 = 0;
    }
    if ($("input[name='B2']:checked").val() != null) {
        B2 = document.querySelector('input[name="B2"]:checked').value;
    } else {
        B2 = 0;
    }
    if ($("input[name='B3']:checked").val() != null) {
        B3 = document.querySelector('input[name="B3"]:checked').value;
    } else {
        B3 = 0;
    }
    if ($("input[name='B4']:checked").val() != null) {
        B4 = document.querySelector('input[name="B4"]:checked').value;
    } else {
        B4 = 0;
    }
    if ($("input[name='B5']:checked").val() != null) {
        B5 = document.querySelector('input[name="B5"]:checked').value;
    } else {
        B5 = 0;
    }
    if ($("input[name='B6']:checked").val() != null) {
        B6 = document.querySelector('input[name="B6"]:checked').value;
    } else {
        B6 = 0;
    }
    if ($("input[name='B7']:checked").val() != null) {
        B7 = document.querySelector('input[name="B7"]:checked').value;
    } else {
        B7 = 0;
    }
    if ($("input[name='B8']:checked").val() != null) {
        B8 = document.querySelector('input[name="B8"]:checked').value;
    } else {
        B8 = 0;
    }
    if ($("input[name='B9']:checked").val() != null) {
        B9 = document.querySelector('input[name="B9"]:checked').value;
    } else {
        B9 = 0;
    }
    if ($("input[name='B10']:checked").val() != null) {
        B10 = document.querySelector('input[name="B10"]:checked').value;
    } else {
        B10 = 0;
    }
    if ($("input[name='B11']:checked").val() != null) {
        B11 = document.querySelector('input[name="B11"]:checked').value;
    } else {
        B11 = 0;
    }
    if ($("input[name='B12']:checked").val() != null) {
        B12 = document.querySelector('input[name="B12"]:checked').value;
    } else {
        B12 = 0;
    }
    if ($("input[name='B13']:checked").val() != null) {
        B13 = document.querySelector('input[name="B13"]:checked').value;
    } else {
        B13 = 0;
    }
    if ($("input[name='B14']:checked").val() != null) {
        B14 = document.querySelector('input[name="B14"]:checked').value;
    } else {
        B14 = 0;
    }
    if ($("input[name='B15']:checked").val() != null) {
        B15 = document.querySelector('input[name="B15"]:checked').value;
    } else {
        B15 = 0;
    }
    if ($("input[name='B16']:checked").val() != null) {
        B16 = document.querySelector('input[name="B16"]:checked').value;
    } else {
        B16 = 0;
    }
    if ($("input[name='B17']:checked").val() != null) {
        B17 = document.querySelector('input[name="B17"]:checked').value;
    } else {
        B17 = 0;
    }
    if ($("input[name='B18']:checked").val() != null) {
        B18 = document.querySelector('input[name="B18"]:checked').value;
    } else {
        B18 = 0;
    }

    // Cek nilai Inputan Point Tambahan
    // Cek Nilai atau inputan ada isi atau tidak
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB1_2']").val() != "") {
        JumlahYangDihasilkanB1_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanB1_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanB1_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB1_3']").val() != "") {
        JumlahYangDihasilkanB1_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB1_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB1_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB1_4']").val() != "") {
        JumlahYangDihasilkanB1_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB1_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB1_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB1_5']").val() != "") {
        JumlahYangDihasilkanB1_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB1_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB1_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB2_4']").val() != "") {
        JumlahYangDihasilkanB2_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB2_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB2_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB2_5']").val() != "") {
        JumlahYangDihasilkanB2_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB2_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB2_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB3_4']").val() != "") {
        JumlahYangDihasilkanB3_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB3_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB3_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB3_5']").val() != "") {
        JumlahYangDihasilkanB3_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB3_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB3_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB5_5']").val() != "") {
        JumlahYangDihasilkanB5_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB5_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB5_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB6_5']").val() != "") {
        JumlahYangDihasilkanB6_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB6_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB6_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB7_5']").val() != "") {
        JumlahYangDihasilkanB7_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB7_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB7_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB9_3']").val() != "") {
        JumlahYangDihasilkanB9_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB9_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB9_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB9_5']").val() != "") {
        JumlahYangDihasilkanB9_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB9_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB9_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB10_3']").val() != "") {
        JumlahYangDihasilkanB10_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB10_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB10_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB10_5']").val() != "") {
        JumlahYangDihasilkanB10_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB10_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB10_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB11_5']").val() != "") {
        JumlahYangDihasilkanB11_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB11_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB11_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB12_5']").val() != "") {
        JumlahYangDihasilkanB12_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB12_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB12_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB13_3']").val() != "") {
        JumlahYangDihasilkanB13_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB13_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB13_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB13_4']").val() != "") {
        JumlahYangDihasilkanB13_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB13_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB13_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB13_5']").val() != "") {
        JumlahYangDihasilkanB13_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB13_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB13_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB14_2']").val() != "") {
        JumlahYangDihasilkanB14_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanB14_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanB14_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB14_3']").val() != "") {
        JumlahYangDihasilkanB14_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB14_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB14_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB14_4']").val() != "") {
        JumlahYangDihasilkanB14_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB14_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB14_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB14_5']").val() != "") {
        JumlahYangDihasilkanB14_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB14_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB14_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB15_3']").val() != "") {
        JumlahYangDihasilkanB15_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB15_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB15_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB15_4']").val() != "") {
        JumlahYangDihasilkanB15_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB15_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB15_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB15_5']").val() != "") {
        JumlahYangDihasilkanB15_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB15_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB15_5 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB17_2']").val() != "") {
        JumlahYangDihasilkanB17_2 = document.querySelector(
            'input[name="JumlahYangDihasilkanB17_2"]'
        ).value;
    } else {
        JumlahYangDihasilkanB17_2 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB17_3']").val() != "") {
        JumlahYangDihasilkanB17_3 = document.querySelector(
            'input[name="JumlahYangDihasilkanB17_3"]'
        ).value;
    } else {
        JumlahYangDihasilkanB17_3 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB17_4']").val() != "") {
        JumlahYangDihasilkanB17_4 = document.querySelector(
            'input[name="JumlahYangDihasilkanB17_4"]'
        ).value;
    } else {
        JumlahYangDihasilkanB17_4 = 0;
    }
    // cek nilai apakah nilainya ada jika tidak ada maka di isi ( 0 )
    if ($("input[name='JumlahYangDihasilkanB17_5']").val() != "") {
        JumlahYangDihasilkanB17_5 = document.querySelector(
            'input[name="JumlahYangDihasilkanB17_5"]'
        ).value;
    } else {
        JumlahYangDihasilkanB17_5 = 0;
    }

    // Merubah nilai inputan ke integer Pokok point
    //Kalkulasi Nilai (SKOR)
    var SkorB1 = parseInt(B1);
    var SkorB2 = parseInt(B2);
    var SkorB3 = parseInt(B3);
    var SkorB4 = parseInt(B4);
    var SkorB5 = parseInt(B5);
    var SkorB6 = parseInt(B6);
    var SkorB7 = parseInt(B7);
    var SkorB8 = parseInt(B8);
    var SkorB9 = parseInt(B9);
    var SkorB10 = parseInt(B10);
    var SkorB11 = parseInt(B11);
    var SkorB12 = parseInt(B12);
    var SkorB13 = parseInt(B13);
    var SkorB14 = parseInt(B14);
    var SkorB15 = parseInt(B15);
    var SkorB16 = parseInt(B16);
    var SkorB17 = parseInt(B17);
    var SkorB18 = parseInt(B18);

    // Point Tambahan
    // Merubah Kenilai Integer
    // Merubah nilai menjadi Int dan di jadikan variable
    var resultJumlahYangDihasilkanB1_2 = parseInt(JumlahYangDihasilkanB1_2);
    var resultJumlahYangDihasilkanB1_3 = parseInt(JumlahYangDihasilkanB1_3);
    var resultJumlahYangDihasilkanB1_4 = parseInt(JumlahYangDihasilkanB1_4);
    var resultJumlahYangDihasilkanB1_5 = parseInt(JumlahYangDihasilkanB1_5);
    var resultJumlahYangDihasilkanB2_4 = parseInt(JumlahYangDihasilkanB2_4);
    var resultJumlahYangDihasilkanB2_5 = parseInt(JumlahYangDihasilkanB2_5);
    var resultJumlahYangDihasilkanB3_4 = parseInt(JumlahYangDihasilkanB3_4);
    var resultJumlahYangDihasilkanB3_5 = parseInt(JumlahYangDihasilkanB3_5);
    var resultJumlahYangDihasilkanB5_5 = parseInt(JumlahYangDihasilkanB5_5);
    var resultJumlahYangDihasilkanB6_5 = parseInt(JumlahYangDihasilkanB6_5);
    var resultJumlahYangDihasilkanB7_5 = parseInt(JumlahYangDihasilkanB7_5);
    var resultJumlahYangDihasilkanB9_3 = parseInt(JumlahYangDihasilkanB9_3);
    var resultJumlahYangDihasilkanB9_5 = parseInt(JumlahYangDihasilkanB9_5);
    var resultJumlahYangDihasilkanB10_3 = parseInt(JumlahYangDihasilkanB10_3);
    var resultJumlahYangDihasilkanB10_5 = parseInt(JumlahYangDihasilkanB10_5);
    var resultJumlahYangDihasilkanB11_5 = parseInt(JumlahYangDihasilkanB11_5);
    var resultJumlahYangDihasilkanB12_5 = parseInt(JumlahYangDihasilkanB12_5);
    var resultJumlahYangDihasilkanB13_3 = parseInt(JumlahYangDihasilkanB13_3);
    var resultJumlahYangDihasilkanB13_4 = parseInt(JumlahYangDihasilkanB13_4);
    var resultJumlahYangDihasilkanB13_5 = parseInt(JumlahYangDihasilkanB13_5);
    var resultJumlahYangDihasilkanB14_2 = parseInt(JumlahYangDihasilkanB14_2);
    var resultJumlahYangDihasilkanB14_3 = parseInt(JumlahYangDihasilkanB14_3);
    var resultJumlahYangDihasilkanB14_4 = parseInt(JumlahYangDihasilkanB14_4);
    var resultJumlahYangDihasilkanB14_5 = parseInt(JumlahYangDihasilkanB14_5);
    var resultJumlahYangDihasilkanB15_3 = parseInt(JumlahYangDihasilkanB15_3);
    var resultJumlahYangDihasilkanB15_4 = parseInt(JumlahYangDihasilkanB15_4);
    var resultJumlahYangDihasilkanB15_5 = parseInt(JumlahYangDihasilkanB15_5);
    var resultJumlahYangDihasilkanB17_2 = parseInt(JumlahYangDihasilkanB17_2);
    var resultJumlahYangDihasilkanB17_3 = parseInt(JumlahYangDihasilkanB17_3);
    var resultJumlahYangDihasilkanB17_4 = parseInt(JumlahYangDihasilkanB17_4);
    var resultJumlahYangDihasilkanB17_5 = parseInt(JumlahYangDihasilkanB17_5);

    // Skor inputan nilai setelah di rubah ke integer di bagi 5
    //Kalkulasi Nilai (SKOR/SKOR MAKS)
    var skorMaksB1 = SkorB1 / 5;
    var skorMaksB2 = SkorB2 / 5;
    var skorMaksB3 = SkorB3 / 5;
    var skorMaksB4 = SkorB4 / 5;
    var skorMaksB5 = SkorB5 / 5;
    var skorMaksB6 = SkorB6 / 5;
    var skorMaksB7 = SkorB7 / 5;
    var skorMaksB8 = SkorB8 / 5;
    var skorMaksB9 = SkorB9 / 5;
    var skorMaksB10 = SkorB10 / 5;
    var skorMaksB11 = SkorB11 / 5;
    var skorMaksB12 = SkorB12 / 5;
    var skorMaksB13 = SkorB13 / 5;
    var skorMaksB14 = SkorB14 / 5;
    var skorMaksB15 = SkorB15 / 5;
    var skorMaksB16 = SkorB16 / 5;
    var skorMaksB17 = SkorB17 / 5;
    var skorMaksB18 = SkorB18 / 5;

    // nilai inputan setelah di bagi sekarang di kalikan sesuai rumus excel Pokok point
    //Kalkulasi Nilai (SKOR*BOBOT SUB ITEM)
    if ($("input[name='B1']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB1 = num.toFixed(3);
    } else {
        var scorSubItemB1 = ((skorMaksB1 * 5) / 100).toFixed(3);
    }
    if ($("input[name='B2']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB2 = num.toFixed(3);
    } else {
        var scorSubItemB2 = ((skorMaksB2 * 4) / 100).toFixed(3);
    }
    if ($("input[name='B3']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB3 = num.toFixed(3);
    } else {
        var scorSubItemB3 = ((skorMaksB3 * 6) / 100).toFixed(3);
    }
    if ($("input[name='B4']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB4 = num.toFixed(3);
    } else {
        var scorSubItemB4 = ((skorMaksB4 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B5']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB5 = num.toFixed(3);
    } else {
        var scorSubItemB5 = ((skorMaksB5 * 7) / 100).toFixed(3);
    }
    if ($("input[name='B6']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB6 = num.toFixed(3);
    } else {
        var scorSubItemB6 = ((skorMaksB6 * 5) / 100).toFixed(3);
    }
    if ($("input[name='B7']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB7 = num.toFixed(3);
    } else {
        var scorSubItemB7 = ((skorMaksB7 * 4) / 100).toFixed(3);
    }
    if ($("input[name='B8']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB8 = num.toFixed(3);
    } else {
        var scorSubItemB8 = ((skorMaksB8 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B9']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB9 = num.toFixed(3);
    } else {
        var scorSubItemB9 = ((skorMaksB9 * 4) / 100).toFixed(3);
    }
    if ($("input[name='B10']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB10 = num.toFixed(3);
    } else {
        var scorSubItemB10 = ((skorMaksB10 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B11']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB11 = num.toFixed(3);
    } else {
        var scorSubItemB11 = ((skorMaksB11 * 4) / 100).toFixed(3);
    }
    if ($("input[name='B12']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB12 = num.toFixed(3);
    } else {
        var scorSubItemB12 = ((skorMaksB12 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B13']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB13 = num.toFixed(3);
    } else {
        var scorSubItemB13 = ((skorMaksB13 * 2) / 100).toFixed(3);
    }
    if ($("input[name='B14']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB14 = num.toFixed(3);
    } else {
        var scorSubItemB14 = ((skorMaksB14 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B15']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB15 = num.toFixed(3);
    } else {
        var scorSubItemB15 = ((skorMaksB15 * 4) / 100).toFixed(3);
    }
    if ($("input[name='B16']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB16 = num.toFixed(3);
    } else {
        var scorSubItemB16 = ((skorMaksB16 * 3) / 100).toFixed(3);
    }
    if ($("input[name='B17']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB17 = num.toFixed(3);
    } else {
        var scorSubItemB17 = ((skorMaksB17 * 7) / 100).toFixed(3);
    }
    if ($("input[name='B18']:checked").val() == 1) {
        var num = 0;
        var scorSubItemB18 = num.toFixed(3);
    } else {
        var scorSubItemB18 = ((skorMaksB18 * 3) / 100).toFixed(3);
    }

    // Point Tambahan Hasil Integer dikalikan nilai sesuai di excel
    // jumlah input nilai akan di kalikan 3 atau sesuai rumus excel
    var resultDikalikanB1_2 = resultJumlahYangDihasilkanB1_2 * 2;
    var resultDikalikanB1_3 = resultJumlahYangDihasilkanB1_3 * 3;
    var resultDikalikanB1_4 = resultJumlahYangDihasilkanB1_4 * 3.5;
    var resultDikalikanB1_5 = resultJumlahYangDihasilkanB1_5 * 4;
    var resultDikalikanB2_4 = resultJumlahYangDihasilkanB2_4 * 1.5;
    var resultDikalikanB2_5 = resultJumlahYangDihasilkanB2_5 * 2;
    var resultDikalikanB3_4 = resultJumlahYangDihasilkanB3_4 * 1.5;
    var resultDikalikanB3_5 = resultJumlahYangDihasilkanB3_5 * 2;
    var resultDikalikanB5_5 = resultJumlahYangDihasilkanB5_5 * 3;
    var resultDikalikanB6_5 = resultJumlahYangDihasilkanB6_5 * 3;
    var resultDikalikanB7_5 = resultJumlahYangDihasilkanB7_5 * 1;
    var resultDikalikanB9_3 = resultJumlahYangDihasilkanB9_3 * 0.5;
    var resultDikalikanB9_5 = resultJumlahYangDihasilkanB9_5 * 1;
    var resultDikalikanB10_3 = resultJumlahYangDihasilkanB10_3 * 0.5;
    var resultDikalikanB10_5 = resultJumlahYangDihasilkanB10_5 * 1;
    var resultDikalikanB11_5 = resultJumlahYangDihasilkanB11_5 * 1;
    var resultDikalikanB12_5 = resultJumlahYangDihasilkanB12_5 * 1;
    var resultDikalikanB13_3 = resultJumlahYangDihasilkanB13_3 * 0.5;
    var resultDikalikanB13_4 = resultJumlahYangDihasilkanB13_4 * 0.75;
    var resultDikalikanB13_5 = resultJumlahYangDihasilkanB13_5 * 1;
    var resultDikalikanB14_2 = resultJumlahYangDihasilkanB14_2 * 0.75;
    var resultDikalikanB14_3 = resultJumlahYangDihasilkanB14_3 * 1;
    var resultDikalikanB14_4 = resultJumlahYangDihasilkanB14_4 * 1.5;
    var resultDikalikanB14_5 = resultJumlahYangDihasilkanB14_5 * 2;
    var resultDikalikanB15_3 = resultJumlahYangDihasilkanB15_3 * 1;
    var resultDikalikanB15_4 = resultJumlahYangDihasilkanB15_4 * 1.5;
    var resultDikalikanB15_5 = resultJumlahYangDihasilkanB15_5 * 2;
    var resultDikalikanB17_2 = resultJumlahYangDihasilkanB17_2 * 0.5;
    var resultDikalikanB17_3 = resultJumlahYangDihasilkanB17_3 * 1;
    var resultDikalikanB17_4 = resultJumlahYangDihasilkanB17_4 * 1.5;
    var resultDikalikanB17_5 = resultJumlahYangDihasilkanB17_5 * 3;

    // Pokok point menampilkan hasil nilai di interfaces jumlah point point
    // Menampilkan nilai skor di form disabled
    if (!isNaN(SkorB1)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        // Tampilkan output pada input form skor
        document.getElementById("scorB1").value = SkorB1;
    }
    if (!isNaN(SkorB2)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB2").value = SkorB2;
    }
    if (!isNaN(SkorB3)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB3").value = SkorB3;
    }
    if (!isNaN(SkorB4)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB4").value = SkorB4;
    }
    if (!isNaN(SkorB5)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB5").value = SkorB5;
    }
    if (!isNaN(SkorB6)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB6").value = SkorB6;
    }
    if (!isNaN(SkorB7)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB7").value = SkorB7;
    }
    if (!isNaN(SkorB8)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB8").value = SkorB8;
    }
    if (!isNaN(SkorB9)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB9").value = SkorB9;
    }
    if (!isNaN(SkorB10)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB10").value = SkorB10;
    }
    if (!isNaN(SkorB11)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB11").value = SkorB11;
    }
    if (!isNaN(SkorB12)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB12").value = SkorB12;
    }
    if (!isNaN(SkorB13)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB13").value = SkorB13;
    }
    if (!isNaN(SkorB14)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB14").value = SkorB14;
    }
    if (!isNaN(SkorB15)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB15").value = SkorB15;
    }
    if (!isNaN(SkorB16)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB16").value = SkorB16;
    }
    if (!isNaN(SkorB17)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB17").value = SkorB17;
    }
    if (!isNaN(SkorB18)) {
        // Cek agar tidak keluar Nilai diluar Parameter
        document.getElementById("scorB18").value = SkorB18;
    }

    // Menampilkan nilai Pokok point skor / Skor Maks di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(skorMaksB1)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB1").value = skorMaksB1;
    }
    if (!isNaN(skorMaksB2)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB2").value = skorMaksB2;
    }
    if (!isNaN(skorMaksB3)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB3").value = skorMaksB3;
    }
    if (!isNaN(skorMaksB4)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB4").value = skorMaksB4;
    }
    if (!isNaN(skorMaksB5)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB5").value = skorMaksB5;
    }
    if (!isNaN(skorMaksB6)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB6").value = skorMaksB6;
    }
    if (!isNaN(skorMaksB7)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB7").value = skorMaksB7;
    }
    if (!isNaN(skorMaksB8)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB8").value = skorMaksB8;
    }
    if (!isNaN(skorMaksB9)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB9").value = skorMaksB9;
    }
    if (!isNaN(skorMaksB10)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB10").value = skorMaksB10;
    }
    if (!isNaN(skorMaksB11)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB11").value = skorMaksB11;
    }
    if (!isNaN(skorMaksB12)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB12").value = skorMaksB12;
    }
    if (!isNaN(skorMaksB13)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB13").value = skorMaksB13;
    }
    if (!isNaN(skorMaksB14)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB14").value = skorMaksB14;
    }
    if (!isNaN(skorMaksB15)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB15").value = skorMaksB15;
    }
    if (!isNaN(skorMaksB16)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB16").value = skorMaksB16;
    }
    if (!isNaN(skorMaksB17)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB17").value = skorMaksB17;
    }
    if (!isNaN(skorMaksB18)) {
        // Tampilkan output pada input form skor / skor maks
        document.getElementById("scorMaxB18").value = skorMaksB18;
    }

    // Menampilkan nilai Pokok point skor * Bpbpt Sub Item di form disabled
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(scorSubItemB1)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB1").value = scorSubItemB1;
    }
    if (!isNaN(scorSubItemB2)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB2").value = scorSubItemB2;
    }
    if (!isNaN(scorSubItemB3)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB3").value = scorSubItemB3;
    }
    if (!isNaN(scorSubItemB4)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB4").value = scorSubItemB4;
    }
    if (!isNaN(scorSubItemB5)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB5").value = scorSubItemB5;
    }
    if (!isNaN(scorSubItemB6)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB6").value = scorSubItemB6;
    }
    if (!isNaN(scorSubItemB7)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB7").value = scorSubItemB7;
    }
    if (!isNaN(scorSubItemB8)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB8").value = scorSubItemB8;
    }
    if (!isNaN(scorSubItemB9)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB9").value = scorSubItemB9;
    }
    if (!isNaN(scorSubItemB10)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB10").value = scorSubItemB10;
    }
    if (!isNaN(scorSubItemB11)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB11").value = scorSubItemB11;
    }
    if (!isNaN(scorSubItemB12)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB12").value = scorSubItemB12;
    }
    if (!isNaN(scorSubItemB13)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB13").value = scorSubItemB13;
    }
    if (!isNaN(scorSubItemB14)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB14").value = scorSubItemB14;
    }
    if (!isNaN(scorSubItemB15)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB15").value = scorSubItemB15;
    }
    if (!isNaN(scorSubItemB16)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB16").value = scorSubItemB16;
    }
    if (!isNaN(scorSubItemB17)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB17").value = scorSubItemB17;
    }
    if (!isNaN(scorSubItemB18)) {
        // Tampilkan output pada input form skor * Bobot Sub Item
        document.getElementById("scorSubItemB18").value = scorSubItemB18;
    }

    // Menampilkan hasil di kalikan di baris Skor Tambahan dari jumlah Point Tambahan B.1
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB1_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB1_2").value = resultDikalikanB1_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB1_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB1_3").value = resultDikalikanB1_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB1_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB1_4").value = resultDikalikanB1_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB1_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB1_5").value = resultDikalikanB1_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB2_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB2_4").value = resultDikalikanB2_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB2_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB2_5").value = resultDikalikanB2_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB3_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB3_4").value = resultDikalikanB3_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB3_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB3_5").value = resultDikalikanB3_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB5_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB5_5").value = resultDikalikanB5_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB6_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB6_5").value = resultDikalikanB6_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB7_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB7_5").value = resultDikalikanB7_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB9_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB9_3").value = resultDikalikanB9_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB9_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB9_5").value = resultDikalikanB9_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB10_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB10_3").value =
            resultDikalikanB10_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB10_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB10_5").value =
            resultDikalikanB10_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB11_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB11_5").value =
            resultDikalikanB11_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB12_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB12_5").value =
            resultDikalikanB12_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB13_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB13_3").value =
            resultDikalikanB13_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB13_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB13_4").value =
            resultDikalikanB13_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB13_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB13_5").value =
            resultDikalikanB13_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB14_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB14_2").value =
            resultDikalikanB14_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB14_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB14_3").value =
            resultDikalikanB14_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB14_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB14_4").value =
            resultDikalikanB14_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB14_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB14_5").value =
            resultDikalikanB14_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB15_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB15_3").value =
            resultDikalikanB15_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB15_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB15_4").value =
            resultDikalikanB15_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB15_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB15_5").value =
            resultDikalikanB15_5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB17_2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB17_2").value =
            resultDikalikanB17_2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB17_3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB17_3").value =
            resultDikalikanB17_3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB17_4)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB17_4").value =
            resultDikalikanB17_4;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(resultDikalikanB17_5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanB17_5").value =
            resultDikalikanB17_5;
    }

    // SUM B.1 kolom Bukti Pendukung
    // SUM Skor Point B.1
    if (
        resultDikalikanB1_2 == "" ||
        resultDikalikanB1_3 == "" ||
        resultDikalikanB1_4 == "" ||
        resultDikalikanB1_5 == ""
    ) {
        var sumResultB1 =
            resultDikalikanB1_2 +
            resultDikalikanB1_3 +
            resultDikalikanB1_4 +
            resultDikalikanB1_5;
    } else {
        var sumResultB1 =
            resultDikalikanB1_2 +
            resultDikalikanB1_3 +
            resultDikalikanB1_4 +
            resultDikalikanB1_5;
    }
    // SUM B.2 kolom Bukti Pendukung
    if (resultDikalikanB2_4 == "" || resultDikalikanB2_5 == "") {
        var sumResultB2 = resultDikalikanB2_4 + resultDikalikanB2_5;
    } else {
        var sumResultB2 = resultDikalikanB2_4 + resultDikalikanB2_5;
    }
    // SUM B.3 kolom Bukti Pendukung
    if (resultDikalikanB3_4 == "" || resultDikalikanB3_5 == "") {
        var sumResultB3 = resultDikalikanB3_4 + resultDikalikanB3_5;
    } else {
        var sumResultB3 = resultDikalikanB3_4 + resultDikalikanB3_5;
    }
    // SUM B.5 kolom Bukti Pendukung
    if (resultDikalikanB5_5 == "") {
        var sumResultB5 = resultDikalikanB5_5;
    } else {
        var sumResultB5 = resultDikalikanB5_5;
    }
    // SUM B.6 kolom Bukti Pendukung
    if (resultDikalikanB6_5 == "") {
        var sumResultB6 = resultDikalikanB6_5;
    } else {
        var sumResultB6 = resultDikalikanB6_5;
    }
    // SUM B.7 kolom Bukti Pendukung
    if (resultDikalikanB7_5 == "") {
        var sumResultB7 = resultDikalikanB7_5;
    } else {
        var sumResultB7 = resultDikalikanB7_5;
    }
    // SUM B.9 kolom Bukti Pendukung
    if (resultDikalikanB9_3 == "" || resultDikalikanB9_5 == "") {
        var sumResultB9 = resultDikalikanB9_3 + resultDikalikanB9_5;
    } else {
        var sumResultB9 = resultDikalikanB9_3 + resultDikalikanB9_5;
    }
    // SUM B.10 kolom Bukti Pendukung
    if (resultDikalikanB10_3 == "" || resultDikalikanB10_5 == "") {
        var sumResultB10 = resultDikalikanB10_3 + resultDikalikanB10_5;
    } else {
        var sumResultB10 = resultDikalikanB10_3 + resultDikalikanB10_5;
    }
    // SUM B.11 kolom Bukti Pendukung
    if (resultDikalikanB11_5 == "") {
        var sumResultB11 = resultDikalikanB11_5;
    } else {
        var sumResultB11 = resultDikalikanB11_5;
    }
    // SUM Skor Point B.12
    if (resultDikalikanB12_5 == "") {
        var sumResultB12 = resultDikalikanB12_5;
    } else {
        var sumResultB12 = resultDikalikanB12_5;
    }
    // SUM Skor Point B.13
    if (
        resultDikalikanB13_3 == "" ||
        resultDikalikanB13_4 == "" ||
        resultDikalikanB13_5 == ""
    ) {
        var sumResultB13 =
            resultDikalikanB13_3 + resultDikalikanB13_4 + resultDikalikanB13_5;
    } else {
        var sumResultB13 =
            resultDikalikanB13_3 + resultDikalikanB13_4 + resultDikalikanB13_5;
    }
    // SUM Skor Point B.14
    if (
        resultDikalikanB14_2 == "" ||
        resultDikalikanB14_3 == "" ||
        resultDikalikanB14_4 == "" ||
        resultDikalikanB14_5 == ""
    ) {
        var sumResultB14 =
            resultDikalikanB14_2 +
            resultDikalikanB14_3 +
            resultDikalikanB14_4 +
            resultDikalikanB14_5;
    } else {
        var sumResultB14 =
            resultDikalikanB14_2 +
            resultDikalikanB14_3 +
            resultDikalikanB14_4 +
            resultDikalikanB14_5;
    }
    // SUM Skor Point B.15
    if (
        resultDikalikanB15_3 == "" ||
        resultDikalikanB15_4 == "" ||
        resultDikalikanB15_5 == ""
    ) {
        var sumResultB15 =
            resultDikalikanB15_3 + resultDikalikanB15_4 + resultDikalikanB15_5;
    } else {
        var sumResultB15 =
            resultDikalikanB15_3 + resultDikalikanB15_4 + resultDikalikanB15_5;
    }
    // SUM Skor Point B.1
    if (
        resultDikalikanB17_2 == "" ||
        resultDikalikanB17_3 == "" ||
        resultDikalikanB17_4 == "" ||
        resultDikalikanB17_5 == ""
    ) {
        var sumResultB17 =
            resultDikalikanB17_2 +
            resultDikalikanB17_3 +
            resultDikalikanB17_4 +
            resultDikalikanB17_5;
    } else {
        var sumResultB17 =
            resultDikalikanB17_2 +
            resultDikalikanB17_3 +
            resultDikalikanB17_4 +
            resultDikalikanB17_5;
    }

    // Menampilkan Hasil SUM Point tambahan di kolom Bukti Pendukung B.1
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB1)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB1").value = sumResultB1;
    }
    // Menampilkan Hasil SUM Point tambahan di kolom Bukti Pendukung B.2
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB2)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB2").value = sumResultB2;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB3)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB3").value = sumResultB3;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB5)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB5").value = sumResultB5;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB6)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB6").value = sumResultB6;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB7)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB7").value = sumResultB7;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB9)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB9").value = sumResultB9;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB10)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB10").value = sumResultB10;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB11)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB11").value = sumResultB11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB12)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB12").value = sumResultB12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB13)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB13").value = sumResultB13;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB14)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB14").value = sumResultB14;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB15)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB15").value = sumResultB15;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(sumResultB17)) {
        // Tampilkan output pada input form nilai
        document.getElementById("SkorTambahanJumlahB17").value = sumResultB17;
    }

    // Point Tambahan
    // cwk nilai apakah nilai lebih dari samadengan, jika iya akan di bagi sesuai di excel jika tidak akan di bagi 0
    // B.1
    if (sumResultB1 >= 4) {
        var numB1 = 4;
        var nilaiDibagi100B1 = (numB1 / 100).toFixed(3);
    } else if (sumResultB1 <= 4) {
        var numB1 = sumResultB1;
        var nilaiDibagi100B1 = (numB1 / 100).toFixed(3);
    }
    // B.2
    if (sumResultB2 >= 2) {
        var numB2 = 2;
        var nilaiDibagi100B2 = (numB2 / 100).toFixed(3);
    } else if (sumResultB2 <= 2) {
        var numB2 = sumResultB2;
        var nilaiDibagi100B2 = (numB2 / 100).toFixed(3);
    }
    // B.3
    if (sumResultB3 >= 2) {
        var numB3 = 2;
        var nilaiDibagi100B3 = (numB3 / 100).toFixed(3);
    } else if (sumResultB3 <= 2) {
        var numB3 = sumResultB3;
        var nilaiDibagi100B3 = (numB3 / 100).toFixed(3);
    }
    // B.5
    if (sumResultB5 >= 3) {
        var numB5 = 3;
        var nilaiDibagi100B5 = (numB5 / 100).toFixed(3);
    } else if (sumResultB5 <= 3) {
        var numB5 = sumResultB5;
        var nilaiDibagi100B5 = (numB5 / 100).toFixed(3);
    }
    // B.6
    if (sumResultB6 >= 3) {
        var numB6 = 3;
        var nilaiDibagi100B6 = (numB6 / 100).toFixed(3);
    } else if (sumResultB6 <= 3) {
        var numB6 = sumResultB6;
        var nilaiDibagi100B6 = (numB6 / 100).toFixed(3);
    }
    // B.7
    if (sumResultB7 >= 1) {
        var numB7 = 1;
        var nilaiDibagi100B7 = (numB7 / 100).toFixed(3);
    } else if (sumResultB7 <= 1) {
        var numB7 = sumResultB7;
        var nilaiDibagi100B7 = (numB7 / 100).toFixed(3);
    }
    // B.9
    if (sumResultB9 >= 1) {
        var numB9 = 1;
        var nilaiDibagi100B9 = (numB9 / 100).toFixed(3);
    } else if (sumResultB9 <= 1) {
        var numB9 = sumResultB9;
        var nilaiDibagi100B9 = (numB9 / 100).toFixed(3);
    }
    // B.10
    if (sumResultB10 >= 1) {
        var numB10 = 1;
        var nilaiDibagi100B10 = (numB10 / 100).toFixed(3);
    } else if (sumResultB10 <= 1) {
        var numB10 = sumResultB10;
        var nilaiDibagi100B10 = (numB10 / 100).toFixed(3);
    }
    // B.11
    if (sumResultB11 >= 1) {
        var numB11 = 1;
        var nilaiDibagi100B11 = (numB11 / 100).toFixed(3);
    } else if (sumResultB11 <= 1) {
        var numB11 = sumResultB11;
        var nilaiDibagi100B11 = (numB11 / 100).toFixed(3);
    }
    // B.12
    if (sumResultB12 >= 1) {
        var numB12 = 1;
        var nilaiDibagi100B12 = (numB12 / 100).toFixed(3);
    } else if (sumResultB12 <= 1) {
        var numB12 = sumResultB12;
        var nilaiDibagi100B12 = (numB12 / 100).toFixed(3);
    }
    // B.13
    if (sumResultB13 >= 1) {
        var numB13 = 1;
        var nilaiDibagi100B13 = (numB13 / 100).toFixed(3);
    } else if (sumResultB13 <= 1) {
        var numB13 = sumResultB13;
        var nilaiDibagi100B13 = (numB13 / 100).toFixed(3);
    }
    // B.14
    if (sumResultB14 >= 2) {
        var numB14 = 2;
        var nilaiDibagi100B14 = (numB14 / 100).toFixed(3);
    } else if (sumResultB14 <= 2) {
        var numB14 = sumResultB14;
        var nilaiDibagi100B14 = (numB14 / 100).toFixed(3);
    }
    // B.15
    if (sumResultB15 >= 2) {
        var numB15 = 2;
        var nilaiDibagi100B15 = (numB15 / 100).toFixed(3);
    } else if (sumResultB15 <= 2) {
        var numB15 = sumResultB15;
        var nilaiDibagi100B15 = (numB15 / 100).toFixed(3);
    }
    // B.15
    if (sumResultB17 >= 3) {
        var numB17 = 3;
        var nilaiDibagi100B17 = (numB17 / 100).toFixed(3);
    } else if (sumResultB17 <= 3) {
        var numB17 = sumResultB17;
        var nilaiDibagi100B17 = (numB17 / 100).toFixed(3);
    }

    // Point Tambahan menampilkan hasil di interfaces skor/skor maks
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB1)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB1").value = numB1;
    }
    if (!isNaN(numB2)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB2").value = numB2;
    }
    if (!isNaN(numB3)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB3").value = numB3;
    }
    if (!isNaN(numB5)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB5").value = numB5;
    }
    if (!isNaN(numB6)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB6").value = numB6;
    }
    if (!isNaN(numB7)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB7").value = numB7;
    }
    if (!isNaN(numB9)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB9").value = numB9;
    }
    if (!isNaN(numB10)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB10").value = numB10;
    }
    if (!isNaN(numB11)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB11").value = numB11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB12)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB12").value = numB12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB13)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB13").value = numB13;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB14)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB14").value = numB14;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB15)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB15").value = numB15;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(numB17)) {
        // Tampilkan output pada input form nilai numA11
        document.getElementById("JumlahSkorYangDiHasilkanB17").value = numB17;
    }

    // Point Tambahan intefaces Skor X Bobot sub item
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B1)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB1").value =
            nilaiDibagi100B1;
    }
    if (!isNaN(nilaiDibagi100B2)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB2").value =
            nilaiDibagi100B2;
    }
    if (!isNaN(nilaiDibagi100B3)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB3").value =
            nilaiDibagi100B3;
    }
    if (!isNaN(nilaiDibagi100B5)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB5").value =
            nilaiDibagi100B5;
    }
    if (!isNaN(nilaiDibagi100B6)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB6").value =
            nilaiDibagi100B6;
    }
    if (!isNaN(nilaiDibagi100B7)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB7").value =
            nilaiDibagi100B7;
    }
    if (!isNaN(nilaiDibagi100B9)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB9").value =
            nilaiDibagi100B9;
    }
    if (!isNaN(nilaiDibagi100B10)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB10").value =
            nilaiDibagi100B10;
    }
    if (!isNaN(nilaiDibagi100B11)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB11").value =
            nilaiDibagi100B11;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B12)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB12").value =
            nilaiDibagi100B12;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B13)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB13").value =
            nilaiDibagi100B13;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B14)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB14").value =
            nilaiDibagi100B14;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B15)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB15").value =
            nilaiDibagi100B15;
    }
    // Cek agar tidak keluar Nilai diluar Parameter
    if (!isNaN(nilaiDibagi100B17)) {
        // Tampilkan output pada input form hasil pembagian num / 100
        document.getElementById("SkorTambahanJumlahSkorB17").value =
            nilaiDibagi100B17;
    }

    //Kalkulasi Nilai (SUM) Point tambahan dan Point Pokok
    var resultSumB1 = parseFloat(nilaiDibagi100B1) + parseFloat(scorSubItemB1);
    var resultSumB2 = parseFloat(nilaiDibagi100B2) + parseFloat(scorSubItemB2);
    var resultSumB3 = parseFloat(nilaiDibagi100B3) + parseFloat(scorSubItemB3);
    var resultSumB5 = parseFloat(nilaiDibagi100B5) + parseFloat(scorSubItemB5);
    var resultSumB6 = parseFloat(nilaiDibagi100B6) + parseFloat(scorSubItemB6);
    var resultSumB7 = parseFloat(nilaiDibagi100B7) + parseFloat(scorSubItemB7);
    var resultSumB9 = parseFloat(nilaiDibagi100B9) + parseFloat(scorSubItemB9);
    var resultSumB10 =
        parseFloat(nilaiDibagi100B10) + parseFloat(scorSubItemB10);
    var resultSumB11 =
        parseFloat(nilaiDibagi100B11) + parseFloat(scorSubItemB11);
    var resultSumB12 =
        parseFloat(nilaiDibagi100B12) + parseFloat(scorSubItemB12);
    var resultSumB13 =
        parseFloat(nilaiDibagi100B13) + parseFloat(scorSubItemB13);
    var resultSumB14 =
        parseFloat(nilaiDibagi100B14) + parseFloat(scorSubItemB14);
    var resultSumB15 =
        parseFloat(nilaiDibagi100B15) + parseFloat(scorSubItemB15);
    var resultSumB17 =
        parseFloat(nilaiDibagi100B17) + parseFloat(scorSubItemB17);

    // Merubah format nilai ke 0.000
    var resultSumtoFixedB1 = resultSumB1.toFixed(3);
    var resultSumtoFixedB2 = resultSumB2.toFixed(3);
    var resultSumtoFixedB3 = resultSumB3.toFixed(3);
    var resultSumtoFixedB5 = resultSumB5.toFixed(3);
    var resultSumtoFixedB6 = resultSumB6.toFixed(3);
    var resultSumtoFixedB7 = resultSumB7.toFixed(3);
    var resultSumtoFixedB9 = resultSumB9.toFixed(3);
    var resultSumtoFixedB10 = resultSumB10.toFixed(3);
    var resultSumtoFixedB11 = resultSumB11.toFixed(3);
    var resultSumtoFixedB12 = resultSumB12.toFixed(3);
    var resultSumtoFixedB13 = resultSumB13.toFixed(3);
    var resultSumtoFixedB14 = resultSumB14.toFixed(3);
    var resultSumtoFixedB15 = resultSumB15.toFixed(3);
    var resultSumtoFixedB17 = resultSumB17.toFixed(3);

    // Result SUM Pokok Point + Point Tambahan dan di tampilkan di kolom skor X Bobot sub item baris Skor tambahan dari jumlah
    if (!isNaN(resultSumtoFixedB1)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB1").value =
            resultSumtoFixedB1;
    }
    if (!isNaN(resultSumtoFixedB2)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB2").value =
            resultSumtoFixedB2;
    }
    if (!isNaN(resultSumtoFixedB3)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB3").value =
            resultSumtoFixedB3;
    }
    if (!isNaN(resultSumtoFixedB5)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB5").value =
            resultSumtoFixedB5;
    }
    if (!isNaN(resultSumtoFixedB6)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB6").value =
            resultSumtoFixedB6;
    }
    if (!isNaN(resultSumtoFixedB7)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB7").value =
            resultSumtoFixedB7;
    }
    if (!isNaN(resultSumtoFixedB9)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB9").value =
            resultSumtoFixedB9;
    }
    if (!isNaN(resultSumtoFixedB10)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB10").value =
            resultSumtoFixedB10;
    }
    if (!isNaN(resultSumtoFixedB11)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB11").value =
            resultSumtoFixedB11;
    }
    if (!isNaN(resultSumtoFixedB12)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB12").value =
            resultSumtoFixedB12;
    }
    if (!isNaN(resultSumtoFixedB13)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB13").value =
            resultSumtoFixedB13;
    }
    if (!isNaN(resultSumtoFixedB14)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB14").value =
            resultSumtoFixedB14;
    }
    if (!isNaN(resultSumtoFixedB15)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB15").value =
            resultSumtoFixedB15;
    }
    if (!isNaN(resultSumtoFixedB17)) {
        // Tampilkan output pada input form
        document.getElementById("SkorTambahanJumlahBobotSubItemB17").value =
            resultSumtoFixedB17;
    }

    // SUM TOTAL POINT
    if (
        resultSumtoFixedB1 == "" ||
        resultSumtoFixedB2 == "" ||
        resultSumtoFixedB3 == "" ||
        scorSubItemB4 == "" ||
        resultSumtoFixedB5 == "" ||
        resultSumtoFixedB6 == "" ||
        resultSumtoFixedB7 == "" ||
        scorSubItemB8 == "" ||
        resultSumtoFixedB9 == "" ||
        resultSumtoFixedB10 == "" ||
        resultSumtoFixedB11 == "" ||
        resultSumtoFixedB12 == "" ||
        resultSumtoFixedB13 == "" ||
        resultSumtoFixedB14 == "" ||
        resultSumtoFixedB15 == "" ||
        scorSubItemB16 == "" ||
        resultSumtoFixedB17 == "" ||
        scorSubItemB18 == ""
    ) {
        var sumTotal =
            parseFloat(resultSumtoFixedB1) +
            parseFloat(resultSumtoFixedB2) +
            parseFloat(resultSumtoFixedB3) +
            parseFloat(scorSubItemB4) +
            parseFloat(resultSumtoFixedB5) +
            parseFloat(resultSumtoFixedB6) +
            parseFloat(resultSumtoFixedB7) +
            parseFloat(scorSubItemB8) +
            parseFloat(resultSumtoFixedB9) +
            parseFloat(resultSumtoFixedB10) +
            parseFloat(resultSumtoFixedB11) +
            parseFloat(resultSumtoFixedB12) +
            parseFloat(resultSumtoFixedB13) +
            parseFloat(resultSumtoFixedB14) +
            parseFloat(resultSumtoFixedB15) +
            parseFloat(scorSubItemB16) +
            parseFloat(resultSumtoFixedB17) +
            parseFloat(scorSubItemB18);
        var sumResult = sumTotal.toFixed(3);
    } else {
        var sumTotal =
            parseFloat(resultSumtoFixedB1) +
            parseFloat(resultSumtoFixedB2) +
            parseFloat(resultSumtoFixedB3) +
            parseFloat(scorSubItemB4) +
            parseFloat(resultSumtoFixedB5) +
            parseFloat(resultSumtoFixedB6) +
            parseFloat(resultSumtoFixedB7) +
            parseFloat(scorSubItemB8) +
            parseFloat(resultSumtoFixedB9) +
            parseFloat(resultSumtoFixedB10) +
            parseFloat(resultSumtoFixedB11) +
            parseFloat(resultSumtoFixedB12) +
            parseFloat(resultSumtoFixedB13) +
            parseFloat(resultSumtoFixedB14) +
            parseFloat(resultSumtoFixedB15) +
            parseFloat(scorSubItemB16) +
            parseFloat(resultSumtoFixedB17) +
            parseFloat(scorSubItemB18);
        var sumResult = sumTotal.toFixed(3);
    }

    // Menampilkan hasil SUM TOTAL Point
    if (!isNaN(sumResult)) {
        // Tampilkan output pada input form
        document.getElementById("TotalSkorPenelitianPointB").value = sumResult;
    }

    var NilaiPenelitian = parseFloat(sumResult);
    var ResultNilaiPenelitian = NilaiPenelitian * 30;
    var ResultNilaiPenelitian = ResultNilaiPenelitian.toFixed(2);

    // Hasil Nilai penelitian * 30
    if (!isNaN(ResultNilaiPenelitian)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiPenelitian").value =
            ResultNilaiPenelitian;
    }

    // Perkalian Skor Kelebihan
    // B.1
    if (sumResultB1 >= 4) {
        var ResultNilaiDiKurangiB1 = sumResultB1 - 4;
        var resultHasilTambahaB1 = (ResultNilaiDiKurangiB1 * 4) / 100;
    } else {
        var resultHasilTambahaB1 = 0;
    }
    // B.2
    if (sumResultB2 >= 2) {
        var ResultNilaiDiKurangiB2 = sumResultB2 - 2;
        var resultHasilTambahaB2 = (ResultNilaiDiKurangiB2 * 2) / 100;
    } else {
        var resultHasilTambahaB2 = 0;
    }
    // B.3
    if (sumResultB3 >= 2) {
        var ResultNilaiDiKurangiB3 = sumResultB3 - 2;
        var resultHasilTambahaB3 = (ResultNilaiDiKurangiB3 * 2) / 100;
    } else {
        var resultHasilTambahaB3 = 0;
    }
    // B.5
    if (sumResultB5 >= 3) {
        var ResultNilaiDiKurangiB5 = sumResultB5 - 3;
        var resultHasilTambahaB5 = (ResultNilaiDiKurangiB5 * 3) / 100;
    } else {
        var resultHasilTambahaB5 = 0;
    }
    // B.6
    if (sumResultB6 >= 3) {
        var ResultNilaiDiKurangiB6 = sumResultB6 - 3;
        var resultHasilTambahaB6 = (ResultNilaiDiKurangiB6 * 3) / 100;
    } else {
        var resultHasilTambahaB6 = 0;
    }
    // B.7
    if (sumResultB7 >= 2) {
        var ResultNilaiDiKurangiB7 = sumResultB7 - 2;
        var resultHasilTambahaB7 = (ResultNilaiDiKurangiB7 * 1) / 100;
    } else {
        var resultHasilTambahaB7 = 0;
    }
    // B.9
    if (sumResultB9 >= 1) {
        var ResultNilaiDiKurangiB9 = sumResultB9 - 1;
        var resultHasilTambahaB9 = (ResultNilaiDiKurangiB9 * 1) / 100;
    } else {
        var resultHasilTambahaB9 = 0;
    }
    // B.10
    if (sumResultB10 >= 1) {
        var ResultNilaiDiKurangiB10 = sumResultB10 - 1;
        var resultHasilTambahaB10 = (ResultNilaiDiKurangiB10 * 1) / 100;
    } else {
        var resultHasilTambahaB10 = 0;
    }
    // B.11
    if (sumResultB11 >= 1) {
        var ResultNilaiDiKurangiB11 = sumResultB11 - 1;
        var resultHasilTambahaB11 = (ResultNilaiDiKurangiB11 * 1) / 100;
    } else {
        var resultHasilTambahaB11 = 0;
    }
    // B.12
    if (sumResultB12 >= 2) {
        var ResultNilaiDiKurangiB12 = sumResultB12 - 2;
        var resultHasilTambahaB12 = (ResultNilaiDiKurangiB12 * 1) / 100;
    } else {
        var resultHasilTambahaB12 = 0;
    }
    // B.13
    if (sumResultB13 >= 1) {
        var ResultNilaiDiKurangiB13 = sumResultB13 - 1;
        var resultHasilTambahaB13 = (ResultNilaiDiKurangiB13 * 1) / 100;
    } else {
        var resultHasilTambahaB13 = 0;
    }
    // B.14
    if (sumResultB14 >= 2) {
        var ResultNilaiDiKurangiB14 = sumResultB14 - 2;
        var resultHasilTambahaB14 = (ResultNilaiDiKurangiB14 * 2) / 100;
    } else {
        var resultHasilTambahaB14 = 0;
    }
    // B.15
    if (sumResultB15 >= 2) {
        var ResultNilaiDiKurangiB15 = sumResultB15 - 2;
        var resultHasilTambahaB15 = (ResultNilaiDiKurangiB15 * 2) / 100;
    } else {
        var resultHasilTambahaB15 = 0;
    }
    // B.17
    if (sumResultB17 >= 3) {
        var ResultNilaiDiKurangiB17 = sumResultB17 - 3;
        var resultHasilTambahaB17 = (ResultNilaiDiKurangiB17 * 3) / 100;
    } else {
        var resultHasilTambahaB17 = 0;
    }

    // Result Hasil nilai Kelebihan Skor
    if (!isNaN(resultHasilTambahaB1)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB1").value = resultHasilTambahaB1;
    }
    if (!isNaN(resultHasilTambahaB2)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB2").value = resultHasilTambahaB2;
    }
    if (!isNaN(resultHasilTambahaB3)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB3").value = resultHasilTambahaB3;
    }
    if (!isNaN(resultHasilTambahaB5)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB5").value = resultHasilTambahaB5;
    }
    if (!isNaN(resultHasilTambahaB6)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB6").value = resultHasilTambahaB6;
    }
    if (!isNaN(resultHasilTambahaB7)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB7").value = resultHasilTambahaB7;
    }
    if (!isNaN(resultHasilTambahaB9)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB9").value = resultHasilTambahaB9;
    }
    if (!isNaN(resultHasilTambahaB10)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB10").value =
            resultHasilTambahaB10;
    }
    if (!isNaN(resultHasilTambahaB11)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB11").value =
            resultHasilTambahaB11;
    }
    if (!isNaN(resultHasilTambahaB12)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB12").value =
            resultHasilTambahaB12;
    }
    if (!isNaN(resultHasilTambahaB13)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB13").value =
            resultHasilTambahaB13;
    }
    if (!isNaN(resultHasilTambahaB14)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB14").value =
            resultHasilTambahaB14;
    }
    if (!isNaN(resultHasilTambahaB15)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB15").value =
            resultHasilTambahaB15;
    }
    if (!isNaN(resultHasilTambahaB17)) {
        // Tampilkan output pada input form
        document.getElementById("TotalKelebihaB17").value =
            resultHasilTambahaB17;
    }

    // SUM result total kelebihan skor
    if (
        resultHasilTambahaB1 == "" ||
        resultHasilTambahaB2 == "" ||
        resultHasilTambahaB3 == "" ||
        resultHasilTambahaB5 == "" ||
        resultHasilTambahaB6 == "" ||
        resultHasilTambahaB7 == "" ||
        resultHasilTambahaB9 == "" ||
        resultHasilTambahaB10 == "" ||
        resultHasilTambahaB11 == "" ||
        resultHasilTambahaB12 == "" ||
        resultHasilTambahaB13 == "" ||
        resultHasilTambahaB14 == "" ||
        resultHasilTambahaB15 == "" ||
        resultHasilTambahaB17 == ""
    ) {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaB1) +
            parseFloat(resultHasilTambahaB2) +
            parseFloat(resultHasilTambahaB3) +
            parseFloat(resultHasilTambahaB5) +
            parseFloat(resultHasilTambahaB6) +
            parseFloat(resultHasilTambahaB7) +
            parseFloat(resultHasilTambahaB9) +
            parseFloat(resultHasilTambahaB10) +
            parseFloat(resultHasilTambahaB11) +
            parseFloat(resultHasilTambahaB12) +
            parseFloat(resultHasilTambahaB13) +
            parseFloat(resultHasilTambahaB14) +
            parseFloat(resultHasilTambahaB15) +
            parseFloat(resultHasilTambahaB17);
    } else {
        var resultTotalKelebihanSkor =
            parseFloat(resultHasilTambahaB1) +
            parseFloat(resultHasilTambahaB2) +
            parseFloat(resultHasilTambahaB3) +
            parseFloat(resultHasilTambahaB5) +
            parseFloat(resultHasilTambahaB6) +
            parseFloat(resultHasilTambahaB7) +
            parseFloat(resultHasilTambahaB9) +
            parseFloat(resultHasilTambahaB10) +
            parseFloat(resultHasilTambahaB11) +
            parseFloat(resultHasilTambahaB12) +
            parseFloat(resultHasilTambahaB13) +
            parseFloat(resultHasilTambahaB14) +
            parseFloat(resultHasilTambahaB15) +
            parseFloat(resultHasilTambahaB17);
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
        document.getElementById("NilaiTambahPenelitian").value =
            resultHasilSumKelebihanSkor;
    }

    // SUM result nilai pendidikan dan pengajaran + nilai tambah pendidikan dan pengajaran
    if (ResultNilaiPenelitian == "" || resultHasilSumKelebihanSkor == "") {
        var ResultTotalPenelitianDanKaryaIlmiah =
            parseFloat(ResultNilaiPenelitian) +
            parseFloat(resultHasilSumKelebihanSkor);
    } else {
        var ResultTotalPenelitianDanKaryaIlmiah =
            parseFloat(ResultNilaiPenelitian) +
            parseFloat(resultHasilSumKelebihanSkor);
    }

    if (ResultTotalPenelitianDanKaryaIlmiah > 35) {
        var num = 35;
        var NilaiTotalPenelitianDanKaryaIlmiah = num.toFixed(2);
    } else {
        var NilaiTotalPenelitianDanKaryaIlmiah =
            ResultTotalPenelitianDanKaryaIlmiah.toFixed(2);
    }

    if (!isNaN(NilaiTotalPenelitianDanKaryaIlmiah)) {
        // Tampilkan output pada input form
        document.getElementById("NilaiTotalPenelitiandanKaryaIlmiah").value =
            NilaiTotalPenelitianDanKaryaIlmiah;
    }
}
