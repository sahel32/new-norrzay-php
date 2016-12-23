<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">

                اطلاعات عمومی
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                        <thead>
                        <tr>
                            <th>ای دی </th>
                            
                            <th> کد چک</th>
                            <th>اسم صادرکننده</th>
                            <th>نوع</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($check_info as $key => $value) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php  echo $value->id;?></td>

                                <td><?php  echo $value->code;?></td>
                                <td class="center"><?php  echo $value->name;?></td>
                                <td class="center"><?php  echo $value->type;?></td>
                            </tr>
                        <?php  }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>