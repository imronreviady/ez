        <?php echo form_open('admin/pages/delete_multi'); ?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <button type="submit" onClick="javascript:return confirm('<?=ez_line('delete_confirm_msg')?>');" class="btn btn-danger delete_multi"><i class="fa fa-trash"></i> <?=ez_line('delete', 'selected')?></button>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                          <div class="pretty info smooth">
                            <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                            <label><i class="fa fa-check"></i></label>
                          </div>
                        </th>
                        <th><?=ez_line('title')?></th>
                        <th><?=ez_line('statue')?></th>
                        <th><span class="nobr"><?=ez_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($pages as $page): ?>
                      <tr>
                        <td class="text-center"><?=post_id($page)?></td>
                        <td><a href="<?=post_url($page)?>" target="_blank"><?=post_title($page)?></a></td>
                        <td><?=post_statue($page) == 1 ? '<span class="label label-success" data-toggle="tooltip" data-title="'.ez_line("active").'"><i class="fa fa-lg fa-check-circle"></i></span>': '<span class="label label-danger" data-toggle="tooltip" data-title="'.ez_line("hidden").'"><i class="fa fa-lg fa-times-circle"></i></span>'?></td>
                        <td>
                          <a href="<?=base_url('admin/pages/edit/' . post_id($page))?>" class="label label-info" data-toggle="tooltip" data-title="<?=ez_line('edit', $this->lang->line('page') )?>"><i class="fa fa-lg fa-pencil"></i></a>
                          <a onClick="javascript:return confirm('<?=ez_line('delete_confirm_msg')?>');" href="<?=base_url('admin/pages/delete/' . post_id($page))?>" class="label label-danger" data-toggle="tooltip" data-title="<?=ez_line('delete', $this->lang->line('page') )?>"><i class="fa fa-lg fa-trash"></i></a> 
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>                  
                </div>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>