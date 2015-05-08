    <ul class="page-sidebar-menu page-sidebar-menu-light" data-auto-scroll="true" data-slide-speed="200">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
        <li class="sidebar-toggler-wrapper">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <div class="sidebar-toggler">
            </div>
            <!-- END SIDEBAR TOGGLER BUTTON -->
        </li>
        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
        <li class="sidebar-search-wrapper">
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
<!--             <form class="sidebar-search " action="extra_search.html" method="POST">
                <a href="javascript:;" class="remove">
                    <i class="icon-close"></i>
                </a>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="搜索...">
                    <span class="input-group-btn">
                 //开启搜索功能，请修改为class="btn submit" 
                <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                </span>
                </div>
            </form> -->
            <!-- END RESPONSIVE QUICK SEARCH FORM -->
        </li>
        <li id="main_page" class="">
            <a href="<?php echo base_url('');?>">
                <i class="icon-home"></i>
                <span class="title">主页</span>
            </a>
        </li>
        <li id="word" class="active">
            <a href="<?php echo base_url('word_manage/index');?>">
                <i class="icon-star"></i>
                <span class="title">任务</span>
            </a>
        </li>
        
        <li id="help" class="last active">
            <a href="<?php echo base_url('help/');?>">
                <i class="icon-docs"></i>
                <span class="title">帮助</span>
            </a>
        </li>
    </ul>