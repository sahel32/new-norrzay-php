<div class="row">
    <div class="col-md-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                اطلاعات عمومی چک
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                        <thead>
                        <tr>
                            <th> کد چک</th>
                            <th>صادر کننده چک</th>
                            <th>نوع چک</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($check_info as $key => $value) {
                            ?>
                            <tr class="odd gradeX">
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