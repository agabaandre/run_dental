<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Run Dental Clinic</title>
    </head>
            <style>
            *{
                font-size: 12px;
                font-family: 'Times New Roman';
            }

            td,
            th,
            tr,
            table {
                border-top: 1px solid black;
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 80px;
                max-width: 80px;
            }

            td.quantity,
            th.quantity {
                width: 45px;
                max-width: 45px;
                word-break: break-all;
            }

            td.price,
            th.price {
                width: 45px;
                max-width: 45px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 170px;
                max-width: 170px;
            }

            img {
                max-width: 140px;
                width: 130px;
                height:60px;
                margin-bottom: -30px;
                
            }

            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
    </style>
   
    <body>
    <button id="btnPrint" class="hidden-print">Print</button>

    <script>
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
        <div class="ticket">
        <div style="text-align:center; width:100%">
            <div style="margin:auto; text-align:left;">
             <img src="<?php echo base_url()?>assets/images/logo.PNG" alt="Logo">
            <?php $this->load->model("Request", "requestHandler"); 
                $settings = $this->requestHandler->settings();
     
            ?>
            </div>
    </div>
            
            <p style="text-align:center;">
                <br><?php echo $settings->company;?>
                <br><?php echo $settings->address;?>
                Contact: <?php echo $settings->phone_number;?>
                 <?php echo $settings->email;?>
             </p>


            <table>
                <thead>
                <tr>
                <td colspan=3>
                <?php  
                    
                    echo "<b>CLIENT: ". $patient=$bill[0]->name. ' <br> DATE: '.
                    date("j, F Y", strtotime($bill[0]->posting_date)).'<br> CONTACT: '. $bill[0]->mobile .'</b>';
                    ?>
                </td>
               </tr>
              
                    <tr>
                        <th>#</th>
                        <th class="description">Description</th>
                        <th class="price">UGX</th>
                    </tr>
               
                </thead>
                <tbody>
                <?php $i=1; foreach($bill as $row){ ?>
                    <tr>
                        <td><?php echo $i++.". "; ?></td>
                        <td class="description" style="font-size:11px;"> <?php echo $row->description; ?></td>
                        <td class="price" style="font-size:11px;"> <?php echo $row->amount;  $sum += $row->amount;?></td>
                    </tr>
                 <?php } ?>
                    
            </table>
            <p class="centered">Thanks you!. Quick Recovery
                <br>www.rundental.com</p>
        </div>
      
        
    </body>
</html>