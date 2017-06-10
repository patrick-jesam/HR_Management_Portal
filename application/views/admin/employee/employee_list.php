
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs">
                <li class="<?= $active == 1 ? 'active' : '' ?>"><a href="#employee_list" data-toggle="tab"><?= lang('employee_list') ?></a>                    
                </li>
                <li class="<?= $active == 2 ? 'active' : '' ?>"><a href="#add_employee"  data-toggle="tab"><?= lang('add_employee') ?></a></li>
            </ul>
            <div class="tab-content no-padding">
                <!-- Employee List tab Starts -->
                <div class="tab-pane <?= $active == 1 ? 'active' : '' ?>" id="employee_list" style="position: relative;">
                    <div class="box" style="border: none;" data-collapsed="0">                                                
                        <div class="box-body">
                            <div class="pull-right hidden-print" style="padding-top: 0px;padding-bottom: 8px">                                                                      
                                <span><?php echo btn_pdf('admin/employee/employee_list_pdf'); ?></span>                                
                            </div>
                            <table class="table table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th class="col-sm-1"><?= lang('employee_id') ?></th>
                                        <th><?= lang('employee') ?></th>
                                        <th><?= lang('dept_desingation') ?></th>                                        
                                        <th><?= lang('mobile') ?></th>
                                        <th><?= lang('status') ?></th>
                                        <th class="col-sm-1 hidden-print"><?= lang('view_details') ?></th>                                             
                                        <th class="col-sm-2 hidden-print"><?= lang('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>                    
                                    <?php
                                    if (!empty($all_employee_info)): foreach ($all_employee_info as $v_employee) :
                                            $designation_info = $this->employee_model->check_by(array('designations_id' => $v_employee->designations_id),'tbl_designations');
                                            $department = $this->employee_model->check_by(array('department_id' => $designation_info->department_id), 'tbl_department')
                                            ?>

                                            <tr>
                                                <td><?php echo $v_employee->employment_id ?></td>
                                                <td><?php echo "$v_employee->first_name " . "$v_employee->last_name"; ?></td>
                                                <td><?php echo $department->department_name . ' > ' . $designation_info->designations ?></td>                                                
                                                <td><?php echo $v_employee->mobile ?></td>                                
                                                <td><?php
                                                    if ($v_employee->status == 1) {
                                                        echo '<span class="label label-success">Active</span>';
                                                    } else {
                                                        echo '<span class="label label-danger">Deactive</span>';
                                                    }
                                                    ?></td>                                
                                                <td ><?php echo btn_view('admin/employee/view_employee/' . $v_employee->employee_id); ?></td>                                
                                                <td > 
                                                    <?php echo btn_edit('admin/employee/employees/' . $v_employee->employee_id); ?>
                                                    <?php echo btn_delete('admin/employee/delete_employee/' . $v_employee->employee_id ); ?>
                                                </td>   
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    <?php else : ?>
                                    <td colspan="3">
                                        <strong><?= lang('nothing_to_display') ?></strong>
                                    </td>
                                <?php endif; ?>
                                </tbody>
                            </table>  
                        </div>            
                    </div>        
                </div>
                <!-- Employee List tab Ends -->


                <!-- Add Employee tab Starts -->
                <div class="tab-pane <?= $active == 2 ? 'active' : '' ?>" id="add_employee" style="position: relative;">
                    <div class="box" style="border: none; padding-top: 15px;" data-collapsed="0">                        
                        <div class="box-body">
                            <form role="form" id="employee-form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/employee/save_employee/<?php
                            if (!empty($emp_info->employee_id)) {
                                echo $emp_info->employee_id;
                            }
                            ?>" method="post" class="form-horizontal form-groups-bordered">    
                                <div class="row">
                                    <div class="col-sm-12">

                                        <!-- ************************ Personal Information Panel Start ************************-->
                                        <div class="col-sm-6">
                                            <div class="box box-primary">
                                                <div class="box-heading with-border">                                                
                                                    <h4 class="box-title"><?= lang('personal_details') ?></h4>
                                                </div>
                                                <div class="box-body ">
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('first_name') ?> <span class="required"> *</span></label>
                                                        <input type="text" name="first_name" value="<?php
                                                        if (!empty($employee_info->first_name)) {
                                                            echo $employee_info->first_name;
                                                        }
                                                        ?>"  class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('last_name') ?><span class="required"> *</span></label>
                                                        <input type="text" name="last_name" value="<?php
                                                        if (!empty($employee_info->last_name)) {
                                                            echo $employee_info->last_name;
                                                        }
                                                        ?>" class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('date_of_birth') ?> <span class="required"> *</span></label>
                                                        <div class="input-group">
                                                            <input type="text" name="date_of_birth" value="<?php
                                                            if (!empty($employee_info->date_of_birth)) {
                                                                echo $employee_info->date_of_birth;
                                                            }
                                                            ?>" class="form-control datepicker" data-format="yyy-mm-dd">
                                                            <div class="input-group-addon">
                                                                <a href="#"><i class="entypo-calendar"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('gender') ?> <span class="required"> *</span></label>
                                                        <select name="gender" class="form-control" >
                                                            <option value=""><?= lang('gender') ?> ...</option>
                                                            <option value="Male" <?php
                                                            if (!empty($employee_info->gender)) {
                                                                echo $employee_info->gender == 'Male' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('male') ?></option>
                                                            <option value="Female" <?php
                                                            if (!empty($employee_info->gender)) {
                                                                echo $employee_info->gender == 'Female' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('female') ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('maratial_status') ?> <span class="required"> *</span></label>
                                                        <select name="maratial_status" class="form-control" >
                                                            <option value=""><?= lang('maratial_status') ?>...
                                                            </option>
                                                            <option value="Married" <?php
                                                            if (!empty($employee_info->maratial_status)) {
                                                                echo $employee_info->maratial_status == 'Married' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('married') ?>
                                                            </option>
                                                            <option value="Un-Married" <?php
                                                            if (!empty($employee_info->maratial_status)) {
                                                                echo $employee_info->maratial_status == 'Un-Married' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('un-married') ?>
                                                            </option>
                                                            <option value="Widowed" <?php
                                                            if (!empty($employee_info->maratial_status)) {
                                                                echo $employee_info->maratial_status == 'Widowed' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('widowed') ?></option>
                                                            <option value="Divorced" <?php
                                                            if (!empty($employee_info->maratial_status)) {
                                                                echo $employee_info->maratial_status == 'Divorced' ? 'selected' : '';
                                                            }
                                                            ?>><?= lang('divorced') ?></option>
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('fathers_name') ?> <span class="required"> *</span></label>
                                                        <input type="text" name="father_name" value="<?php
                                                        if (!empty($employee_info->father_name)) {
                                                            echo $employee_info->father_name;
                                                        }
                                                        ?>"  class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label"><?= lang('nationality') ?><span class="required"> *</span></label>
                                                        <select name="nationality" class="form-control col-sm-5" >
                                                            <option value="" ><?= lang('select_country') ?>...</option>
                                                            <?php foreach ($all_country as $v_country) : ?>
                                                                <option value="<?php echo $v_country->idCountry ?>" <?php
                                                                if (!empty($employee_info->country_id)) {
                                                                    echo $v_country->countryName == $employee_info->nationality ? 'selected' : '';
                                                                }
                                                                ?>><?php echo $v_country->countryName ?></option>
                                                                    <?php endforeach; ?>
                                                        </select> 
                                                    </div>
                                                    <div class="" id="nationality">
                                                        <label class="control-label" ><?= lang('passport_no') ?></label>
                                                        <input type="text" name="passport_number" value="<?php
                                                        if (!empty($employee_info->passport_number)) {
                                                            echo $employee_info->passport_number;
                                                        }
                                                        ?>"  class="form-control">
                                                    </div>

                                                    <div class="form-group col-sm-12">
                                                        <div class="form-group col-sm-12">
                                                            <label for="field-1" class="control-label"><?= lang('photo') ?> <span class="required">*</span></label>
                                                            <div class="input-group">     
                                                                <input type="hidden" name="old_path" value="<?php
                                                                if (!empty($employee_info->photo_a_path)) {
                                                                    echo $employee_info->photo_a_path;
                                                                }
                                                                ?>">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 150px; height: 150px;">
                                                                        <?php if (!empty($employee_info->photo)): ?>
                                                                            <img src="<?php echo base_url() . $employee_info->photo; ?>" >  
                                                                        <?php else: ?>
                                                                            <img src="http://placehold.it/350x260" alt="Please Connect Your Internet">     
                                                                        <?php endif; ?>                                 
                                                                    </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 150px; max-height: 150px;">
                                                                        <input type="file" value="<?php if (!empty($employee_info)) echo base_url() . $employee_info->photo; ?>" name="photo" size="20" /><
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-default btn-file">
                                                                            <span class="fileinput-new"><input type="file"  name="photo" size="20" /></span>
                                                                            <span class="fileinput-exists"><?= lang('change') ?></span>    
                                                                        </span>
                                                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput"><?= lang('remove') ?></a>
                                                                    </div>
                                                                </div>
                                                                <div id="valid_msg" style="color: #e11221"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>            
                                            </div>            
                                        </div> <!-- ************************ Personal Information Panel End ************************-->    

                                        <div class="col-sm-6"><!-- ************************ Contact Details Start******************************* -->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h6 class="box-title"><?= lang('contact_details') ?></h6>                                                
                                                </div>
                                                <div class="box-body">
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('present_address') ?> <span class="required"> *</span></label>
                                                        <textarea id="present" name="present_address" class="form-control" ><?php
                                                            if (!empty($employee_info->present_address)) {
                                                                echo $employee_info->present_address;
                                                            }
                                                            ?></textarea>
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('city') ?> <span class="required"> *</span></label>
                                                        <input type="text" name="city" value="<?php
                                                        if (!empty($employee_info->city)) {
                                                            echo $employee_info->city;
                                                        }
                                                        ?>" class="form-control" >
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('country') ?> <span class="required"> *</span></label>
                                                        <select name="country_id" class="form-control col-sm-5" >
                                                            <option value="" ><?= lang('select_country') ?>...</option>
                                                            <?php foreach ($all_country as $v_country) : ?>
                                                                <option value="<?php echo $v_country->idCountry ?>" <?php
                                                                if (!empty($employee_info->country_id)) {
                                                                    echo $v_country->idCountry == $employee_info->country_id ? 'selected' : '';
                                                                }
                                                                ?>><?php echo $v_country->countryName ?></option>
                                                                    <?php endforeach; ?>
                                                        </select> 
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('mobile') ?> <span class="required"> *</span></label>
                                                        <input type="text" name="mobile" value="<?php
                                                        if (!empty($employee_info->mobile)) {
                                                            echo $employee_info->mobile;
                                                        }
                                                        ?>" class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('phone') ?></label>
                                                        <input type="text" name="phone" value="<?php
                                                        if (!empty($employee_info->phone)) {
                                                            echo $employee_info->phone;
                                                        }
                                                        ?>" class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('email') ?> <span class="required"> *</span></label>
                                                        <input type="email"  name="email" value="<?php
                                                        if (!empty($employee_info->email)) {
                                                            echo $employee_info->email;
                                                        }
                                                        ?>"  class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- ************************ Contact Details End ******************************* -->

                                        <div class="col-sm-6 pull-right"><!-- ************************ Employee Documents Start ******************************* -->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h6 class="box-title"><?= lang('employee_document') ?></h6>                                                
                                                </div>
                                                <div class="box-body">
                                                    <!-- CV Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('resume') ?></label>
                                                        <input type="hidden" name="resume_path" value="<?php
                                                        if (!empty($employee_info->resume_path)) {
                                                            echo $employee_info->resume_path;
                                                        }
                                                        ?>">
                                                        <input type="hidden" name="document_id" value="<?php
                                                        if (!empty($employee_info->document_id)) {
                                                            echo $employee_info->document_id;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-7">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->resume)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="resume" value="<?php echo $employee_info->resume ?>">
                                                                        <input type="file" name="resume" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->resume_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="resume" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Offer Letter Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('offer_letter') ?></label>
                                                        <input type="hidden" name="offer_letter_path" value="<?php
                                                        if (!empty($employee_info->offer_letter_path)) {
                                                            echo $employee_info->offer_letter_path;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->offer_letter)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="offer_letter" value="<?php echo $employee_info->offer_letter ?>">
                                                                        <input type="file" name="offer_letter" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->offer_letter_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="offer_letter" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Joining Letter Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('joining_letter') ?></label>
                                                        <input type="hidden" name="joining_letter_path" value="<?php
                                                        if (!empty($employee_info->joining_letter_path)) {
                                                            echo $employee_info->joining_letter_path;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->joining_letter)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="joining_letter" value="<?php echo $employee_info->joining_letter ?>">
                                                                        <input type="file" name="joining_letter" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->offer_letter_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="joining_letter" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Contract Paper Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('contract_paper') ?></label>
                                                        <input type="hidden" name="contract_paper_path" value="<?php
                                                        if (!empty($employee_info->contract_paper_path)) {
                                                            echo $employee_info->contract_paper_path;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->contract_paper)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="contract_paper" value="<?php echo $employee_info->contract_paper ?>">
                                                                        <input type="file" name="contract_paper" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->offer_letter_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="contract_paper" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>

                                                    <!-- ID / Proff Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('id_proff') ?></label>
                                                        <input type="hidden" name="id_proff_path" value="<?php
                                                        if (!empty($employee_info->id_proff_path)) {
                                                            echo $employee_info->id_proff_path;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->id_proff)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="id_proff" value="<?php echo $employee_info->id_proff ?>">
                                                                        <input type="file" name="id_proff" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->offer_letter_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="id_proff" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>

                                                    <!-- Medical Upload -->
                                                    <div class="form-group">
                                                        <label for="field-1" class="col-sm-4 control-label"><?= lang('other_documents') ?> </label>
                                                        <input type="hidden" name="other_document_path" value="<?php
                                                        if (!empty($employee_info->other_document_path)) {
                                                            echo $employee_info->other_document_path;
                                                        }
                                                        ?>">
                                                        <div class="col-sm-8">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <?php if (!empty($employee_info->other_document)): ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" style="display: none" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" style="display: block">Change</span>
                                                                        <input type="hidden" name="other_document" value="<?php echo $employee_info->other_document ?>">
                                                                        <input type="file" name="other_document" >
                                                                    </span>                                    
                                                                    <span class="fileinput-filename"> <?php echo $employee_info->other_document_filename ?></span>                                          
                                                                <?php else: ?>
                                                                    <span class="btn btn-default btn-file"><span class="fileinput-new" ><?= lang('select_file') ?></span>
                                                                        <span class="fileinput-exists" ><?= lang('change') ?></span>                                            
                                                                        <input type="file" name="other_document" >
                                                                    </span> 
                                                                    <span class="fileinput-filename"></span>                                        
                                                                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none;">&times;</a>                                                                                                            
                                                                <?php endif; ?>

                                                            </div>  
                                                            <div id="msg_pdf" style="color: #e11221"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- ************************ Employee Documents Start ******************************* -->
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- ************************ Bank Details Start******************************* -->
                                        <div class="col-sm-6">
                                            <div class="box box-primary">
                                                <div class="box-header with-border">                                                
                                                    <h6 class="box-title"><?= lang('bank_information') ?></h6>                                                
                                                </div>
                                                <div class="panel-body">
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('bank_name') ?></label>
                                                        <input type="text" name="bank_name" value="<?php
                                                        if (!empty($employee_info->bank_name)) {
                                                            echo $employee_info->bank_name;
                                                        }
                                                        ?>" class="form-control" >
                                                        <input type="hidden" name="employee_bank_id" value="<?php
                                                        if (!empty($employee_info->employee_bank_id)) {
                                                            echo $employee_info->employee_bank_id;
                                                        }
                                                        ?>" class="form-control" >
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('branch_name') ?></label>
                                                        <input type="text" name="branch_name" value="<?php
                                                        if (!empty($employee_info->branch_name)) {
                                                            echo $employee_info->branch_name;
                                                        }
                                                        ?>" class="form-control" >
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('account_name') ?></label>
                                                        <input type="text" name="account_name" value="<?php
                                                        if (!empty($employee_info->account_name)) {
                                                            echo $employee_info->account_name;
                                                        }
                                                        ?>" class="form-control">
                                                    </div>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('account_number') ?></label>
                                                        <input type="text"  name="account_number" value="<?php
                                                        if (!empty($employee_info->account_number)) {
                                                            echo $employee_info->account_number;
                                                        }
                                                        ?>" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- ************************ Bank Details End ******************************* -->        

                                        <div class="col-sm-6"><!-- ************************** official status column Start  ****************************-->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h6 class="box-title"><?= lang('official_status') ?></h6>
                                                </div>
                                                <div class="box-body">
                                                    <div class="">
                                                        <label for="field-1" class="control-label"><?= lang('employee_id') ?> <span class="required">*</span><small id="id_error_msg"></small></label>
                                                        <input type="text" name="employment_id" onchange="check_duplicate_emp_id(this.value)" value="<?php
                                                        if (!empty($employee_info->employment_id)) {
                                                            echo $employee_info->employment_id;
                                                        }
                                                        ?>" class="form-control" >
                                                    </div> 
                                                    <?php if (!empty($employee_info->status)) : ?>
                                                        <div class="">
                                                            <label class="control-label" ><?= lang('status') ?><span class="required">*</span></label>
                                                            <select name="status" class="form-control">
                                                                <option value="1" 
                                                                <?php
                                                                echo $employee_info->status == '1' ? 'selected' : '';
                                                                ?>><?php echo lang('activate'); ?></option>                            
                                                                <option value="2" 
                                                                <?php
                                                                echo $employee_info->status == '2' ? 'selected' : '';
                                                                ?>><?php echo lang('inactive'); ?></option>                            

                                                            </select>
                                                        </div>                    
                                                    <?php endif; ?>
                                                    <div class="">
                                                        <label class="control-label" ><?= lang('designation') ?> <span class="required">*</span></label>
                                                        <select name="designations_id" class="form-control">                            
                                                            <option value=""><?= lang('select_designation') ?>.....</option>
                                                            <?php if (!empty($all_department_info)): foreach ($all_department_info as $dept_name => $v_department_info) : ?>
                                                                    <?php if (!empty($v_department_info)): ?>
                                                                        <optgroup label="<?php echo $dept_name; ?>">
                                                                            <?php foreach ($v_department_info as $designation) : ?>
                                                                                <option value="<?php echo $designation->designations_id; ?>" 
                                                                                <?php
                                                                                if (!empty($employee_info->designations_id)) {
                                                                                    echo $designation->designations_id == $employee_info->designations_id ? 'selected' : '';
                                                                                }
                                                                                ?>><?php echo $designation->designations ?></option>                            
                                                                                    <?php endforeach; ?>
                                                                        </optgroup>
                                                                    <?php endif; ?>                            
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>                    
                                                    <div class="">
                                                        <label for="field-1" class="control-label"><?= lang('joining_date') ?> <span class="required">*</span></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control datepicker" name="joining_date" value="<?php
                                                            if (!empty($employee_info->joining_date)) {
                                                                echo $employee_info->joining_date;
                                                            }
                                                            ?>" data-format="yyyy/mm/dd" >
                                                            <div class="input-group-addon">
                                                                <a href="#"><i class="entypo-calendar"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>                    
                                                </div>

                                            </div>
                                        </div><!-- ************************** official status column End  ****************************-->

                                        <div class="col-sm-6 margin pull-right">
                                            <button id="btn_emp" type="submit" class="btn btn-primary btn-block"><?= lang('save') ?></button>
                                        </div> 
                                    </div>
                                </div>    
                            </form>
                        </div>            
                    </div>   
                </div>
                <!-- Add Employee tab Ends -->
            </div>
        </div>
    </div>
</div>

