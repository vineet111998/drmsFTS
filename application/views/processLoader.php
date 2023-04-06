<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Processing Excel</title>
    <style type="text/css">
    .progress {
  display: block;
  text-align: center;
  width: 0;
  height: 3px;
  background: red;
  transition: width .3s;
}
.progress.hide {
  opacity: 0;
  transition: opacity 1.3s;
}
    </style>
  </head>
  <body style="text-align:center; padding-top: 12%;">
    <img src="<?=$imgPath?>processing.gif" alt="" style="height:auto; width:auto;"/>
    <h2>Please do not press back or refresh</h2>
    <!-- <div class="progress">Progress</div> -->
  </body>
  <?php echo $forminputJS; ?>
  <script type="text/javascript">
    $(document).ready(function(e){
      var uploadID = '<?=$uploadID?>';
      var donorType = '<?=$donorType?>';
      var BASE_URL = '<?=base_url()?>';
      $.ajax({
        url: BASE_URL + 'administration/ajaxProcessExcel',
        type: "POST",
        data: "uploadID=" + uploadID + "&donorType=" + donorType,
        success: function (res) {
          // console.log(res);
          if(res == 0){
            alert("Error Uploading Data. Please upload afresh again.");
            window.location.href = BASE_URL+'administration/uploadDonors';
          } else {
            window.location.href = BASE_URL+'administration/excelData/' + donorType;
          }
        }, error: function (error) {
          // console.log(error);
          alert("Error Uploading Data. Please upload afresh again.");
          window.location.href = BASE_URL+'administration/uploadDonors';
        }
      });
    });


  </script>
</html>
