<form method="POST" class="form-horizontal" action="">
    <?=$this->getTokenField() ?>
    <div class="form-group">
        <label for="smiley_filetypes" class="col-lg-2 control-label">
            <?=$this->getTrans('allowedFileExtensions') ?>:
        </label>
        <div class="col-lg-2">
            <input name="smiley_filetypes" 
                   type="text" 
                   id="smiley_filetypes" 
                   class="form-control required" 
                   value="<?=$this->get('smiley_filetypes') ?>" />
        </div>
    </div>
    <?=$this->getSaveBar(); ?>
</form>
