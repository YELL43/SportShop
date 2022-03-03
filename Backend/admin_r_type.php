<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>แสดงจำนวนและหมวดหมู่ ของสินค้าที่ถูกขายออก</h4>
            </div>
            <canvas id="chartjs_bar"></canvas>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php
    $sql = "SELECT distinct order_category, sum(order_amount) as order_amount FROM tb_orderdetail WHERE payment_status = 'ได้รับสินค้าเรียบร้อย' GROUP BY order_category ORDER BY order_amount DESC";
    $query = $conn->query($sql);
    while ($row = mysqli_fetch_array($query)) {
        $order_category[] = $row['order_category'];
        $order_amount[] = $row['order_amount'];
    }
    ?>
    var colors = [];
    var $ch = 0;
    var ctx = document.getElementById("chartjs_bar").getContext('2d');
    for (let i = 0; i < <?php echo json_encode($order_amount); ?>.length; i++) {
        this.colors.push(generateRandomColor())
    }
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($order_category); ?>,
            datasets: [{
                label: 'จำนวนสินค้าของหมวดหมู่ที่ขายสินค้าออก',
                backgroundColor: this.colors,
                data: <?php echo json_encode($order_amount); ?>,
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