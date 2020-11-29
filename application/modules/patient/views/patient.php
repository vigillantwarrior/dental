<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="">

            <header class="panel-heading">
                <?php echo lang('patient'); ?> <?php echo lang('database'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">

                <div class="adv-table editable-table ">

                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo 'Protocal No.'; ?></th>                        
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th class="no-print"><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <style>
                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                        </style>








                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('register_new_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                             <option value="">select..</option>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Occupation"; ?></label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Residence"; ?></label>
                        <input type="text" class="form-control" name="residence" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Member Type"; ?></label>
                         <select class="form-control m-bot15" required="" name="member_type" value=''>
                                                <option value="">Select...</option>
                                                <option value="Regular">Regular</option>
                                                <option value="Executive">Executive</option>
                                                
                                            </select>
                    </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Known Esnan From"; ?></label>
                         <select class="form-control m-bot15" name="how_added" value=''>
                                                <option value="">Select...</option>
                                                <option value="Google">Google search</option>
                                                <option value="Instagram">Instagram</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Direct">Direct Marketing</option>
                                                <option value="Passer By">Passer By</option>
                                                <option value="Other">Other</option>
                                            </select>
                        <!-- <input type="text" class="form-control" name="how_added" id="exampleInputEmail1" value='' placeholder=""> -->
                    </div>

                    <div class="form-group col-md-6">
                          <label for="exampleInputEmail1"><?php echo "Complications"; ?></label><br>

                     <input type="checkbox" name="heart_disease" value='yes'> Heart Disease<br>
                     <input type="checkbox" name="hbp" value='yes'> High Blood Pressure <br>
                     <input type="checkbox" name="lbp" value='yes'> Low Blood Pressure <br>
                     <input type="checkbox" name="diabetes" value='yes'> Diabetes <br>
                      Allergies (if any)<input type="text" name="allergies" > <br>
                      Others (if any) <br><input type="text" name="others" >
                    </div>


                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control js-example-basic-single"  name="doctor" value=''> 
                            <option value=""> </option>
                            <?php foreach ($doctors as $doctor) { ?>                                        
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>



                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>

                  
                    <!--
                                        <div class="form-group last col-md-6">
                                            <div style="text-align:center;" class="col-md-12">
                                                <video id="video" width="200" height="200" autoplay></video>
                                                <div class="snap" id="snap">Capture Photo</div>
                                                <canvas id="canvas" width="200" height="200"></canvas>
                                                Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                                            </div>
                                        </div>
                    -->


                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>


                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->


<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('change'); ?><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="">
                    </div>



                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > Male </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > Female </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > Others </option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" readonly="">      
                    </div>


                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                         <?php if (empty($patient->bloodgroup)) {?>
                            <option value="">select..</option>
                        <?php } ?>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Occupation"; ?></label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Residence"; ?></label>
                        <input type="text" class="form-control" name="residence" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Member Type"; ?></label>
                        <select class="form-control m-bot15" required="" name="member_type" value=''>
                         <?php if (empty($patient->member_type)) {?>
                            <option value="">select..</option>
                        <?php } ?>
                                              
                            <option value="Regular" <?php
                            if (!empty($patient->member_type)) {
                                if ($patient->member_type == 'Regular') {
                                    echo 'selected';
                                }
                            }
                            ?> > Regular </option>

                            <option value="Executive" <?php
                            if (!empty($patient->member_type)) {
                                if ($patient->member_type == 'Executive') {
                                    echo 'selected';
                                }
                            }
                            ?> > Executive </option>
                        </select>

                    </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo "Known Esnan From"; ?></label>
                        <select class="form-control m-bot15" name="how_added" value=''>
                            <?php if (empty($patient->how_added)) {?>
                            <option value="">select..</option>\
                        <?php } ?>
                                              
                            <option value="Google" <?php
                            if (!empty($patient->how_added)) {
                                if ($patient->how_added == 'Google') {
                                    echo 'selected';
                                }
                            }
                            ?> > Google </option>

                            <option value="Instagram" <?php
                            if (!empty($patient->how_added)) {
                                if ($patient->how_added == 'Instagram') {
                                    echo 'selected';
                                }
                            }
                            ?> > Instagram </option>

                            <option value="Facebook" <?php
                            if (!empty($patient->how_added)) {
                                if ($patient->how_added == 'Facebook') {
                                    echo 'selected';
                                }
                            }
                            ?> > Facebook </option>

                            <option value="Direct" <?php
                            if (!empty($patient->how_added)) {
                                if ($patient->how_added == 'Direct') {
                                    echo 'selected';
                                }
                            }
                            ?> > Direct Marketing</option>

                            <option value="Passer By" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Passer By') {
                                    echo 'selected';
                                }
                            }
                            ?> > Passer By </option>

                            <option value="Other" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Other') {
                                    echo 'selected';
                                }
                            }
                            ?> > Other </option>

                        </select>
                    </div>

                     <div class="form-group col-md-6">
                          <label for="exampleInputEmail1"><?php echo "Complications"; ?></label><br>
                            
                
                     <input type="checkbox" name="heart_disease" value='yes'> Heart Disease<br>
                    
                     <input type="checkbox" name="hbp" class="hbp" value="yes"> High Blood Pressure <br>
                     <input type="checkbox" name="lbp" value='yes' class="lbp"> Low Blood Pressure <br>
                     <input type="checkbox" name="diabetes" value='yes' class="diabetes"> Diabetes <br>
                      Allergies (if any)<input type="text" name="allergies"> <br>
                      Others (if any) <br><input type="text" name="others">
                    </div>

                    <div class="form-group col-md-6">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <select class="form-control js-example-basic-single doctor"  name="doctor" value=''> 
                            <option value=""> </option>
                            <?php foreach ($doctors as $doctor) { ?>                                        
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            <?php } ?> 
                        </select>
                    </div>



                    <div class="form-group last col-md-6">
                        <label class="control-label">Image Upload</label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="img_url"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>


                    <!--
                    
                    <div class="form-group last col-md-6">
                        <div style="text-align:center;">
                            <video id="video" width="200" height="200" autoplay></video>
                            <div class="snap" id="snap">Capture Photo</div>
                            <canvas id="canvas" width="200" height="200"></canvas>
                            Right click on the captured image and save. Then select the saved image from the left side's Select Image button.
                        </div>
                    </div>
                    
                    -->








                    <div class="form-group col-md-6">
                        <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                    </div>

                    <input type="hidden" name="id" value=''>
                    
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($patient->patient_id)) {

                        echo $patient->patient_id;
                    }
                    ?>'>

                   
                    <section class="col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </section>

                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
<!-- Edit Patient Modal-->





<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('patient'); ?>  <?php echo lang('info'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatientForm" action="patient/addNew" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="form-group last col-md-4">
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" id="img1" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                            </div>
                            <div class="col-md-12">
                                <label for="exampleInputEmail1"><?php echo lang('patient_id'); ?>: <span class="patientIdClass"></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <div class="nameClass"></div>
                    </div>


                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <div class="emailClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('age'); ?></label>
                        <div class="ageClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <div class="addressClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('gender'); ?></label>
                        <div class="genderClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <div class="phoneClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <div class="bloodgroupClass"></div>
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo lang('birth_date'); ?></label>
                        <div class="birthdateClass"></div>     
                    </div>

                       
                    <div class="form-group col-md-4">
                        <label><?php echo "Occupation"; ?></label>
                        <div class="occupationClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Residence"; ?></label>
                        <div class="residenceClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Member Type"; ?></label>
                        <div class="membertypeClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Known Esnan From"; ?></label>
                        <div class="howaddedClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Heart Disease"; ?></label>
                        <div class="heartdiseaseClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "High Blood Pressure"; ?></label>
                        <div class="hbpClass"></div>     
                    </div>

                     <div class="form-group col-md-4">
                        <label><?php echo "Low Blood Pressure"; ?></label>
                        <div class="lbpClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Diabetes"; ?></label>
                        <div class="diabetesClass"></div>     
                    </div>

                    <div class="form-group col-md-4">
                        <label><?php echo "Allergies"; ?></label>
                        <div class="allergiesClass"></div>     
                    </div>

                     <div class="form-group col-md-4">
                        <label><?php echo "Others"; ?></label>
                        <div class="othersClass"></div>     
                    </div>

                   
                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                    </div>
                    <div class="form-group col-md-4">    
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                        <div class="doctorClass"></div>
                    </div>







                </form>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>



<script src="common/js/codearistos.min.js"></script>

<!--
<script>


    var video = document.getElementById('video');
    // Get access to the camera!
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        // Not adding `{ audio: true }` since we only want video now
        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    // Elements for taking the snapshot
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    // Trigger photo take
    document.getElementById("snap").addEventListener("click", function () {
        context.drawImage(video, 0, 0, 200, 200);
    });

</script>

-->



<script type="text/javascript">

    $(".table").on("click", ".editbutton", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        $("#img").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('#editPatientForm').trigger("reset");
        $.ajax({
            url: 'patient/editPatientByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
            $('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
            $('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
            $('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
            $('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
            $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
            $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
            $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end()
            $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end()
            $('#editPatientForm').find('[name="occupation"]').val(response.patient.occupation).end()
            $('#editPatientForm').find('[name="residence"]').val(response.patient.residence).end()
            $('#editPatientForm').find('[name="member_type"]').val(response.patient.member_type).end()
            $('#editPatientForm').find('[name="how_added"]').val(response.patient.how_added).end()
            // $('#editPatientForm').find('[name="hbp"]').val(response.patient.hbp).end()
            // $('#editPatientForm').find('[name="lbp"]').val(response.patient.lbp).end()
            // $('#editPatientForm').find('[name="diabetes"]').val(response.patient.diabetes).end()
            // $('#editPatientForm').find('[name="heart_disease"]').val(response.patient.heart_disease).end()
            $('#editPatientForm').find('[name="allergies"]').val(response.patient.allergies).end()
            $('#editPatientForm').find('[name="others"]').val(response.patient.others).end()
            $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()

           if (response.patient.hbp == 'yes'){

            $('.hbp').prop('checked', true);
           }

            if (response.patient.lbp == 'yes'){

            $('.lbp').prop('checked', true);
           }

            if (response.patient.diabetes == 'yes'){

            $('.diabetes').prop('checked', true);
           }

            if (response.patient.heart_disease == 'yes'){

            $('.heart_disease').prop('checked', true);
           }
        
            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img").attr("src", response.patient.img_url);
            }


            $('.js-example-basic-single.doctor').val(response.patient.doctor).trigger('change');

            $('#myModal2').modal('show');

        });
    });

</script>



<script type="text/javascript">

    $(".table").on("click", ".inffo", function () {
        //    e.preventDefault(e);
        // Get the record's ID via attribute  
        var iid = $(this).attr('data-id');
        
        $("#img1").attr("src", "uploads/cardiology-patient-icon-vector-6244713.jpg");
        $('.patientIdClass').html("").end()
        $('.nameClass').html("").end()
        $('.emailClass').html("").end()
        $('.addressClass').html("").end()
        $('.phoneClass').html("").end()
        $('.genderClass').html("").end()
        $('.birthdateClass').html("").end()
        $('.bloodgroupClass').html("").end()
        $('.patientidClass').html("").end()
        $('.doctorClass').html("").end()
        $('.occupationClass').html("").end()
        $('.residenceClass').html("").end()
        $('.membertypeClass').html("").end()
        $('.howaddedClass').html("").end()
        $('.allergiesClass').html("").end()
        $('.othersClass').html("").end()
        $('.hbpClass').html("").end()
        $('.lbpClass').html("").end()
        $('.diabetes').html("").end()
        $('.heart_disease').html("").end()
        $('.ageClass').html("").end()
        $.ajax({
            url: 'patient/getPatientByJason?id=' + iid,
            method: 'GET', 
            data: '',
            dataType: 'json', 
        }).success(function (response) {
            // Populate the form fields with the data returned from server

            $('.patientIdClass').append(response.patient.id).end()
            $('.nameClass').append(response.patient.name).end()
            $('.emailClass').append(response.patient.email).end()
            $('.addressClass').append(response.patient.address).end()
            $('.phoneClass').append(response.patient.phone).end()
            $('.genderClass').append(response.patient.sex).end()
            $('.birthdateClass').append(response.patient.birthdate).end()
            $('.ageClass').append(response.age).end()
            $('.bloodgroupClass').append(response.patient.bloodgroup).end()
            $('.occupationClass').append(response.patient.occupation).end()
            $('.residenceClass').append(response.patient.residence).end()
            $('.membertypeClass').append(response.patient.member_type).end()
            $('.howaddedClass').append(response.patient.how_added).end()
            $('.allergiesClass').append(response.patient.allergies).end()
            $('.othersClass').append(response.patient.others).end()
            $('.hbpClass').append(response.patient.hbp).end()
            $('.lbpClass').append(response.patient.lbp).end()
            $('.diabetesClass').append(response.patient.diabetes).end()
            $('.heartdiseaseClass').append(response.patient.heart_disease).end()
            $('.patientidClass').append(response.patient.patient_id).end()
            $('.doctorClass').append(response.doctor.name).end()

            if (typeof response.patient.img_url !== 'undefined' && response.patient.img_url != '') {
                $("#img1").attr("src", response.patient.img_url);
            }


            $('#infoModal').modal('show');

        });
    });

</script>





<script>


    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            //   dom: 'lfrBtip',

            "processing": true,
            "serverSide": true,
            "searchable": true,
            "ajax": {
                url: "patient/getPatient",
                type: 'POST',
            },
            scroller: {
                loadingIndicator: true
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: 100,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json" 
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });

</script>



<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>



