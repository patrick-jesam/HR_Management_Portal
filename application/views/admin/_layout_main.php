<?php $this->load->view('admin/components/header'); ?>
<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin/components/user_profile'); ?>        

        <?php $this->load->view('admin/components/navigation'); ?>	
        <!-- Right side column. Contains the navbar and content of the page -->

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                
                <h1>
                    <?php echo $page_header; ?>            
                </h1>
                <ol class="breadcrumb">
                    <?php echo $this->breadcrumbs->build_breadcrumbs(); ?>
                </ol>
            </section>
            <section class="content">
                <?php echo $subview ?>
            </section>            


        </div><!-- /.right-side -->        
        <div class="control-sidebar-bg"></div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>HR Lite - Version</b> 2.1
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="http://trescoder.com" target="_blank">TresCoder Ltd</a>.</strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->   
    <?php $this->load->view('admin/_layout_modal'); ?> 
    <?php $this->load->view('admin/_layout_modal_lg'); ?> 
    <?php $this->load->view('admin/components/footer'); ?>     
