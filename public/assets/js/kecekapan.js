function masterClac() {
  var skor_penyelia = document.getElementsByName("skor_penyelia[]"), i;

    for (i = 0; i < skor_penyelia.length; i++) {
      
      if ( skor_penyelia[i].value == "" ) {
        skor_penyelia[i].value = "";

      } else {
          // CONDITION ONE
        if (skor_penyelia[i].value == "0") {
          skor_sebenar = document.getElementsByName("skor_sebenar[]")[i].value = 0;
        
          // CONDITION TWO  
        } else if (skor_penyelia[i].value == "1") {
          skor_sebenar = document.getElementsByName("skor_sebenar[]")[i].value = 5;
        
          // CONDITION THREE
        } else if (skor_penyelia[i].value == "2") {
          skor_sebenar = document.getElementsByName("skor_sebenar[]")[i].value = 10;
        
          // CONDITION FOUR
        } else if (skor_penyelia[i].value == "3") {
          skor_sebenar = document.getElementsByName("skor_sebenar[]")[i].value = 15;

          // CONDITION FIVE
        } else if (skor_penyelia[i].value == "4") {
          skor_sebenar = document.getElementsByName("skor_sebenar[]")[i].value = 20;

        }
      }
    }
  }