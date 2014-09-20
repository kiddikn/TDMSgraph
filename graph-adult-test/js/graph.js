//function drawcanvas( filename, x, y ,z ) {
//    /* canvas オブジェクトの取得 */
//    var canvas = document.getElementById('canvasgraph');
//    /* canvas要素 ＆ ブラウザ未対応の対処 */
//    if( ! canvas || ! canvas.getContext ) return false;
//    /* 2D コンテキスト */
//    canvas.style.zIndex = z;
//    var ctx = canvas.getContext( '2d' );
//    /* img オブジェクトの作成 */
//    var img = new Image( );
//    /* 画像のキャッシュを無効にするため細工 */
//    img.src = filename + "?" + new Date().getTime();
//    /* 画像が読み込み終わるまで待ってから画像を表示 */
//    img.onload = function( ) {
//        ctx.drawImage( img, x, y );
//    }
//}

function drawcanvas(filename,data){
    var canvas = document.getElementById('canvasgraph');
    var context = canvas.getContext('2d');

    var images = [];
    images[0] = new Image();
    images[0].src = filename;
    for (var i = 0;i < data.length;i++) {
        images[i+1] = new Image();
        images[i+1].src = data[i].filename;
    }

    var loadedCount = 1;
    for(var i = 0; i < images.length; i++){
        images[i].addEventListener('load', function() {
            if (loadedCount == images.length) {
                for (var j in images) {
                    if(j == 0){
                        context.drawImage(images[j],0,0);
                    }else{
                        context.drawImage(images[j], data[j-1].x,data[j-1].y);
                    }
                }
            }
            loadedCount++;
        }, false);
    }
}

function downloadDataFromCanvas(){
    var canvas = document.getElementById('canvasgraph');
    var divpic = document.getElementById('download');
    var url = canvas.toDataURL();
    divpic.src = url;
}

