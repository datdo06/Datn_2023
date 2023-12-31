// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
let myLineChart;
function handleData(data){
    var ctx = document.getElementById("myAreaChart");
    if(myLineChart){
        myLineChart.destroy();
    }
    myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data['day'],
            datasets: [{
                label: "Earnings",
                lineTension: 0.2,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 2,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: data['sum_money_data'],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 30
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 7,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return  number_format(value) + 'VND';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' VND';
                    }
                }
            }
        }
    });

}

$(function (){
    const response = $.ajax({
        url: '/money', // Điều này cần được thay thế bằng địa chỉ endpoint của bạn
        method: 'GET',
        data: { },
        success: function(data) {
            // Xử lý dữ liệu trả về từ server và cập nhật bảng DataTables (nếu cần)
        },
        error: function(xhr, status, error) {
            // Xử lý lỗi nếu cần
        }
    }).then(data =>{
        console.log(data);
        handleData(data);
    });
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1 ;
    var year = date.getFullYear();
    var dayinmonth = new Date(year, month, 0).getDate();
    var x = year + '-' + month + '-' + '01';
    var y = year + '-' + month + '-' + dayinmonth;
    $("#tu").val(x);
    $("#den").val(y);
    $(document).on('change', '#filter',async function (){
        var selectedType = $("#filter").val();
        if(selectedType == 2 ){
            var currentDate = new Date();
            var currentDayOfWeek = currentDate.getDay();
            var firstMondayOfWeek = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate() - currentDayOfWeek + 1);
            var mondayDate = new Date(firstMondayOfWeek.getFullYear(), firstMondayOfWeek.getMonth(), firstMondayOfWeek.getDate());
            var mondayDay = mondayDate.getDate();
            var mondayMonth = mondayDate.getMonth() + 1;
            var mondayYear = mondayDate.getFullYear();
            var sundayDate = new Date(firstMondayOfWeek.getFullYear(), firstMondayOfWeek.getMonth(), firstMondayOfWeek.getDate() + 6);
            var sundayDay = sundayDate.getDate();
            var sundayMonth = sundayDate.getMonth() + 1;
            var sundayYear = sundayDate.getFullYear();
            var y = sundayYear + '-' + sundayMonth + '-' + sundayDay;
            var x = mondayYear + '-' + mondayMonth + '-' + mondayDay;
            $("#tu").val(x);
            $("#den").val(y);
        }else if (selectedType == ''){
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth() + 1 ;
            var year = date.getFullYear();
            var dayinmonth = new Date(year, month, 0).getDate();
            var x = year + '-' + month + '-' + '01';
            var y = year + '-' + month + '-' + dayinmonth;
            $("#tu").val(x);
            $("#den").val(y);
        }
        const response = await $.ajax({
            url: '/money', // Điều này cần được thay thế bằng địa chỉ endpoint của bạn
            method: 'GET',
            data: { filter_type: selectedType},
            success: function(data) {
                // Xử lý dữ liệu trả về từ server và cập nhật bảng DataTables (nếu cần)
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu cần
            }
        }).then(data =>{
            console.log(data);
            handleData(data);
        });

    });
    $(document).on('click','#xem', async function (){
        var tu  = $("#tu").val();
        var den = $("#den").val();
        // Gửi giá trị đã chọn lên server bằng AJAX
        const response = await $.ajax({
            url: '/money', // Điều này cần được thay thế bằng địa chỉ endpoint của bạn
            method: 'GET',
            data: { tu: tu, den: den },
            success: function(data) {
                // Xử lý dữ liệu trả về từ server và cập nhật bảng DataTables (nếu cần)
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi nếu cần
            }
        }).then(data =>{
            console.log(data);
            handleData(data);
        });


    })
})
// Area Chart Example
