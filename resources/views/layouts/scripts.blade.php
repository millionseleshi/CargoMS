<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('adminLt/plugins/jquery/jquery.min.js')}}" type="application/javascript"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminLt/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" type="application/javascript"></script>

{{--DatePicker--}}
<script src="{{asset('adminLt/plugins/daterangepicker/moment.min.js')}}" type="application/javascript"></script>
<script src="{{asset('adminLt/plugins/daterangepicker/daterangepicker.js')}}" type="application/javascript"></script>

<script src="{{asset('adminLt/plugins/select2/select2.full.min.js')}}" type="application/javascript"></script>

{{--DataTable--}}
<script src="{{asset('adminLt/plugins/datatables/jquery.dataTables.js')}}" type="application/javascript"></script>
<script src="{{asset('adminLt/plugins/datatables/dataTables.bootstrap4.js')}}" type="application/javascript"></script>

<script src="{{asset('adminLt/plugins/fastclick/fastclick.min.js')}}" type="application/javascript"></script>
<script src="{{asset('adminLt/plugins/datepicker/bootstrap-datepicker.js')}}" type="application/javascript"></script>
<script src="{{asset('adminLt/plugins/rssfeed/jquery.rss.min.js')}}" type="application/javascript"></script>

<!-- AdminLTE App -->
<script src="{{asset('adminLt/dist/js/adminlte.min.js')}}" type="application/javascript"></script>

<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#reservation').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            opens: 'center',
            drops: 'down',
            minDate: moment().format('YYYY-MM-DD'),
            startDate: moment().format('YYYY-MM-DD'),
            endDate: moment().startOf(moment()).add(6, 'days')
        });
        $('#reservation_two').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            opens: 'center',
            drops: 'up',
            minDate: moment().format('YYYY-MM-DD'),
            startDate: moment().format('YYYY-MM-DD'),
            endDate: moment().startOf(moment()).add(6, 'days')
        });
        $('#reservation_calculator').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            opens: 'center',
            drops: 'up',
            minDate: moment().format('YYYY-MM-DD'),
            startDate: moment().format('YYYY-MM-DD'),
            endDate: moment().startOf(moment()).add(6, 'days')
        });

        $('.select2').select2();

        $('#employeeForwarder').change(function () {
            $('#forwarderBox').show();
            $('#forwarderBox').prop("hidden", false);
            $('#employeeForwarder').prop("checked", true);

            $('#delivererBox').hide();
            $('#delivererBox').prop("hidden", true);
            $('#employeeDeliverer').prop("checked", false);
        });

        $('#employeeDeliverer').change(function () {
            $('#delivererBox').show();
            $('#delivererBox').prop("hidden", false);
            $('#employeeDeliverer').prop("checked", true);

            $('#forwarderBox').hide();
            $('#forwarderBox').prop("hidden", true);
            $('#employeeForwarder').prop("checked", false);
        })


        $(function () {
            $('#delivererTable').DataTable();
        });

        $(function () {
            $('#receivedShipmentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('ReceiveData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'shipperName', name: 'shipperName'},
                    {data: 'shipmentType', name: 'shipmentType'},
                    {data: 'totalWeight', name: 'totalWeight'},
                    {data: 'arrivalDate', name: 'arrivalDate'},
                    {data: 'AWB', name: 'AWB'},
                    {data: 'status', name: 'status'},
                    {data: 'PAY', name: 'PAY'},
                ]
            });
        });

        $(function () {
            $('#cargoScheduleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('GetCargo') !!}',
                columns: [
                    {data: 'flightNumber', name: 'flightNumber'},
                    {data: 'carrier', name: 'carrier'},
                    {data: 'From-To', name: 'From-To'},
                    {data: 'Date', name: 'Date'},
                    {data: 'maxWeight', name: 'maxWeight'},
                    // {data: 'status', name: 'status'},
                ]
            });
        });


        $('#chargeCalculate').click(function () {

            var shipmentType = $('#calcShipmentType').val();
            var totalWeight = $('#calcWeight').val();
            var arrivalDate = new Date($('#reservation_calculator').data('daterangepicker').startDate);
            var deliveryDate = new Date($('#reservation_calculator').data('daterangepicker').endDate);

           return price(arrivalDate,deliveryDate,shipmentType,totalWeight);

        });

        function price(arrivalDate,deliveryDate,shipmentType,totalWeight)
        {
            var terminalCharge;
            var chargeFactor;

            if(shipmentType=='perishable')
            {
                chargeFactor=0.9;
                terminalCharge=713.04;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='general Cargo')
            {
                chargeFactor=0.05;
                terminalCharge=260.87;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='valuable item')
            {
                chargeFactor=1.75;
                terminalCharge=713.04;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='live animal')
            {
                chargeFactor=0.9;
                terminalCharge=260.87;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='radioactive')
            {
                chargeFactor=5;
                terminalCharge=713.04;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='vehicles')
            {
                chargeFactor=0.03;
                terminalCharge=713.04;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='dangerous goods')
            {
                chargeFactor=0.05;
                terminalCharge=713.04;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
        }

        function dateDifference(arrivalDate,deliveryDate)
        {
            var dateDiff=0;

            var d1=new Date(arrivalDate);
            var d2=new Date(deliveryDate);

            var arivalTime=d1.getTime();
            var deliveryTime =d2.getTime();

            dateDiff=Math.ceil((deliveryTime-arivalTime)/(24*3600*1000));

            return dateDiff;
        }

        function calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate) {

            var wareHouseCharge;
            var totalCharge;
            var totalChargeVAT;
            var duration;
            const VAT=0.15;

            duration=dateDifference(arrivalDate,deliveryDate);

            wareHouseCharge=(Math.round(totalWeight*chargeFactor*duration*1000)/1000);

            totalCharge=Math.round(((wareHouseCharge+terminalCharge)*1000))/1000;

            totalChargeVAT=Math.round((((totalCharge*VAT)+totalCharge)*1000))/1000;

            var result=
                {
                    Weight:totalWeight,
                    duration:duration,
                    terminalCharge:terminalCharge,
                    wareHouseCharge:wareHouseCharge,
                    TotalTerminalCharge:totalCharge,
                    TotalTerminalwithVAT:totalChargeVAT
                }

            $(document).ready(function ()
            {
                $('#chargeValue').val(
                    "Total Weight: "+result.Weight + "(kg)"+ '\n'+
                    "Duration: "+result.duration +"(days)"+"\n"+
                    "Terminal Charge: "+result.terminalCharge + "(ETB)"  +"\n"+
                    "WareHouse Charge: "+result.wareHouseCharge + "(ETB)" +"\n"+
                    "Total Charge: "+result.TotalTerminalCharge + "(ETB)" +"\n"+
                    "Total Charge with VAT: "+result.TotalTerminalwithVAT + "(ETB)" +"\n"
                );


            })
        }

        $('#editModal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)

            var delivererId = button.data("iddeliverer");
            var companyname = button.data("companyname");
            var orgAddress = button.data("address").split(" ");
            var phonenumber = button.data("phonenumber");
            var alternatephonenumber = button.data("alternatephonenumber");
            var email = button.data("email");
            var about = button.data("about");
            var deliveryprice = button.data("deliveryprice");

            var model = $(this);

            model.find('.modal-body #orgId').val(delivererId)
            model.find('.modal-body #orgName').val(companyname);
            model.find('.modal-body #city').val(orgAddress[0]);
            model.find('.modal-body #subcity').val(orgAddress[1]);
            model.find('.modal-body #woreda').val(orgAddress[2])
            model.find('.modal-body #houseno').val(orgAddress[3]);
            model.find('.modal-body #orgPhoneNo').val(phonenumber);
            model.find('.modal-body #orgAltPhoneNo').val(alternatephonenumber);
            model.find('.modal-body #orgEmail').val(email);
            model.find('.modal-body #aboutDelivery').val(about);
            model.find('.modal-body #deliveryPrice').val(deliveryprice);

        });


        $('#devareModal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)

            var delivererId = button.data("iddeliverer");

            var model = $(this);

            model.find('.modal-body #orgId').val(delivererId)

        });


        $('#feditModal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)

            var forwarderId = button.data("idforwarder");
            var companyname = button.data("companyname");
            var orgAddress = button.data("address").split(" ");
            var phonenumber = button.data("phonenumber");
            var alternatephonenumber = button.data("alternatephonenumber");
            var email = button.data("email");
            var about = button.data("about");
            var terminalcharge = button.data("terminalcharge");

            var model = $(this);

            model.find('.modal-body #orgId').val(forwarderId)
            model.find('.modal-body #orgName').val(companyname);
            model.find('.modal-body #city').val(orgAddress[0]);
            model.find('.modal-body #subcity').val(orgAddress[1]);
            model.find('.modal-body #woreda').val(orgAddress[2])
            model.find('.modal-body #houseno').val(orgAddress[3]);
            model.find('.modal-body #orgPhoneNo').val(phonenumber);
            model.find('.modal-body #orgAltPhoneNo').val(alternatephonenumber);
            model.find('.modal-body #orgEmail').val(email);
            model.find('.modal-body #aboutForwarder').val(about);
            model.find('.modal-body #terminalCharge').val(terminalcharge);

        });


        $('#fdevareModal').on('show.bs.modal', function (e) {

            var button = $(e.relatedTarget)

            var forwarderId = button.data("idforwarder");

            var model = $(this);

            model.find('.modal-body #orgId').val(forwarderId)

        });

        $('#claimModalCenter').on('show.bs.modal',function (e) {

            var button=$(e.relatedTarget);

            var  claimeId=button.data('claimid')
            var claimersName=button.data('claimersname');
            var claimersAddress=button.data('claimersaddress');
            var claimersPhone=button.data('claimersphone');
            var claimersEmail=button.data('claimersemail');
            var AWB=button.data('awb');
            var flightno=button.data('flightno');
            var literaryAirline=button.data('literaryairline');
            var irregularity=button.data('irregularity');
            var remark=button.data('remark');
            var estimatedValue=button.data('estimatedvalue');
            var contentDescription=button.data('contentdescription');

          var modal=$(this);

          modal.find('.modal-body #claim_ID').val(claimeId);
          modal.find('.modal-body #claimerName').val(claimersName);
          modal.find('.modal-body #claimerAddress').val(claimersAddress);
          modal.find('.modal-body #claimerPhone').val(claimersPhone);
          modal.find('.modal-body #claimerEmail').val(claimersEmail);
          modal.find('.modal-body #AWB').val(AWB);
          modal.find('.modal-body #flightNo').val(flightno);
          modal.find('.modal-body #literaryAirline').val(literaryAirline);
          modal.find('.modal-body #irregularity').val(irregularity);
          modal.find('.modal-body #remark').val(remark);
          modal.find('.modal-body #estimatedValue').val(estimatedValue);
          modal.find('.modal-body #contentDescription').val(contentDescription);


        })


        $('#awbSearch').keypress(function (e) {

            if (e.which == 13) {
                var awb = $('#awbSearch').val();
                var url = "{{route('SearchShipment')}}";

                if (awb != "") {
                    $.ajax(
                        {
                            url: url,
                            type: 'POST',
                            data: {"AWB": awb},
                            dataType: 'json',
                            success: function (data) {
                                IDawbHeader.innerHTML = "{{__('AWB')}} " + data.AWB;
                                IDawbHeader.innerHTML = "{{__('AWB')}} " + data.AWB;
                                IDshipperName.innerHTML = "{{__('Shipper Name')}} " + data.shipperName;
                                IDconsigneeName.innerHTML = "{{__('Consignee Name')}} " + data.consigneeName;
                                IDshipmntType.innerHTML = "{{__('Shipment Type')}} " + data.shipmentType;
                                IDtotalWeight.innerHTML = "{{__('Total Weight')}} " + data.totalWeight;
                                IDepartureDate.innerHTML = "{{__('Departure Date')}} " + data.departureDate;
                                IDarrivalDate.innerHTML = "{{__('Arrival Date')}} " + data.arrivalDate;
                                IDstatus.innerHTML = "{{__('Status')}} " + data.status;
                            }

                        }
                    )
                }
            }
        });

        $('#awbSearch').keyup(function (e) {
            if (e.which == 8 , e.which == 46, $('#awbSearch').val() == "") {
                {
                    IDawbHeader.innerHTML = "{{__('AWB')}} ";
                    IDshipperName.innerHTML = "{{__('Shipper Name')}} ";
                    IDconsigneeName.innerHTML = "{{__('Consignee Name')}} ";
                    IDshipmntType.innerHTML = "{{__('Shipment Type')}} ";
                    IDtotalWeight.innerHTML = "{{__('Total Weight')}} ";
                    IDepartureDate.innerHTML = "{{__('Departure Date')}} ";
                    IDarrivalDate.innerHTML = "{{__('Arrival Date')}} ";
                    IDstatus.innerHTML = "{{__('Status')}} ";
                }
            }
        });

        $('#addBtn').click(function () {
            $('#estimatedContainer table tbody').append(' <tr>' + ' <td><input class="form-control" name="itemType[]" required></td>\n' +
                '                                                                <td><input class="form-control" name="itemBrand[]" required></td>\n' +
                '                                                                <td><input class="form-control" name="itemColor[]"  required></td>\n' +
                '                                                                <td><input class="form-control" name="itemAmount[]" type="number" min="1" required></td>' +
                ' <td> <input class="btn btn-outline-danger" id="removeBtn" type="button" value="{{__('Remove')}}"/></td></tr>');
        });
        $('#addBtn_to').click(function () {
            $('#estimatedContainer_to table tbody').append(' <tr>' + ' <td><input class="form-control" name="itemType[]" required></td>\n' +
                '                                                                <td><input class="form-control" name="itemBrand[]" required></td>\n' +
                '                                                                <td><input class="form-control" name="itemColor[]"  required></td>\n' +
                '                                                                <td><input class="form-control" name="itemAmount[]" type="number" min="1" required></td>' +
                ' <td> <input class="btn btn-outline-danger" id="removeBtn" type="button" value="{{__('Remove')}}"/></td></tr>');
        });

        $(document).on('click', '#removeBtn', function () {
            $(this).parent().parent().remove()
        });

        $('#bookingWeight').keyup(function (e) {
            var flightNo = $('#flightNo').val();
            var weight = $('#bookingWeight').val();

            var url = "{{route('WeightChecker')}}";

            $.ajax(
                {
                    url: url,
                    type: 'POST',
                    data: {"flightNo": flightNo},
                    dataType: 'json',
                    success: function (maxWeight) {
                        $(document).ready(function () {

                            if (weight > maxWeight) {
                                $('#weightError').show();
                                $('#regidteredBtn').prop("disabled", true)
                            }
                            else {
                                $('#weightError').hide();
                                $('#regidteredBtn').prop("disabled", false)
                            }

                        })

                    }

                }
            );


        });

        $('#bookingWeight_to').keyup(function (e) {
            var flightNo = $('#flightNo_to').val();
            var weight = $('#bookingWeight_to').val();

            var url = "{{route('WeightChecker')}}";

            $.ajax(
                {
                    url: url,
                    type: 'POST',
                    data: {"flightNo": flightNo},
                    dataType: 'json',
                    success: function (maxWeight) {
                        $(document).ready(function () {

                            if (weight > maxWeight) {
                                $('#weightError_to').show();
                                $('#regidteredBtn_to').prop("disabled", true)
                            }
                            else {
                                $('#weightError_to').hide();
                                $('#regidteredBtn_to').prop("disabled", false)
                            }

                        })

                    }

                }
            );

        })

        $('#loadableCheck').click(function () {

            var flightNo = $('#carrier').val();
            var cargoLength = $('#cargoLength').val();
            var cargoHeight = $('#cargoHeight').val();
            var cargoWidth = $('#cargoWidth').val();
            const factor = 0.39;

            var inInch = $('#SIunitInch:checked').val();

            if (inInch == 'inch') {
                cargoLength = cargoLength * factor;
                cargoWidth = cargoWidth * factor;
                cargoHeight = cargoHeight * factor;
            }

            var url = "{{route('CheckCargoloadable')}}";

            $.ajax(
                {
                    url: url,
                    type: 'POST',
                    data: {"flightNumber": flightNo},
                    dataType: 'json',
                    success: function (data) {

                        let maxLength = data[0].maxLength;
                        let maxWidth = data[0].maxWidth;
                        let maxHeight = data[0].maxHeight;

                        var maxVolume = maxLength * maxWidth * maxHeight;

                        var checkVolume = cargoLength * cargoWidth * cargoHeight;

                        if (checkVolume > maxVolume) {
                            $(document).ready(function () {
                                $('#loadableBox').prop("hidden", false);
                                if (inInch == 'inch') {
                                    maxLengthIN = parseInt(maxLength * factor);
                                    maxWidthIN = parseInt(maxWidth * factor);
                                    maxHeightIN = parseInt(maxHeight * factor);

                                    cargoLength = parseInt(cargoLength / factor);
                                    cargoWidth = parseInt(cargoWidth / factor);
                                    cargoHeight = parseInt(cargoHeight / factor);

                                    $('#editor1').val("Cargo Volume is greater than carier capacity(In Inch) \n "
                                        + "Length: " + cargoLength + " MaxLength: " + maxLengthIN + "\n"
                                        + "Width: " + cargoWidth + " MaxWidth: " + maxWidthIN + "\n"
                                        + "Height: " + cargoHeight + " MaxHeight: " + maxHeightIN);
                                }
                                else {
                                    $('#editor1').val("Cargo Volume is greater than carier capacity(In CM) \n "
                                        + "Length: " + cargoLength + " MaxLength: " + maxLength + "\n"
                                        + "Width: " + cargoWidth + " MaxWidth: " + maxWidth + "\n"
                                        + "Height: " + cargoHeight + " MaxHeight: " + maxHeight);
                                }
                            });


                        }

                    }

                }
            )

        });

        $(document).ready(function () {
            $('#deliveryneed').change(function () {
                if (this.checked) {
                    $('#deliveryList').prop("hidden", false);

                }
                else {
                    $('#deliveryList').prop("hidden", true);

                }

            })
        })
        $(document).ready(function () {
            $('#deliveryneed_to').change(function () {
                if (this.checked) {
                    $('#deliveryList_to').prop("hidden", false);

                }
                else {
                    $('#deliveryList_to').prop("hidden", true);

                }

            })
        })

        $(document).ready(function () {

            $('#statusInvalid').change(function () {
                if(this.checked)
                {
                       $('#InvalidityReason').prop("hidden",false);
                }
                else
                    {
                        $('#InvalidityReason').prop("hidden",true);
                    }
            })
        })

        $(document).ready(function () {

            $('#statusValid').change(function () {
                if(this.checked)
                {
                       $('#InvalidityReason').prop("hidden",true);
                }
                else
                    {
                        $('#InvalidityReason').prop("hidden",false);
                    }
            })
        })

        $(document).ready(function () {
            $('#settlement').change(function () {

                if(this.checked)
                {
                    var claimsId=$('#ClaimsId').val()

                    console.log(claimsId);
                }
            })
        })

        $('#userImage').change(function () {

            readURL(this)
        })

        function readURL(input) {

            if (input.files && input.files[0])
            {
                var reader=new FileReader();

                reader.onload=function (e) {
                    $('#imagePreview').attr('src',e.target.result)
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#pickup').change(function () {
            var pickUp=$('#pickup').val();

          if(pickUp=="ethiopia")
          {
             $(document).ready(function () {
               $('#destination').find('#destinationETH').prop("disabled",true);
               $('#destination').find('.otherDestination').prop("disabled",false);
             })
          }
          else
              {
                  $(document).ready(function () {
                      $('#destination').find('.otherDestination').prop("disabled",true);
                      $('#destination').find('#destinationETH').prop("disabled",false);
                  })
              }
        })

        function deliveryDate() {
            var today=new Date();
            var dd=String(today.getDay()).padStart(2,'0');
            var mm=String(today.getMonth()+1).padStart(2,'0');
            var yyyy=today.getFullYear();

            today=yyyy+'-'+'mm'+'-'+'dd'

            return today;
        }

        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            startDate: deliveryDate(),
            showOnFocus:true,
            clearBtn: true,
            todayHighlight: true

        })

        $('#CalculateBtn').click(function () {

            var deliveryDate=$('#datepicker').val();
            var shipmentId=$('#shipmentId').val();
            var url='{{route('ShipmentToProcess')}}'

            $.ajax(
                {
                    url: url,
                    type: 'POST',
                    data: {"shipmentId": shipmentId},
                    dataType: 'json',
                    success: function (data) {
                        $(document).ready(function () {
                           var arrivalDate=data.arrivalDate;
                            var shipmentType=data.shipmentType;
                            var totalWeight=data.totalWeight;

                            cost({
                                 arrivalDate: arrivalDate,
                                 deliveryDate: deliveryDate,
                                 shipmentType: shipmentType,
                                 totalWeight: totalWeight
                             })
                        })
                    }
                }
            );
        })

        function cost(parameters) {
            let {arrivalDate, deliveryDate, shipmentType, totalWeight} = parameters;
            var terminalCharge;
            var chargeFactor;

            if(shipmentType=='perishable')
            {
                chargeFactor=0.9;
                terminalCharge=713.04;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
            if(shipmentType=='general Cargo')
            {
                chargeFactor=0.05;
                terminalCharge=260.87;

                return calc(totalWeight,chargeFactor,terminalCharge,arrivalDate,deliveryDate);
            }
            if(shipmentType=='valuable item')
            {
                chargeFactor=1.75;
                terminalCharge=713.04;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
            if(shipmentType=='live animal')
            {
                chargeFactor=0.9;
                terminalCharge=260.87;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
            if(shipmentType=='radioactive')
            {
                chargeFactor=5;
                terminalCharge=713.04;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
            if(shipmentType=='vehicles')
            {
                chargeFactor=0.03;
                terminalCharge=713.04;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
            if(shipmentType=='dangerous goods')
            {
                chargeFactor=0.05;
                terminalCharge=713.04;

                return calculator({
                    totalWeight: totalWeight,
                    chargeFactor: chargeFactor,
                    terminalCharge: terminalCharge,
                    arrivalDate: arrivalDate,
                    deliveryDate: deliveryDate
                });
            }
        }

        function dateDiff(parameters) {
            let {arrivalDate, deliveryDate} = parameters;
            var dateDiff=0;

            var d1=new Date(arrivalDate);
            var d2=new Date(deliveryDate);

            var arivalTime=d1.getTime();
            var deliveryTime =d2.getTime();

            dateDiff=Math.ceil((deliveryTime-arivalTime)/(24*3600*1000));

            return dateDiff;
        }

        function calculator(parameters) {
            let {totalWeight, chargeFactor, terminalCharge, arrivalDate, deliveryDate} = parameters;

            var wareHouseCharge;
            var totalCharge;
            var totalChargeVAT;
            var duration;
            var deliveryPrice;
            var totalCost;
            const VAT=0.15;

            duration=dateDifference(arrivalDate,deliveryDate);

            wareHouseCharge=(Math.round(totalWeight*chargeFactor*duration*1000)/1000);

            totalCharge=Math.round(((wareHouseCharge+terminalCharge)*1000))/1000;

            totalChargeVAT=Math.round((((totalCharge*VAT)+totalCharge)*1000))/1000;

            var result=
                {
                    Weight:totalWeight,
                    duration:duration,
                    terminalCharge:terminalCharge,
                    wareHouseCharge:wareHouseCharge,
                    TotalTerminalCharge:totalCharge,
                    TotalTerminalwithVAT:totalChargeVAT
                }

            $(document).ready(function ()
            {
                var deliveryInfo=$('#deliveryPrice').val().split("-");
                var Priceperpackage=deliveryInfo[0];


                deliveryPrice=Priceperpackage*parseInt(result.Weight);

                totalCost=Math.round((result.TotalTerminalwithVAT+parseInt(deliveryPrice))*1000)/1000

                $('#totalPayment').val(
                    // "Total Weight: "+result.Weight + "(kg)"+ '\n'+
                    "Duration: "+result.duration +"(days)"+"\n"+
                    "Terminal Charge: "+result.terminalCharge + "(ETB)"  +"\n"+
                    "WareHouse Charge: "+result.wareHouseCharge + "(ETB)" +"\n"+
                    "Total Charge: "+result.TotalTerminalCharge + "(ETB)" +"\n"+
                    "Total Charge with VAT: "+result.TotalTerminalwithVAT + "(ETB)" +"\n"
                );


                $('#totalCost').val(totalCost)
                $('#totalPrice').val(totalCost)

            })
        }

        $('#paymentModal').on('show.bs.modal',function (e) {

            var modal=$(this);
            var deliveryInfo=$('#deliveryPrice').val().split("-");
            var delivererID=deliveryInfo[1];
            $(document).ready(function () {
                modal.find('.modal-body #delivererID').val(delivererID)
            })

        });



    });
</script>