<?php //graphplot.php idを受け取り座標をまとめたjsonを返す
class GraphData{
    //中心は(440,440)幅は365px,1マスは36.5px
    //ctx.drawImage(num1, 440+36.5*(A/2), 440-36.5*(P/2));
    //        var V = 8;
    //        var S = -4;
    //        var P = V + S;
    //        var A = V - S;
    //        can.drawImage(num1, 440+36.5*(A/2), 440-36.5*(P/2));
    private $graph_json;
    private $encode_filename;
    public function GraphData(){
        $this->graph_json = array();
        $this->encode_filename = array(
            "d0"=>"img/good.png",
            "d2"=>"img/worse.png",
            "d4"=>"img/num1.png",
            "d6"=>"img/num2.png",
            "d8"=>"img/num3.png",
            "d10"=>"img/num4.png",
            "d12"=>"img/num5.png",
            "d14"=>"img/num6.png");
    }

    public function push($data,$v_,$s_){
        $v = floatval($v_);
        $s = floatval($s_);
        $s = $s * (-1);
        if($v >= -5 && $v <= 5 && $s >= -5 && $s <= 5){
            $filename = $this->encode_filename[$data];
            $x = 329+36*(($v+$s)/2);
            $y = 316-36*(($v-$s)/2);
            $this->graph_json[] =
                array('filename'=> $filename
                ,'x' => $x
                ,'y' => $y);
        }
    }

    public function echo_json(){
        //jsonとして出力
        header("Content-Type: text/javascript; charset=utf-8");
        echo json_encode($this->graph_json);
    }
}

$graphData = new GraphData();
if($_POST["d4"]!="" && $_POST["d5"]!=""){
    for($i = 0;$i < 15;$i+=2){
        $first = "d" . $i;
        $j = $i + 1;
        $next = "d" . $j;
        if($_POST[$first]!="" && $_POST[$next]!=""){
            $graphData->push($first,$_POST[$first],$_POST[$next]);
        }
    }
    $graphData->echo_json();
}
?>

