<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>เพิ่ม รายรับ รายจ่าย<small>รายรับ</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-edit"></i> เพิ่ม รายรับ รายจ่าย</a></li>
            <li class="active"><a href="#"><i class="fa fa-usd"></i> รายรับ</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ตารางรายรับ</h3>
                <div class="pull-right box-tools">
                    <!-- Button trigger modal -->
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal" title="test"><i class="fa fa-plus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <?php
                $total_debit = 0;
                $total_credit = 0;
                ?>
                <table id="example1" class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>วันที่ เวลา</th>
                            <th>คำอธิบาย</th>
                            <th>DEBIT</th>
                            <th>CREDIT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listTransaction as $key => $row) {
                            $per_delete = 'data-toggle="modal"';
                            $per_delete .= 'data-target="#deleteModal"';
                            $per_delete .= 'data-del_date="' . $this->datetime->DBToHuman($row['action_date'], TRUE) . '"';
                            $per_delete .= 'data-del_amount="' . $row['income'] . '"';
                            $per_delete .= 'data-yes-href="' . base_url('accounting/del_transaction/income') . '/' . $row['id_tran'] . '"';

                            $per_edit = 'data-toggle="modal"';
                            $per_edit .= 'data-target="#editModal"';
                            $per_edit .= 'data-id_tran="' . $row['id_tran'] . '"';
                            $per_edit .= 'data-income="' . $row['income'] . '"';
                            $per_edit .= 'data-money_type="' . $row['money_type'] . '"';
                            $temp = date("m/d/Y h:i A", strtotime($row['action_date']));
                            $per_edit .= 'data-action_date="' . $temp . '"';
                            $per_edit .= 'data-comment="' . $row['comment'] . '"';

                            if ($row['money_type'] == 'debit') {
                                $total_debit+=$row['income'];
                            } else if ($row['money_type'] == 'credit') {
                                $total_credit+=$row['income'];
                            }
                            ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><span class="label label-success"><?= $this->datetime->DBToHuman($row['action_date'], TRUE) ?></span></td>
                                <td><?= $row['comment'] ?></td>
                                <td><?= ($row['money_type'] == 'debit') ? $row['income'] : '' ?></td>
                                <td><?= ($row['money_type'] == 'credit') ? $row['income'] : '' ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" <?= $per_edit ?>><i class="fa fa-pencil-square-o"></i></button>
                                    <button class="btn btn-danger btn-sm" <?= $per_delete ?>><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-center">รวม</th>
                            <th><?= $total_debit ?></th>
                            <th><?= $total_credit ?></th>
                            <th><?= $total_credit - $total_debit ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(function () {
        $("#example1").DataTable({
            "order": [[0, "desc"]]
        });

        $('#editModal').on('show.bs.modal', function (e) {
            $(this).find('#id_tran').attr('value', $(e.relatedTarget).data('id_tran'));
            $(this).find('#income').attr('value', $(e.relatedTarget).data('income'));

            $(this).find('input:radio[name="money_type"]').filter('[value="' + $(e.relatedTarget).data('money_type') + '"]').attr('checked', true);

            $(this).find('#action_date').attr('value', $(e.relatedTarget).data('action_date'));
            $(this).find('#comment').html($(e.relatedTarget).data('comment'));

            $(this).find('#action_date').datetimepicker();
        });

        $('#deleteModal').on('show.bs.modal', function (e) {
            $(this).find('#btn_yes').attr('href', $(e.relatedTarget).data('yes-href'));

            $('#del_date').html($(e.relatedTarget).data('del_date'));
            $('#del_amount').html($(e.relatedTarget).data('del_amount'));
        });

        $('#action_date').datetimepicker();
    });
</script>
<?= form_open('accounting/add_transaction/income', array('class' => 'form-horizontal')) ?>
<div class="modal fade" id="addModal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มรายรับ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">จำนวนเงิน</label>
                    <div class="col-sm-10">
                        <?= $input['income'] ?>
                    </div>
                </div>
                <div class="form-inline form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-10">
                        <?= $input['money_type'] ?>
                    </div>
                </div>
                <div class="form-inline form-group">
                    <label class="col-sm-2 control-label">ประเภทค่าใช้จ่าย</label>
                    <div class="col-sm-10">
                        <?= $input['id_type'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">วันที่รายรับ</label>
                    <div class="col-sm-10">
                        <?= $input['action_date'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">คำอธิบาย</label>
                    <div class="col-sm-10">
                        <?= $input['comment'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">เพิ่ม</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?= form_close() ?>

<?= form_open('accounting/edit_transaction/income', array('class' => 'form-horizontal')) ?>
<div class="modal fade" id="editModal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">แก้ไขรายรับ</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">จำนวนเงิน</label>
                    <div class="col-sm-10">
                        <?= $input['income'] ?>
                    </div>
                </div>
                <div class="form-inline form-group">
                    <label class="col-sm-2 control-label"> </label>
                    <div class="col-sm-10">
                        <?= $input['money_type'] ?>
                    </div>
                </div>
                <div class="form-inline form-group">
                    <label class="col-sm-2 control-label">ประเภทค่าใช้จ่าย</label>
                    <div class="col-sm-10">
                        <?= $input['id_type'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">วันที่รายรับ</label>
                    <div class="col-sm-10">
                        <?= $input['action_date'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">คำอธิบาย</label>
                    <div class="col-sm-10">
                        <?= $input['comment'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_tran" id="id_tran" value=""/>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <button type="submit" class="btn btn-primary">แก้ไข</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<?= form_close() ?>

<div class="modal fade" id="deleteModal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">คุณต้องการลบรายการ ใช่หรือไม่</h4>
            </div>
            <div class="modal-body">
                <p>วันที่ เวลา: <span id="del_date" class="label label-success"></span></p>
                <p>จำนวน : <span id="del_amount"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <a href="#" class="btn btn-primary" id="btn_yes" ><i class="fa fa-check fa-lg"></i>&nbsp;ใช่</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>