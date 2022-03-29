<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpeg') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        GFarm
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <!-- <link href="{{ asset('assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" /> -->
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets/demo/demo.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-notify.js') }}"></script>
    <script>
    function showNotificationModal(from, align, message, typemessage, icon) {
        $.notify({
            icon: icon,
            message: message
        }, {
            type: typemessage,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
        console.log("function Calls");
    }
    </script>
    <style>
    .page-break {
        page-break-after: always;
    }
    body, h4 {
        /* font-family:"-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; */
    }
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    table th{
        font-size:12px;
        font-weight:bold;
        padding: 10px 0 !important;
    }
    table tr{
        border:0px !important;
    }
    table td{
        font-size:12px;
        padding: 10px 0 !important;
        font-family: sans-serif;
        border:0px !important;
    }
    h4{
        font-family: sans-serif;
        font-size:16px;
    }
    @media print {
        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        h4{
            font-family: sans-serif;
            font-size:16px;
        }
    }
    
    /** 
        Set the margins of the page to 0, so the footer and the header
        can be of the full height and width !
    **/
    @page {
        margin: 0.5cm 0.5cm;
    }
    /** Define the footer rules **/
    footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }
    tr.border_bottom td {
        border-bottom: 1px solid black;
    }
    .headerBorder {
        border-top : 1px solid black !important;
        border-right : 1px solid black !important;
        border-bottom : 1px solid black !important
    }
    .headerBorderRow {
        border-right : 1px solid black !important;
    }
    .headerBorderTop {
        border-top : 1px solid black !important;
    }
    </style>
</head>
<body style="background-color: white">
    <div class="row col-sm-12" style="background-color: white">
        <table class="" style="width:100%; background-color: white; margin-top:0">
            <tr style="width:100%">
                <td style="width:25%">
                    <h2 class="font-weight-bold">REF ID. {{ date("M") }}{{ $order->id }}</h2>
                </td>
                <td colspan="2" style="width:50%"><center>
                    <h1 class="font-weight-bold">RECEIPT</h1></center>
                </td>
                <td style="width:25%">
                    <img src="{{ asset('images/logo.png') }}" class="rounded-circle img-fluid" width="150px" height="150px">        
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <h3 class="font-weight-bold">G-Farms</h3>
                    <p>Islamabad</p>
                    <p>gfarms@gonco.com.pk</p>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 class="font-weight-bold">BILL TO</h3>
                </td>
                <td></td>
                <td>
                    <h3 class="font-weight-bold">SHIP TO</h3>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>
                        {{ ucwords($order->first_name." ".$order->last_name) }}<br/>
                        {{ $order->location }}
                    </p>
                </td>
                <td colspan="2">
                    <p>SAME AS BILLING ADDRESS</p>
                </td>
            </tr>
            <tr>
                <th class="headerBorder">DESC</th>
                <th class="headerBorder">QTY</th>
                <th class="headerBorder">UNIT PRICE</th>
                <th class="headerBorder">TOTAL</th>
            </tr>
            
            @php    
                $counter = 1;
                $orderItems = $order->getOrderItems;
            @endphp
            @if(isset($orderItems[0]))
            @foreach($orderItems as $item)
            <tr>
                <td class="headerBorderRow"><center>{{ $item->getProduct->product_name }}</center></td>
                <td class="headerBorderRow"><center>{{  $item->quantity }}</center></td>
                <td class="headerBorderRow"><center>{{ $item->getProduct->price }}</center></td> 
                <td class="headerBorderRow"><center>{{ $item->price }}</center></td>                                                      
            </tr>
            @php $counter++; @endphp
            @endforeach
            <tr>
                <td class="headerBorderTop">
                    <h5 class="font-weight-bold"><center>TOTAL</center></h5>
                </td>
                <td class="headerBorderTop"></td>
                <td class="headerBorderTop"></td>
                <td class="headerBorderTop">
                    <h5 class="font-weight-bold"><center>{{ $order->total_price }}</center></h5>
                </td>                                                      
            </tr>
            @endif
        </table>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('assets/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/sweetalert2.m.jsin') }}" type="text/javascript"></script>
</body>

</html>