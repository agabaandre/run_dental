<footer class="main-footer" style="color:white;background-color:#222d32; font-size:10px; margin-bottom:0px;" >
      <strong>Copyright &copy; Run Dental Clinic  <?php echo date("Y")." "; ?>  </strong> All rights reserved <version style="float:right;">Powered by TimeLead Enterprises  +256702787688</version>

      
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

<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script>
  $(function () {

    // CKEDITOR.replace('.editor1');
    CKEDITOR.replaceClass="editor";
    $(".textarea").wysihtml5();
  });
</script>