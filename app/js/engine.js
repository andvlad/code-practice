function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

// возвращает cookie с именем name, если есть, если нет, то undefined
function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

// Функция вывода интерактивных сообщений
function alerting(message) {window.document.getElementById('messenger').value = message;}

// Матрица с информацией для отображения кораблей
var ship =  [[[1, 3], [1, 2, 3], [1, 2, 2, 3], [1, 2, 2, 2, 3]],
             [[6,10], [6, 7,10], [6, 7, 7,10], [6, 7, 7, 7,10]]];

// Матрица с информацией для отображения потопленных кораблей
var dead = [[[201,203], [201,202,203], [201,202,202,203], [201,202,202,202,203]],
            [[204,206], [204,205,206], [204,205,205,206], [204,205,205,205,206]]];

// Информация о кораблях
var shipTypes = [["twodecks", 2, 4],
                 ["threedecks",3,4],
                 ["fourdecks", 4,2],
                 ["fivedecks", 5,1]];

var gridX = 10, gridY = 10;   // Игровое поле 10х10
var player = [], computer = [], playerShips = [], computerShips = []; preloaded = [];
var playerWin = 0, computerWin = 0, playFlag = true, playing = false;

// Функция для предзагрузки изображений, чтобы предотвратить задержки во время игры
function imagePreload() {
   var i, ids = [1,2,3,6,7,10,100,102,103,201,202,203,204,205,206];
   for ( i = 0; i < ids.length; ++i ) {
      var img = new Image, name = "img/pic" + ids[i] + ".png";
      img.src = name;
      preloaded[i] = img;
   }
}

// Функция расстановки кораблей на поле
function setupPlayer(status) {
   var grid = [];
   var x, y;
   for ( var y = 0; y < gridX; ++y ) {
      grid[y] = [];
      for ( var x = 0; x < gridX; ++x ) grid[y][x] = [100, -1, 0];
   }

   var shipN = 0;
   for ( var s = shipTypes.length - 1; s >= 0; --s ) {
      for ( var i = 0; i < shipTypes[s][2]; ++i ) {
         var d = Math.floor( Math.random() * 2 );
         var len = shipTypes[s][1], lx = gridX, ly = gridY, dx = 0, dy = 0;
         if ( d == 0 ) {
            lx = gridX - len;
            dx = 1;
         }
         else {
            ly = gridY - len;
            dy = 1;
         }
         do {
            y = Math.floor( Math.random() * ly );
            x = Math.floor( Math.random() * lx );
            var j, cx = x, cy = y;
            var ok = true;
            for ( j = 0; j < len; ++j ) {
               if ( grid[cy][cx][0] < 100 ) {
                  ok = false;
                  break;
               }
               cx += dx;
               cy += dy;
            }
         } while(!ok);
         var j, cx = x, cy = y;
         for ( j = 0; j < len; ++j ) {
            grid[cy][cx][0] = ship[d][s][j];
            grid[cy][cx][1] = shipN;
            grid[cy][cx][2] = dead[d][s][j];
            cx += dx;
            cy += dy;
         }
         if (status) {
            computerShips[shipN] = [s,shipTypes[s][1]];
            computerWin++;
         }
         else {
            playerShips[shipN] = [s,shipTypes[s][1]];
            playerWin++;
         }
         shipN++;
      }
   }

   return grid;
}

// Функция установки изображений на поле
function setImage(y, x, id, status) {
   if (status) {
      computer[y][x][0] = id;
      document.images["pc" + y + "_" + x].src = "img/pic" + id + ".png";
   }
   else {
      player[y][x][0] = id;
      document.images["pl" + y + "_" + x].src = "img/pic" + id + ".png";
   }
}

// Функция инъекции в HTML для изменения изображений
function showGrid(status) {
   var y, x;
   for ( y = 0; y < gridY; ++y ) {
      for ( x = 0; x < gridX; ++x ) {
         if (status)
            document.write ('<a href="javascript:gridClick(' + y + ',' + x + ');"><img name="pc' + y + '_' + x + '" src="img/pic100.png" width=33 height=33></a>');
         else
            document.write ('<a href="javascript:void(0);"><img name="pl' + y + '_' + x + '" src="img/pic' + player[y][x][0] + '.png" width=33 height=33></a>');
      }
      document.write('<br>');
   }
}

// Обработчик нажатий по сетке поля
function gridClick(y, x) {
   if (playing == true) {exit;}
   if (playFlag) {
      playing = true;
      if (computer[y][x][0] < 100) {
         setImage( y, x, 103, true );
         var shipN = computer[y][x][1];
         if ( --computerShips[shipN][1] == 0 ) {
            sinkShip( computer, shipN, true);
            alerting("Вы потопили корабль противника.");
            if ( --computerWin == 0 ) {
               alertify.alert('Морской бой', 'Вы победили', function(){ alertify.success('Поздравляю'); });
               playFlag = false;
            }
         }
         if (playFlag) setTimeout("computerMove();", 300);
      }
      else if (computer[y][x][0] == 100) {
         setImage(y, x, 102, true);
         setTimeout("computerMove();", 300);
      }
   }
playing = false;
}

// Действия при ходе компьютера
function computerMove() {
   var x, y, pass;
   var sx, sy;
   var selected = false;
   // Два прохода для попытки быстрого убийства
   for ( pass = 0; pass < 2; ++pass ) {
      for ( y = 0; y < gridY && !selected; ++y ) {
         for ( x = 0; x < gridX && !selected; ++x ) {
            // Если произошло попадание
            if ( player[y][x][0] == 103 ) {
               sx = x; sy = y;
               var nup = ( y > 0 && player[y - 1][x][0] <= 100 );
               var ndn = ( y < gridY - 1 && player[y + 1][x][0] <= 100 );
               var nlt = ( x > 0 && player[y][x - 1][0] <= 100 );
               var nrt = ( x < gridX - 1 && player[y][x + 1][0] <= 100 );
               if ( pass == 0 ) {
                  // После первого промаха, выстрелы будут в линию с двумя попаданиями
                  var yup = ( y > 0 && player[y - 1][x][0] == 103 );
                  var ydn = ( y < gridY - 1 && player[y + 1][x][0] == 103 );
                  var ylt = ( x > 0 && player[y][x - 1][0] == 103 );
                  var yrt = ( x < gridX - 1 && player[y][x + 1][0] == 103 );
                  if ( nlt && yrt ) { sx = x - 1; selected = true; }
                  else if ( nrt && ylt ) { sx = x + 1; selected = true; }
                  else if ( nup && ydn ) { sy = y - 1; selected = true; }
                  else if ( ndn && yup ) { sy = y + 1; selected = true; }
               }
               else {
                  // При другом проходе обстреливать вокруг одного попадания
                  if (nlt) { sx = x - 1; selected = true; }
                  else if (nrt) { sx = x + 1; selected = true; }
                  else if (nup) { sy = y - 1; selected = true; }
                  else if (ndn) { sy = y + 1; selected = true; }
               }
            }
         }
      }
   }
   if (!selected) {
      /* Если быстро потопить не получилось,
         делать случайные выстрелы без повторений */
      do {
         sy = Math.floor( Math.random() * gridY );
         sx = Math.floor( Math.random() * gridX / 2 ) * 2 + sy % 2;
      } while ( player[sy][sx][0] > 100 );
   }
   if ( player[sy][sx][0] < 100 ) {
      // Если подбил
      setImage( sy, sx, 103, false );
      var shipN = player[sy][sx][1];
      if ( --playerShips[shipN][1] == 0 ) {
         sinkShip( player, shipN, false );
         alerting("Один из Ваших кораблей потоплен.");
         if ( --playerWin == 0 ) {
            knowYourEnemy();
            alertify.alert('Морской бой', 'Вы проиграли', function(){ alertify.success('Попробуйте еще раз'); });
            playFlag = false;
         }
      }
   }
   else {
      // Если промахнулся
      setImage( sy, sx, 102, false );
   }
}

// Когда корабль потоплен, изменить его изображение
function sinkShip( grid, shipN, status ) {
   var y, x;
   for ( y = 0; y < gridX; ++y ) {
      for ( x = 0; x < gridX; ++x ) {
         if ( grid[y][x][1] == shipN )
         if (status) setImage( y, x, computer[y][x][2], true );
         else setImage(y, x, player[y][x][2], false );
      }
   }
}

// Показать местоположения всех кораблей противника, когда игрок проиграл
function knowYourEnemy() {
   var y, x;
   for ( y = 0; y < gridX; ++y ) {
      for ( x = 0; x < gridX; ++x ) {
         if ( computer[y][x][0] == 103 ) setImage( y, x, computer[y][x][2], true);
         else if ( computer[y][x][0] < 100 ) setImage( y, x, computer[y][x][0], true);
      }
   }
}

function resetGame() {location.reload();}

// Начало игры
imagePreload();
player = setupPlayer(false);
computer = setupPlayer(true);