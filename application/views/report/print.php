<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Accounting KaenKaew | Report</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <?= css('bootstrap.min.css') ?>
        <!-- Font Awesome -->
        <?= css('font-awesome.min.css') ?>
        <!-- Ionicons -->
        <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
        <!-- Theme style -->
        <?= css('AdminLTE.min.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body onload="window.print();">
        <div class="wrapper">
            <!-- Main content -->
            <section class="invoice">
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
                <div class="row no-print">
                    <div class="col-xs-12">
                        <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </section><!-- /.content -->
        </div><!-- ./wrapper -->

        <!-- AdminLTE App -->
        <?= js('app.min.js') ?>
    </body>
</html>
