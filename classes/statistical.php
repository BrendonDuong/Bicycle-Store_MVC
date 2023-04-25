<!-- <?php
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../config/config.php');
    require('../../carbon/autoload.php');
    include '../classes/statistical.php';

    // printf("Now: %s", Carbon::now('Asia/Ho_Chi_Minh'));

    // printf("1 day: %s", CarbonInterval::day()->forHumans());
    
    // if(isset($_POST['time'])){
    //     $time = $_POST['time'];
    // }else{
    //     $time='';
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    // }

    // if($time == '7days'){
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
    // }elseif($time == '28days'){
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
    // }elseif($time == '90days'){
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
    // }elseif($time == '365days'){
    //     $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    // }

    $subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
    
    $sql = "SELECT * FROM tbl_statistical WHERE date BETWEEN '$subdays' AND '$now' ORDER BY date ASC";
    $sql_query = mysqli_query($mysqli,$sql);
    

    while($val = mysqli_fetch_array($sql_query)){

        $chat_data[] = array(
            'date' => $val['date'],
            'ordered' => $val['ordered'],
            'sales' => $val['sales'],
            'quantity' => $val['quantity']
        );
    }
    // print_r($chart_data);
    echo $data = json_encode($chart_data)
?> -->
