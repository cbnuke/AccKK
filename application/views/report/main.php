<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            รายงาน
            <small><?= $report_type ?></small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-book"></i> รายงาน</a></li>
        </ol>
    </section>

    <?php if ($subpage == 'range') { ?>
        <section class="content-header">
            <div class="row">
                <div class="col-sm-8">
                    <?= $form_open ?>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">กำหนดช่วงเวลารายงาน</h3>
                        </div>
                        <div class="box-body">
                            <!-- Date and time range -->
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>

                                    <input type="text" class="form-control pull-right" id="reservationtime" name="range" <?= ($range != NULL) ? 'value="' . $range . '"' : '' ?>>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-flat" type="submit">ตรวจสอบ</button>
                                    </span>
                                </div><!-- /.input group -->
                            </div><!-- /.form group -->    
                        </div><!-- /.box-body -->
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </section>
        <script>
            $(function () {
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD h:mm:ss'});
            });
        </script>
    <?php } ?>

    <section class="invoice" style="margin-bottom: 0px !important;">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> <span class="logo-lg"><b>Accounting</b> kaenkaew</span>
                    <small class="pull-right">วันที่: <?= $this->datetime->DBToHuman($this->datetime->DBToDay()) ?></small>
                </h2>
            </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <?php if ($begin != NULL) { ?>
                    From
                    <address>
                        <strong><?= $this->datetime->DBToHuman($begin) ?></strong><br>
                    </address>
                <?php } ?>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <?php if ($end != NULL) { ?>
                    To
                    <address>
                        <strong><?= $this->datetime->DBToHuman($end) ?></strong><br>
                    </address>
                <?php } ?>
            </div><!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <!--                <b>Invoice #007612</b><br>
                                <br>
                                <b>Order ID:</b> 4F3S8J<br>
                                <b>Payment Due:</b> 2/22/2014<br>
                                <b>Account:</b> 968-34567-->
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">ลำดับ</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">วันที่ เวลา</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">คำอธิบาย</th>
                            <th colspan="2" class="text-center">รายรับ</th>
                            <th colspan="2" class="text-center">รายจ่าย</th>
                        </tr>
                        <tr>
                            <th class="text-center">DEBIT</th>
                            <th class="text-center">CREDIT</th>
                            <th class="text-center">DEBIT</th>
                            <th class="text-center">CREDIT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $row) { ?>
                            <tr>
                                <td class="text-center"><?= $key + 1 ?></td>
                                <td class="text-center"><span class="label label-success"><?= $this->datetime->DBToHuman($row['action_date'], TRUE) ?></span></td>
                                <td><?= $row['comment'] ?></td>
                                <?php
                                if ($row['income'] != NULL) {
                                    if ($row['money_type'] == 'debit') {
                                        $money_income-=$row['income'];
                                    } else if ($row['money_type'] == 'credit') {
                                        $money_income+=$row['income'];
                                    }
                                    ?>
                                    <td class="text-center"><?= ($row['money_type'] == 'debit') ? $row['income'] : '' ?></td>
                                    <td class="text-center"><?= ($row['money_type'] == 'credit') ? $row['income'] : '' ?></td>
                                    <td></td>
                                    <td></td>
                                <?php } ?>
                                <?php
                                if ($row['outcome'] != NULL) {
                                    if ($row['money_type'] == 'debit') {
                                        $money_outcome-=$row['outcome'];
                                    } else if ($row['money_type'] == 'credit') {
                                        $money_outcome+=$row['outcome'];
                                    }
                                    ?>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><?= ($row['money_type'] == 'debit') ? $row['outcome'] : '' ?></td>
                                    <td class="text-center"><?= ($row['money_type'] == 'credit') ? $row['outcome'] : '' ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">หมายเหตุ</p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    ข้อมูลทั้งหมดคือรายการที่มีการบันทึกในระบบ และเป็นข้อมูล ณ วันที่เวลาที่ได้แสดงในใบรายงาน
                </p>
            </div><!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">รายงาน ณ <?= $this->datetime->DBToHuman($now_time, TRUE) ?></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                                <th style="width:50%">รายรับ:</th>
                                <td><?= $money_income ?></td>
                            </tr>
                            <tr>
                                <th>รายจ่าย:</th>
                                <td><?= $money_outcome ?></td>
                            </tr>
                            <tr>
                                <th>คงเหลือ:</th>
                                <td><?= abs($money_income) - abs($money_outcome) ?></td>
                            </tr>
                        </tbody></table>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- this row will not appear when printing -->
        <?= $form_open ?>
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="<?= $print_link ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                <?php if (FALSE) { ?>
                    <button type="submit" name="action" value="pdf" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                <?php } ?>
            </div>
        </div>
        <?= form_close() ?>
    </section>

</div>