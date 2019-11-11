 <div class="row" style="text-align:center; color:blue;">
<a href="https://www.facebook.com/lokicharpetroleumandlogistics/" target="_blank"><img src="imgs/1.png" alt="" height="42" width="42"></a>
<img src="imgs/2.png" alt="" height="42" width="42">
<img src="imgs/3.png" alt="" height="42" width="42">
<img src="imgs/4.png" alt="" height="42" width="42">
<img src="imgs/5.png" alt="" height="42" width="42">
<img src="imgs/6.png" alt="" height="42" width="42">
<img src="imgs/7.png" alt="" height="42" width="42">
<br>
<br>
<a><img src="imgs/logo.png" alt="" height="100px" width="400px" ></a>
<p>Petrol Station Management System Version 1</p>
<p>Copyright Lokichar Petroleum & Logistics Ltd 2019</p>
 </div >

	
	</div>
    <!-- /container -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
<!-- bootbox library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
 <script>
// Any of the following formats may be used
var ctx = document.getElementById('myChart');
var ctx = document.getElementById('myChart').getContext('2d');
var ctx = $('#myChart');
var ctx = 'myChart';
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Kerosene', 'Diesel', 'Super', 'premium'],
        datasets: [{
            label: '# Product Sales',
            data: [12, 19, 3, 5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
 

 <script>
// JavaScript for deleting product
$(document).on('click', '.delete-object', function(){
 
    var sale_id = $(this).attr('delete-id');
 
    bootbox.confirm({
        message: "<h4>Are you sure?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Yes',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> No',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
 
            if(result==true){
                $.post('delete_sale.php', {
                    object_id: sale_id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    });
 
    return false;
});
</script>
</body>
</html>