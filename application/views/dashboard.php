<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('head'); ?>
<body>
   <?php $this->load->view('header'); ?>
   <section class="section-b-space banner-6 ratio2_1" style="padding-bottom:60px;">
      <div class="container">
         <div class="row">
            <div class="col">
               <div class="title1 title5">
                  <h2 class="title-inner1">Gallery</h2>
                  <hr role="tournament6">
               </div>
            </div>
         </div>
         <div class="row partition3">
            <?php foreach ($data as $key => $value) {
            ?>
               <div class="col-md-4 p-0 mb-4">
                  <div class="col-12 ">
                     <div class="col-sm-12 p-3 border">
                     <h2><?php echo $value['image_name'] ?></h2>
                     </div>
                     <div class="col-sm-12 p-0">
                        <div class="collection-banner p-left">
                           <div class="img-part">
                              <img src="<?php echo base_url()  ?>assets/images/service/<?php echo $value['image_path'] ?>" class="img-fluid blur-up lazyload bg-img" alt="">
                           </div>
                           <div class="contain-banner banner-3">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12  border-top-0 mt-3">
                     <div class="col-6  p-3 float-left border text-center text-danger">
                     <?php echo "Age :".$value['age']; ?></h2>
                     </div>
                     <div class="col-6 p-3 float-left border text-center text-danger">
                     <?php echo date('d-M-Y', strtotime($value['dob'])); ?></h2>
                     </div>
                     <div class="col-12 p-3 float-left border text-center text-danger">
                     <?php echo "Designation :".$value['designation']; ?></h2>
                     </div>
                  </div>
               </div>
            <?php
            } ?>

         </div>
   </section>
   <?php $this->load->view('footer'); ?>
</body>

</html>