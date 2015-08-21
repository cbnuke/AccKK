
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            หน้าหลัก
            <small>ระบบบัญชี</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-home"></i> หน้าหลัก</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="callout callout-info">
            <h4>ทริป! การใช้งาน</h4>
            <p>โปรดใช้งานด้วยความระมัดระวัง เนื่องจากอาจจะมีปัญหาจากบัคเล็กๆน้อยๆ</p>
        </div>

        <div class="row">
            <div class="col-lg-6 connectedSortable ui-sortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom" style="cursor: move;">
                    <script>
                        $(function () {
                            Morris.Area({
                                element: 'area-example',
                                data: [
<?php
foreach ($graph as $row) {
    echo "{date: '" . $row['date'] . "', income: " . $row['income'] . ", outcome: " . $row['outcome'] . "},";
}
?>
                                ],
                                xkey: 'date',
                                ykeys: ['income', 'outcome'],
                                labels: ['รายรับ', 'รายจ่าย']
                            });
                        });

                    </script>
                    <!-- Tabs within a box -->
                    <ul class="nav nav-tabs pull-right ui-sortable-handle">
                        <li class="active"><a href="#revenue-chart" data-toggle="tab" aria-expanded="true">Area</a></li>
                        <li class="pull-left header"><i class="fa fa-inbox"></i> รายรับ - รายจ่าย</li>
                    </ul>
                    <div class="tab-content no-padding">
                        <!-- Morris chart - Sales -->
                        <div id="area-example"></div>
                    </div>
                </div><!-- /.nav-tabs-custom -->
            </div>

            <div class="col-lg-6 connectedSortable ui-sortable">
                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">สนใจโฮสติ้งดีๆ เชิญติดต่อ ThaiHubHosting</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <a href="https://www.thaihubhosting.com/"><img src="https://www.thaihubhosting.com/assets/img/thaihubhosting.png?v=1.0" class="img-responsive"></a>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->