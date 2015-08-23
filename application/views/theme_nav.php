<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= img('avatar04.png', array('class' => 'img-circle')) ?>
            </div>
            <div class="pull-left info">
                <p><?= $user_name ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>
            <li <?= (($page == 'home') ? 'class="active"' : '') ?>><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> <span>หน้าหลัก</span></a></li>
            <li class="treeview <?= (($page == 'accounting') ? 'active' : '') ?>">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>เพิ่ม รายรับ รายจ่าย</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= (($subpage == 'income') ? 'class="active"' : '') ?>><a href="<?= base_url('accounting/income') ?>"><i class="fa fa-circle-o"></i> เพิ่มรายรับ</a></li>
                    <li <?= (($subpage == 'outcome') ? 'class="active"' : '') ?>><a href="<?= base_url('accounting/outcome') ?>"><i class="fa fa-circle-o"></i> เพิ่มรายจ่าย</a></li>
                </ul>
            </li>
            <li class="treeview <?= (($page == 'report') ? 'active' : '') ?>">
                <a href="#">
                    <i class="fa fa-book"></i> <span>รายงาน</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= (($subpage == 'today') ? 'class="active"' : '') ?>><a href="<?= base_url('report/today') ?>"><i class="fa fa-circle-o"></i> วันนี้</a></li>
                    <li <?= (($subpage == 'week') ? 'class="active"' : '') ?>><a href="<?= base_url('report/week') ?>"><i class="fa fa-circle-o"></i> สัปดาห์</a></li>
                    <li <?= (($subpage == 'range') ? 'class="active"' : '') ?>><a href="<?= base_url('report/range') ?>"><i class="fa fa-circle-o"></i> กำหนดเอง</a></li>
                </ul>
            </li>
            <li class="treeview <?= (($page == 'setting') ? 'active' : '') ?>">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>ตั้งค่าระบบ</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li <?= (($subpage == 'type') ? 'class="active"' : '') ?>><a href="<?= base_url('setting/type') ?>"><i class="fa fa-circle-o"></i> ประเภทค่าใช้จ่าย</a></li>
                    <li <?= (($subpage == 'users') ? 'class="active"' : '') ?>><a href="<?= base_url('setting/users') ?>"><i class="fa fa-circle-o"></i> ผู้ใช้งาน</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->
<?php if (isset($debug) && $debug != NULL) { ?>
    <section class="content-header" style="padding-left: 50px;">
        <pre>
            <?= print_r($debug) ?>
        </pre>
    </section>
<?php } ?>

<?php if ($alert != NULL) { ?>
    <section class="content-header" style="padding-left: 50px;">
        <div class="row">
            <?php if ($alert['alert_mode'] == 'danger') { ?>
                <div class="alert alert-danger alert-dismissable" style="margin: 30px;">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>ผิดพลาด!</b> <?= $alert['alert_message'] ?>
                </div>
            <?php } ?>
            <?php if ($alert['alert_mode'] == 'success') { ?>
                <div class="alert alert-warning alert-dismissable" style="margin: 30px;">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>สำเร็จ!</b> <?= $alert['alert_message'] ?>
                </div>
            <?php } ?>
            <?php if ($alert['alert_mode'] == 'info') { ?>
                <div class="alert alert-info alert-dismissable" style="margin: 30px;">
                    <i class="fa fa-info"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>ข้อมูลเพิ่มเติม!</b> <?= $alert['alert_message'] ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
