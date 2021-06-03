<footer class="main-footer" style="color:white;background-color:#222d32; font-size:10px; margin-bottom:0px;" >
      <strong>Copyright &copy; Run Dental Clinic  <?php echo date("Y")." "; ?>  </strong> All rights reserved <version style="float:right;">Powered by TimeLead Enterprises  +256702787688</version>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
      <!-- <script src="../../bower_components/moment/min/moment.min.js"></script> -->
      <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
      <?php if($this->uri->segment(3)=="reports"){ ?>
      <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script> 
      <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
      <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
      <?php } ?>
      <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/notify.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>
      
      <script src="<?php echo base_url(); ?>assets/js/dental.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/jquery.1.4.1.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/wickedpicker.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/typeahead.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
      
      
</footer>
<script>
    
$('.timepicker').wickedpicker();

bindAuto();

function bindAuto(){
$(".selectProd").autocomplete({
      minLength: 2,
      appendTo: "#data_form",
      source:function(query, process) {
      var price= 1000  ; //$("#field1").val();
 
      $.ajax({
        url: '<?php echo base_url(); ?>clinic/getProdlist/'+query.term,
        type: 'GET',
        dataType: 'JSON',
        async: true,
        success: function(data) {
            console.log(data);
            element = $(this);
            let source = [];
            data.map( (product)=>{
            source.push({"label":product.product,"price":product.price});
          })
          process(source);
        }
      });
    },
    select( event, ui ){

        var productdata = ui.item;

        // var qntyInput = $(".qnty");
        // var priceInput = $(".rowTotal");

        // console.log($(event.target).prop("value","Noooo"));
        
        // let price = productdata.price;
        // let qnty = (qntyInput.val()>0)?qntyInput.val():1;
        // let total = (price)? parseInt(price) :null;
        // let rowTotal = (price && qnty)?  qnty* total:total;
         
        // $(priceInput).val(1000);
        // $(qntyInput).val(1);

        // console.log(priceInput);
        // console.log(qntyInput);
    }
  });

}

</script>
<?php
if (isset($message)){
if($message=="Successful"){
      ?>
      <script>
     $.notify("Succesful", "success", { showAnimation: 'slideDown',
       showDuration: 40000,
       hideAnimation: 'slideUp'});
      
      </script>
      <?php 
       } else { ?>
       <script>
       $.notify("Failed", "warn");
       </script>
   <?php   }
   }
?>
<script>

$(document).ready(function() {
    var max_fields = 5; 
    var x = 1; 
    $('.add_bill').click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $('.bill_item').append('<div><div class="col-md-6"><input type="text" class="form-control selectProd" name="description[]" autocomplete="off" style="width:100%; margin-top:4px;" placeholder="DESC" required></div><div class="col-md-2"><input type="number" class="form-control quantity qnty" name="qty" autocomplete="off" style="width:100%; margin-top:4px;" placeholder="QTY" required></div> <div class="col-md-4"><input type="number" class="form-control bills rowTotal" name="bill[]" autocomplete="off" style="width:100%; margin-top:4px;" placeholder="UGX" required></div><a href="#"  style="margin-left:14px;" class=" btn btn-sm btn-default remove_field"><i class="fa fa-minus" aria-hidden="true"></i></a></div>'); //add input box
            bindAuto();
        }
       
    });

    $('.bill_item').on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


$(document).on("keyup", ".bills", function() {
    var sum = 0;
    $(".bills").each(function(){
        sum += +$(this).val();
    });
    $(".result").html(sum);
});

</script>

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {

    // CKEDITOR.replace('.editor1');
    CKEDITOR.replaceClass="editor";
    $(".textarea").wysihtml5();
  });
</script>