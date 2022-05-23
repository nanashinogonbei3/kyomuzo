const min = 1;
const max = 30;
// カウントした数値をローカルストレージに保存してリロードしても消えないようにしたい。
// JSON.parseとすることで、もとの配列の値に表示することができます。
// const orderNum = JSON.parse(localStorage.getItem("todos"));



let not = 1;

// くろあん ******
      // ＋－ボタンを押すと注文数が増減する。くろあん(press-buttonA)
      function count_upA() {
            
      // 10より小さい数値の場合、
      if ( not < max ) { 
            not+=1;
            // not を出力する
            console.log(not);
            //<input type="number" ・・省略・・id="press-buttonA">の数字をnotの値に書き換える
            document.getElementById("press-buttonA").value = not;
            }
         
      }

      // －ボタンを押すと1づつ数が減る
      function count_downA() {
           
      if ( not >= min ) {
            not-=1;
            //notを出力する
            console.log(not);
            document.getElementById("press-buttonA").value = not;
            }
      }

let notB = 1;
// しろあん *****
      // ＋－ボタンを押すと注文数が増減する。くろあん(press-buttonB)
      function count_upB() {
            
      // 10より小さい数値の場合、
      if ( notB < max ) { 
            notB+=1;
            // not を出力する
            console.log(notB);
            //<input type="number" ・・省略・・id="press-buttonA">の数字をnotの値に書き換える
            document.getElementById("press-buttonB").value = notB;
            }
         
      }

      // －ボタンを押すと1づつ数が減る
      function count_downB() {
           
      if ( notB >= min ) {
            notB-=1;
            //notを出力する
            console.log(notB);
            document.getElementById("press-buttonB").value = notB;
            }
      }

