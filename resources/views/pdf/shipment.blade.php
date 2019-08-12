<!DOCTYPE html>
<html lang="en">
<head>
<title>Shipment Detail</title>
</head>
<body>
           <div><h3>EACSS</h3></div>
    <div>
        <img src="{{asset('adminLt/dist/img/logofull.jpg')}}">
    </div>
    <div>Shipper Name <h4>{{$shipperName}}</h4> </div>
    <div>Shipper Address <h4>{{$shipperAddress}}</h4></div>
    <div>Consignee Name<h4>{{$consigneeName}}</h4></div>
    <div>Consignee Address <h4>{{$consigneeAddress}}</h4></div>
   <div>TotalWeight<h4>{{$totalWeight}}</h4></div>
    <div>AWB<h4>{{$AWB}}</h4></div>
</body>
</html>
