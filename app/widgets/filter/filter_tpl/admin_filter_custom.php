<?php foreach($this->groups as $group_id => $group_item): ?>
<div class="form-group mb-4">
    <label class="mr-sm-2" for="<?='group_' . $group_id;?>"><?=$group_item?></label>
    <select class="custom-select mr-sm-2" id="<?='group_' . $group_id;?>" name="attrs[<?=$group_id;?>]">
        <?php if(!empty($this->attrs[$group_id])): ?>
            <option selected>Выбрать</option>
            <?php foreach($this->attrs[$group_id] as $attr_id => $value): ?>
            <option value="<?=$attr_id;?>"><?=$value;?></option>
            <?php endforeach; ?>
        <?php endif; ?>
    </select>
</div>
<?php endforeach; ?>