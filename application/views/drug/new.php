<div class="row">
  <div class="col col-md-8 well well-sm">
    <?php echo form_open('drug/new_drug', array("id" => "newDrugForm", "role" => "form",)); ?>
    <fieldset>
      <legend>- Drug Information:</legend>
      <div>
        <?php echo (!empty($error) ? $error : ''); ?>
        <div class="form-group">
          <div class="col-md-6"><input type="text" name='drug_name_en' id="drug_name_en" value="<?php echo $this->input->post('drug_name_en'); ?>" class='form-control' placeholder='Drug Name' title='Drug Name' required autofocus /></div>
          <div class="col-md-6"><input type="hidden" value="name_ur" name='drug_name_fa' id='drug_name_fa' value="<?php echo $this->input->post('drug_name_fa'); ?>" class='form-control' placeholder='نام دارو' title='نام دارو' value="testing" /></div>
          <div class="col-md-6">
            <input type="text" name='no_of_item' id="no_of_item" value="<?php echo $this->input->post('no_of_item'); ?>" class='form-control' placeholder='No of Days' title='Drug Name' required autofocus />
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6">
            <select name="times" class="form-control">
              <option value="" selected>Select No. of times in a Day</option>
              <option value="1 time">1 time</option>
              <option value="2 times">2 times</option>
              <option value="3 times">3 times</option>
              <option value="L/A x 3">L/A x 3</option>
            </select>
          </div>
          <div class="col-md-6">
            <select name="slot" class="form-control">
              <option value="" selected>Select Take Time</option>
              <option value="Before Food">Before Food</option>
              <option value="After Food">After Food</option>
              <option value="Anytime">Anytime</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6"><input type="text" name='category' id='category' value="<?php echo $this->input->post('category'); ?>" class='form-control' placeholder='Category' title='Category' /></div>
          <div class="col-md-6"><input type="number" name='price' id='price' value="<?php echo $this->input->post('price'); ?>" class='form-control' placeholder='Price(AF)' title='Price (AF)' required /></div>
          <div class="col-md-6"><input type="number" step=".01" name='dosage_mg' id='dosage_mg' value="<?php echo $this->input->post('dosage_mg'); ?>" class='form-control' placeholder='Drug (MG)' title='Dosage MG' /></div>
          <div class="col-md-6"><input type="number" step=".01" name='dosage_ml' id='dosage_ml' value="<?php echo $this->input->post('dosage_ml'); ?>" class='form-control' placeholder='Drug (ML)' title='Dosage ML' /></div>
          <div class="col-md-6"><input type="number" step=".01" name='dosage' id='dosage' value="<?php echo $this->input->post('dosage'); ?>" class='form-control' placeholder='Drug Dosage' title='Dosage' /></div>
        </div>
        <div class="clearfix"></div>
    </fieldset>
    <fieldset>
      <legend>- Memo:</legend>
      <div>
        <div class="form-group">
          <div class="col-md-12"><textarea name="memo" id="memo" class="form-control" rows="10"><?php echo $this->input->post('memo'); ?></textarea>
          </div>
        </div>
    </fieldset>
    <div class="form-group">
      <div class="col-md-6"><input type="submit" name='submit' id='submit' value='Register' class="form-control btn btn-info" /></div>
      <div class="col-md-6"><?php echo anchor('drug', 'Cancel', array('class' => 'form-control btn btn-info')); ?></div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>