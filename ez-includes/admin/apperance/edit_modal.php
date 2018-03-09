                      <div class="form-group">
                        <label for="edititemType">Select type</label>
                        <select name="type" id="edititemType" class="form-control not">
                          <option value="">Select Type</option>
                          <option value="home" <?=$item->type == 'home' ? ' selected' : null?>><?=ez_line('home')?></option>
                          <option value="contact" <?=$item->type == 'contact' ? ' selected' : null?>><?=ez_line('contact')?></option>
                          <option value="posts" <?=$item->type == 'posts' ? ' selected' : null?>><?=ez_line('posts')?></option>
                          <option value="page" <?=$item->type == 'page' ? ' selected' : null?>>Page</option>
                          <option value="category" <?=$item->type == 'category' ? ' selected' : null?>>Category</option>
                          <option value="post" <?=$item->type == 'post' ? ' selected' : null?>>Post</option>
                          <option value="custom" <?=$item->type == 'custom' ? ' selected' : null?>>Custom link</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="edittypeItems">Select item</label>
                        <select name="edittypeItems" data-placeholder="Select item" id="edittypeItems" class="form-control not">
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="edititemId">Item id</label>
                        <input type="text" name="item_id" class="form-control" id="edititemId"/>
                      </div>
                      <div class="form-group">
                        <label for="edititemTitle">Title</label>
                        <input type="text" name="title" class="form-control" id="edititemTitle"/>
                      </div>
                      <div class="form-group">
                        <label for="edititemUrl">link</label>
                        <input type="text" name="link" class="form-control" id="edititemUrl"/>
                      </div>

<script type="text/javascript">
  $(document).ready(function(){

      var itemType = $("#edititemType :selected").val();
      //alert(itemType);
      var postUrl = "<?= base_url() ?>admin/menu/list_items/" + itemType;
      if(itemType !== 'custom' && itemType !== 'home' && itemType !== 'contact' && itemType !== 'posts') {
        $.post(postUrl, { itemType: itemType }, function(data){
          var result = '<option value="">Select item</option>';
          $.each(data, function(i, data) {
            var link = '<?=base_url()?>' + itemType + '/';
            link += data.id + "/" + data.slug;
            var curId = '<?=$item->item_id?>';
            var isSel = '';
            if(curId === data.id) { isSel = ' selected'; }
            result += "<option value='" + link + "' data-id='"+ data.id +"'" + isSel + ">" + data.title + "</option>";
	        $('#edititemTitle').val(data.title);
	        $('#edititemId').val(data.id);
	        $('#edititemUrl').val(link);
          });
          $('#edittypeItems').html(result);
        });
      } else {
        $('#edittypeItems').html("<option value=''>Select item</option>");
        $('#edititemTitle').val('<?=$item->title?>');
        $('#edititemId').val('0');
        $('#edititemUrl').val('<?=$item->link?>');
      }


    $("#edititemType").on('change', function() {
      var itemType = this.value;
      //alert(itemType);
      var postUrl = "<?= base_url() ?>admin/menu/list_items/" + itemType;
      if(itemType !== 'custom' && itemType !== 'home' && itemType !== 'contact' && itemType !== 'posts') {
        $.post(postUrl, { itemType: itemType }, function(data){
          var result = '<option value="">Select item</option>';
          $.each(data, function(i, data) {
            var link = '<?=base_url()?>' + itemType + '/';
            link += data.id + "/" + data.slug;
            result += "<option value='" + link + "' data-id='"+ data.id +"'>" + data.title + "</option>";
          });
          $('#edittypeItems').html(result);
        });
        $('#edititemTitle').val('');
        $('#edititemId').val('');
        $('#edititemUrl').val('');
      } else if(itemType == 'home') {
        $('#edittypeItems').html("<option value=''>Select item</option>");
        $('#edititemTitle').val('Home');
        $('#edititemId').val('0');
        $('#edititemUrl').val('<?=base_url()?>');
      } else if(itemType == 'posts') {
        $('#edittypeItems').html("<option value=''>Select item</option>");
        $('#edititemTitle').val('Posts');
        $('#edititemId').val('0');
        $('#edititemUrl').val('<?=base_url('posts')?>');
      } else if(itemType == 'contact') {
        $('#edittypeItems').html("<option value=''>Select item</option>");
        $('#edititemTitle').val('Contact');
        $('#edititemId').val('0');
        $('#edititemUrl').val('<?=base_url('contact')?>');
      } else {
        $('#edittypeItems').html("<option value=''>Select item</option>");
        $('#edititemTitle').val('');
        $('#edititemId').val('0');
        $('#edititemUrl').val('');
      }

    });

    $("#edittypeItems").on('change', function() {
      var edititemTitle = $("#edittypeItems option:selected").text();
      var edititemURL = this.value;
      var edititemId = $("#edittypeItems option:selected").attr('data-id');
      $('#edititemTitle').val(edititemTitle);
      $('#edititemId').val(edititemId);
      $('#edititemUrl').val(edititemURL);
     });
  });	
</script>