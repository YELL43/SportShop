<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>แสดงรายได้ ในแต่ละปี</h4>
            </div>
            <canvas id="chartjs_bar"></canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php
    $sql = "SELECT distinct DATE_FORMAT(order_date, '%Y') AS order_date ,sum(total_price * order_amount) as total_price FROM tb_orderdetail WHERE  payment_status = 'ได้รับสินค้าเรียบร้อย' GROUP by  DATE_FORMAT(order_date, '%Y')ORDER BY `tb_orderdetail`.`order_date` DESC ";
    $query = $conn->query($sql);
    while ($row = mysqli_fetch_array($query)) {
        $order_date[] = $row['order_date'];
        $total_price[] = $row['total_price'];
    }
    ?>
    var colors = [];
    var $ch = 0;
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
    for (let i = 0; i < <?php echo json_encode($total_price); ?>.length; i++) {
        this.colors.push(generateRandomColor())
    }
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($order_date); ?>,
            datasets: [{
                label: 'แสดงรายได้ ในแต่ละปี',
                backgroundColor: this.colors,
                data: <?php echo json_encode($total_price); ?>,
            }]
        },

    });

    function generateRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>