<?php foreach($this->groups as $group_id => $group_item): ?>
    <div class="form-group mb-4">
        <label class="mr-sm-2" for="<?='group_' . $group_id;?>"><?=$group_item?></label>
        <select class="custom-select mr-sm-2" id="<?='group_' . $group_id;?>" name="attrs[<?=$group_id;?>]">
            <?php if(!empty($this->attrs[$group_id])): ?>
                <option value="0">Не выбрано</option>
                <?php foreach($this->attrs[$group_id] as $attr_id => $value): ?>
                    <?php
                    if(!empty($this->filter) && in_array($attr_id, $this->filter)){
                        $selected = ' selected';
                    }else{
                        $selected = null;
                    }
                    ?>
                    <option value="<?=$attr_id;?>"<?=$selected;?>><?=$value;?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
<?php endforeach; ?>