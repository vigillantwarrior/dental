<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel-body col-md-12">
            <header class="panel-heading">
                <?php
                echo 'Add Medicine Transfer';
                ?>
            </header>
            <div class="row">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-md-12">
                            <section class="panel row">
                                <div class = "panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="medicine/addMedicineTransfer" class="clearfix" method="post" enctype="multipart/form-data">
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('medicine'); ?></label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="product_id" id="proid" value=''>
                                                <option value="">Select Medicine..</option>
                                                <?php foreach ($medicines as $med) { ?>
                                                    <option value="<?php echo $med->id; ?>" <?php
                                                    if (!empty($medicine->id)) {
                                                        if ($med->id == $medicine->product_id) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $med->name; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo 'From'; ?></label>
                                            <select class="form-control m-bot15" name="from_location" id="fromloc" value='' required="">
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo 'To'; ?></label>
                                            <select class="form-control m-bot15" name="to_location" id="toloc" value='' required="">
                                                
                                            </select>
                                        </div>
                                       <!--  <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('p_price'); ?></label>
                                            <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->price)) {
                                                echo $medicine->price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('s_price'); ?></label>
                                            <input type="text" class="form-control" name="s_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->s_price)) {
                                                echo $medicine->s_price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('store_box'); ?></label>
                                            <input type="text" class="form-control" name="box" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->box)) {
                                                echo $medicine->box;
                                            }
                                            ?>' placeholder="">
                                        </div> -->
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('quantity'); ?></label>
                                            <input type="text" class="form-control" name="trans_quantity" id="quantity" value='<?php
                                            if (!empty($medicine->quantity)) {
                                                echo $medicine->quantity; 
                                            }
                                            ?>' placeholder="">Available<input type="text" class="form-control" disabled="" name="" required="" id="avail2">
                                        </div>
                                        <input type="hidden" class="form-control" name="avail" id="avail">
                                    <!--     <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('generic_name'); ?></label>
                                            <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->generic)) {
                                                echo $medicine->generic;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('company'); ?></label>
                                            <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->company)) {
                                                echo $medicine->company;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo "Supplier"; ?></label>
                                            <select class="form-control m-bot15" name="supplier" value=''>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id; ?>" <?php
                                                    if (!empty($medicine->supplier)) {
                                                        if ($supplier->id == $medicine->supplier) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $supplier->name; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo 'Brand'; ?></label>
                                            <input type="text" class="form-control" name="brand" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->brand)) {
                                                echo $medicine->brand;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo "Location"; ?></label>
                                             <select class="form-control m-bot15" name="location" value=''>
                                                <?php foreach ($locations as $location) { ?>
                                                    <option value="<?php echo $location->id; ?>" <?php
                                                    if (!empty($medicine->location)) {
                                                        if ($location->id == $medicine->location) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> > <?php echo $location->name; ?> </option>
                                                        <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('effects'); ?></label>
                                            <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->effects)) {
                                                echo $medicine->effects;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1"> <?php echo lang('expiry_date'); ?></label>
                                            <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='<?php
                                            if (!empty($medicine->e_date)) {
                                                echo $medicine->e_date;
                                            }
                                            ?>' placeholder="" readonly="">
                                        </div> -->

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($medicine->id)) {
                                            echo $medicine->id;
                                        }
                                        ?>'>
                                        <div class="form-group col-md-12">
                                            <button type="submit" name="submit"  id="sub" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                                        </div>
                                    </form>
                                    </div>

                            </section>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->


<style>
    .wrapper{
        padding: 24px 30px;
    }
</style>

<script src="common/js/codearistos.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#proid").change(function () {
                // Get the record's ID via attribute  
                // var location_id = $('#fromloc').val();
                var product_id = $('#proid').val();
                // alert(product_id);
                // var date = $('#date').val();
                // var doctorr = $('#adoctors').val();
                $('#fromloc').find('option').remove();
                $('#quantity').val("");
                // // $('#default').trigger("reset");
                $.ajax({
                    url: 'medicine/getFromAvailableMedsByLocationJson?proid=' + product_id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    var meds = response.availablemed;
                    $.each(meds, function (key, value) {
                        $('#fromloc').append($('<option>').attr('value', '').text('Select...'));
                        $('#fromloc').append($('<option>').attr('value', value.location_id).text(value.name));
                    });

                    //     fromlocval =  $('#fromloc').val();

                    // alert(fromlocval);
                    //   $("#default-step-1 .button-next").trigger("click");
                    if ($('#fromloc').has('option').length == 0) {                    //if it is blank. 
                        $('#fromloc').append($('<option>').text('No Results').val('Not Selected')).end();
                    }
                //     // Populate the form fields with the data returned from server
                //     //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
                });
            });

        });

         $(document).ready(function () {
            $("#fromloc").change(function () {

                // alert('changed');
                // Get the record's ID via attribute  
                // var location_id = $('#fromloc').val();
                var product_id = $('#proid').val();
                 var location_id = $('#fromloc').val();
                // alert(location_id);
                // alert(product_id);
                // var date = $('#date').val();
                // var doctorr = $('#adoctors').val();
                $('#toloc').find('option').remove();
                $('#quantity').val("");

                // // $('#default').trigger("reset");
                $.ajax({
                    url: 'medicine/getToAvailableMedsByLocationJson?proid=' + product_id + '&fromloc=' + location_id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    var meds = response.toavailablemed;

                   
                    $.each(meds, function (key, value) {
                         // $('#toloc').append($('<option>').attr('value', '').text('Select...'));
                        $('#toloc').append($('<option>').attr('value', value.location_id).text(value.name));
                    });

                    //     fromlocval =  $('#fromloc').val();

                    // alert(fromlocval);
                    //   $("#default-step-1 .button-next").trigger("click");
                    if ($('#toloc').has('option').length == 0) {                    //if it is blank. 
                        $('#toloc').append($('<option>').text('No Results').val('Not Selected')).end();
                    }
                //     // Populate the form fields with the data returned from server
                //     //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
                });
            });

        });

          $(document).ready(function () {
            $("#fromloc").change(function () {

                // alert('changed');
                // Get the record's ID via attribute  
                // var location_id = $('#fromloc').val();
                var product_id = $('#proid').val();
                 var location_id = $('#fromloc').val();

                 $('#avail').val("");
                 $('#avail2').val("");

                   // var quan = $("#quantity").val();
                // alert(product_id);
               // // $('#default').trigger("reset");
                $.ajax({
                    url: 'medicine/getAvailableMedsQuantityByLocationByProductJson?proid=' + product_id + '&fromloc=' + location_id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    
                    var availquantity = response.quantity;

                    // alert(availquantity);
                    $("#avail").val(availquantity);
                    $("#avail2").val(availquantity);


                //     // Populate the form fields with the data returned from server
                //     //  $('#default').find('[name="staff"]').val(response.appointment.staff).end()
                });


            });

        });

        //    $(document).ready(function () {
        //     $("#quantity").keyup(function () {

        //         // alert('changed');
        //         // Get the record's ID via attribute  
        //         // var location_id = $('#fromloc').val();
        //         var avail = $('#avail').val();
        //          var quan = $('#quantity').val();

        //         if(avail < quan){

        //             alert('Insufficient Stock');

        //             location.reload();
        //         }

              


        //     });

        // });




    </script>