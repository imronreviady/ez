          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <?php echo form_open('admin/menu/delete_multi'); ?>
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
                        <th><?=ez_line('alias')?></th>
                        <th><?=ez_line('items')?></th>
                        <th><span class="nobr"><?=ez_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($menus as $menu): ?>
                      <tr>
                        <td class="text-center"><?=$menu->id?></td>
                        <td><?=$menu->title?></td>
                        <td><?=$menu->alias?></td>
                        <td><?=count_table('menu_items', array('menu_id' => $menu->id))?></td>
                        <td>
                          <a href="<?=base_url('admin/menu/edit/' . $menu->id)?>" class="label label-info" data-toggle="tooltip" data-title="<?=ez_line('edit', $this->lang->line('menu') )?>"><i class="fa fa-lg fa-pencil"></i></a>
                          <a onClick="javascript:return confirm('<?=ez_line('delete_confirm_msg')?>');" href="<?=base_url('admin/menu/delete/' . $menu->id)?>" class="label label-danger" data-toggle="tooltip" data-title="<?=ez_line('delete', $this->lang->line('menu') )?>"><i class="fa fa-lg fa-trash"></i></a> 
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table> 
                  <?php echo form_close(); ?>                 
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">

                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title"><?=ez_line('add', $this->lang->line('menu') )?></h3>
                      </div><!-- /.box-header -->
                      <?=form_open('admin/menu/edit', array('class' => 'form'))?>
                      <div class="box-body">
                <div class="form-group">
                  <?php
                  echo form_label(ez_line('title'),'title');
                  echo form_input('title',set_value('title'),'class="form-control"');
                  echo form_error('title', '<p class="text-danger">', '</p>');
                  ?>
                </div>
                <div class="form-group">
                  <?php
                  echo form_label(ez_line('alias'),'alias');
                  echo form_input('alias',set_value('alias'),'class="form-control"');
                  echo form_error('alias', '<p class="text-danger">', '</p>');
                  ?>
                </div>

                      </div><!-- /.box-body -->
                      <div class="box-footer">
                  <?php echo form_submit('submit', ez_line('save'), 'class="btn btn-success btn-lg btn-block"');?>
                      </div><!-- box-footer -->
                      <?=form_close()?>
                    </div><!-- /.box -->

            </div>

          </div>