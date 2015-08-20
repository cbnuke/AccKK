<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>ตั้งค่าระบบ<small>ผู้ใช้งาน</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><a href="#"><i class="fa fa-gears"></i> ตั้งค่าระบบ</a></li>
            <li class="active"><a href="#"><i class="fa fa-user"></i> ผู้ใช้งาน</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ตารางรายชื่อผู้ใช้งาน</h3>
                <div class="pull-right box-tools">
                    <!-- Button trigger modal -->
                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#addModal" title="test"><i class="fa fa-plus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>ชื่อผู้ใช้งาน</th>
                            <th>สร้างวันที่</th>
                            <th>สร้างโดย</th>
                            <th>แก้ไขล่าสุดวันที่</th>
                            <th>แก้ไขโดย</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listUsers as $row) {
                            $per_delete = 'data-toggle="modal"';
                            $per_delete .= 'data-target="#deleteModal"';
                            $per_delete .= 'data-id_user="' . $row['id_user'] . '"';
                            $per_delete .= 'data-user_name="' . $row['user_name'] . '"';
                            $per_delete .= 'data-yes-href="' . base_url('setting/del_user') . '/' . $row['id_user'] . '"';

                            $per_edit = 'data-toggle="modal"';
                            $per_edit .= 'data-target="#editModal"';
                            $per_edit .= 'data-id_user="' . $row['id_user'] . '"';
                            $per_edit .= 'data-user_name="' . $row['user_name'] . '"';
                            ?>
                            <tr>
                                <td><?= $row['id_user'] ?></td>
                                <td><?= $row['user_name'] ?></td>
                                <td><span class="label label-success"><?= $this->datetime->DBToHuman($row['create_date']) ?></span></td>
                                <td><?= $row['create_by'] ?></td>
                                <td><span class="label label-info"><?= $this->datetime->DBToHuman($row['update_date']) ?></span></td>
                                <td><?= $row['update_by'] ?></td>
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
        $("#example1").DataTable();

        $('#editModal').on('show.bs.modal', function (e) {
            $(this).find('#edi_id_user').attr('value', $(e.relatedTarget).data('id_user'));
            $(this).find('#user_name').attr('value', $(e.relatedTarget).data('user_name'));
        });

        $('#deleteModal').on('show.bs.modal', function (e) {
            $(this).find('#btn_yes').attr('href', $(e.relatedTarget).data('yes-href'));

            $('#del_id').html($(e.relatedTarget).data('id_user'));
            $('#del_name').html($(e.relatedTarget).data('user_name'));
        });
    });
</script>

<?= form_open('setting/add_user', array('class' => 'form-horizontal')) ?>
<div class="modal fade" id="addModal" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มผู้ใช้งานใหม่</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-2 control-label">ID User</label>
                    <div class="col-sm-10">
                        <?= $input['id_user'] ?>
                    </div>
                </div>
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
                <h4 class="modal-title">คุณต้องการลบผู้ใช้งาน ใช่หรือไม่</h4>
            </div>
            <div class="modal-body">
                <p>ยืนยันการลบ ID User : <span id="del_id" class="label label-danger"></span></p>
                <p>ชื่อผู้ใช้งาน : <span id="del_name"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                <a href="#" class="btn btn-primary" id="btn_yes" ><i class="fa fa-check fa-lg"></i>&nbsp;ใช่</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>