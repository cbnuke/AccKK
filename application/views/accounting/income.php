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
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-hover">
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
                            $per_edit .= 'data-id_user="' . $row['income'] . '"';
                            $per_edit .= 'data-user_name="' . $row['money_type'] . '"';
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
            $(this).find('#edi_id_user').attr('value', $(e.relatedTarget).data('id_user'));
            $(this).find('#user_name').attr('value', $(e.relatedTarget).data('user_name'));
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
                <div class="form-inline form-group" style="padding-left: 150px;">
                    <div class="radio">
                        <label>
                            <input type="radio" name="money_type" value="debit" checked="">
                            DEBIT
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="money_type" value="credit">
                            CREDIT
                        </label>
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

<?= form_open('setting/edit_user', array('class' => 'form-horizontal')) ?>
<div class="modal fade" id="editModal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">แก้ไขผู้ใช้งาน</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ชื่อผู้ใช้งาน</label>
                    <div class="col-sm-10">
                        <?= $input['user_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <?= $input['user_pass'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_user" id="edi_id_user" value=""/>
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