  <?php 
     if(isset($_POST['ip']) && isset($_POST['port']) && isset($_POST['key'])){
        update_option('qsap_ip',$_POST['ip']);
        update_option('qsap_port',$_POST['port']);
        update_option('qsap_key',$_POST['key']);
     }
   

     
   ?>
  <div class="row">
    <div class="col">
      <h3 class="text-center mt-3">SAP Settings Connection </h3>
    </div>
  </div>
  <hr>
  <h5>Connection Data</h5>
  <div class="row">
      <div class="col-3"></div>
      <div class="col-6">
        <form action="./admin.php?page=main-menu" method='post'>
          <div class="form-group">
            <label for="ip">IP:</label>
            <input  class="form-control" id="ip_sap" aria-describedby="IP" placeholder="IP" name="ip" value="<?php echo get_option('qsap_ip') ?>" required>
          </div>
          <div class="form-group">
            <label for="port_sap">PORT:</label>
            <input type="number" class="form-control" id="port_sap" aria-describedby="Port" placeholder="Port" name="port" value="<?php echo get_option('qsap_port') ?>" required>
          </div>
          <div class="form-group" hidden>
            <label for="ip_real_sap">Key:</label>
            <input  class="form-control" id="ip_real_sap" aria-describedby="Key" placeholder="Key" name="ip_real_sap" value="<?php echo $_SERVER['REMOTE_ADDR'] ?>" required>
          </div>
          <div class="form-group">
            <label for="key_sap">Key:</label>
            <input  class="form-control" id="key_sap" aria-describedby="Key" placeholder="Key" name="key" value="<?php echo get_option('qsap_key') ?>" required>
          </div>
          <input type="button" id="test_connection_btn" class="btn btn-primary" value='Test'>
          <button id="test_connection_btn" class="btn btn-primary">Save</button>
          <small id="result_connection"></small>
        </form>
      </div>
      <div class="col-3">
        
      </div>
  </div>