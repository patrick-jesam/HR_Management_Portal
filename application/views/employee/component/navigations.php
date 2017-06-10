<div id="main-header" class="clearfix">
    <header id="header" class="clearfix">                        
        <div class="row main">
            <nav class="navbar navbar-custom" id="header_menu" role="navigation">   

                <div class="menu-bg">                        
                    <nav class="main-menu navbar navbar-collapse menu-bg" role="navigation">
                        <div class="container">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header menu-bg">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="main-menu collapse navbar-collapse menu-bg" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="<?php
                                    if (!empty($menu['index'])) {
                                        echo $menu['index'] == 1 ? 'active' : '';
                                    }
                                    ?>">
                                        <a href="<?php echo base_url() ?>employee/dashboard"><?= lang('home')?></a>
                                    </li>                                    
                                    <li class="dropdown <?php
                                    if (!empty($menu['mailbox'])) {
                                        echo $menu['mailbox'] == 1 ? 'active' : '';
                                    }
                                    ?>">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= lang('mailbox')?><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="<?php
                                            if (!empty($menu['inbox'])) {
                                                echo $menu['inbox'] == 1 ? 'active' : '';
                                            }
                                            ?>"><a href="<?php echo base_url() ?>employee/dashboard/inbox"><?= lang('inbox')?></a></li>
                                            <li class="<?php
                                            if (!empty($menu['sent'])) {
                                                echo $menu['sent'] == 1 ? 'active' : '';
                                            }
                                            ?>"><a  href="<?php echo base_url() ?>employee/dashboard/sent"><?= lang('sent')?></a></li>                                            
                                            <li class="<?php
                                            if (!empty($menu['draft'])) {
                                                echo $menu['draft'] == 1 ? 'active' : '';
                                            }
                                            ?>"><a  href="<?php echo base_url() ?>employee/dashboard/draft"><?= lang('draft')?></a></li>                                            
                                            <li class="<?php
                                            if (!empty($menu['trash'])) {
                                                echo $menu['trash'] == 1 ? 'active' : '';
                                            }
                                            ?>"><a  href="<?php echo base_url() ?>employee/dashboard/trash"><?= lang('trash')?></a></li>                                            
                                        </ul>
                                    </li>                                        
                                    <li class="<?php
                                    if (!empty($menu['leave_application'])) {
                                        echo $menu['leave_application'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/leave_application"><?= lang('leave_application')?></a></li>

                                    <li class="<?php
                                    if (!empty($menu['my_time'])) {
                                        echo $menu['my_time'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/my_time"><?= lang('my_time')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['payslip'])) {
                                        echo $menu['payslip'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/payslip"><?= lang('paylsip')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['expense'])) {
                                        echo $menu['expense'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/expense"><?= lang('my_expense')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['my_task'])) {
                                        echo $menu['my_task'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/my_task"><?= lang('task')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['notice'])) {
                                        echo $menu['notice'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/all_notice"><?= lang('notice')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['events'])) {
                                        echo $menu['events'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/all_events"><?= lang('events')?></a></li>
                                    <li class="<?php
                                    if (!empty($menu['awards'])) {
                                        echo $menu['awards'] == 1 ? 'active' : '';
                                    }
                                    ?>"><a href="<?php echo base_url() ?>employee/dashboard/all_award"><?= lang('award')?></a></li>



                                </ul>
                                <ul class="main-menu nav navbar-nav navbar-right">
                                    <li class="dropdown <?php
                                    if (!empty($menu['language'])) {
                                        echo $menu['language'] == 1 ? 'active' : '';
                                    }
                                    ?>">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language">&nbsp;</i><?= lang('languages')?><b class="caret"></b></a>                                        
                                        <ul class="dropdown-menu">

                                            <?php
                                            $languages = $this->db->order_by('name', 'ASC')->get('tbl_languages')->result();
                                            foreach ($languages as $lang) : if ($lang->active == 1) :
                                                    ?>
                                                    <li>
                                                        <a href="<?= base_url() ?>employee/dashboard/set_language/<?= $lang->name ?>" title="<?= ucwords(str_replace("_", " ", $lang->name)) ?>">
                                                            <img src="<?= base_url() ?>asset/images/flags/<?= $lang->icon ?>.gif" alt="<?= ucwords(str_replace("_", " ", $lang->name)) ?>"  /> <?= ucwords(str_replace("_", " ", $lang->name)) ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </ul>
                                    </li>
                                    <li class="dropdown <?php
                                    if (!empty($menu['profile'])) {
                                        echo $menu['profile'] == 1 ? 'active' : '';
                                    }
                                    ?>">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user">&nbsp;</i><?= lang('profile')?><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li class="<?php
                                            if (!empty($menu['change_password'])) {
                                                echo $menu['change_password'] == 1 ? 'active' : '';
                                            }
                                            ?>"><a href="<?php echo base_url() ?>employee/dashboard/change_password"><?= lang('changes_password')?></a>
                                            </li>                                            
                                            <li>
                                                <a href="<?php echo base_url() ?>login/logout"><?= lang('logout')?></a>
                                            </li>                                            
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div>
                    </nav>
                </div>  
            </nav>  
        </div>                                            
    </header>   
</div>


