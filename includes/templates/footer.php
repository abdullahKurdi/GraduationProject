<div class="footer">
            <footer class="site-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <h6><?php echo lang('About');?></h6>
                            <p class="text-justify">
                            <?php echo lang('The goal of our website is to creat an easy-to-use website, to reduce customer concerns about the online buying and selling process through electronic auctions , and to achive customer satisfaction and comfort.');?>
                            </p>
                        </div>
                        <div class="col-6 col-md-3">
                            <h6 class="xxx"><?php echo lang('Categories');?></h6>
                            <ul class="footer-links">
                                <?php $cats = getCat('where Parent = 0');
                                    foreach($cats as $cat){
                                        echo '<li><a href="Category.php?Catid='.$cat['CatID'].'">'.lang($cat['CatName']).'</a></li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <h6 class="xxx"><?php echo lang('Quick Links');?></h6>
                            <ul class="footer-links">
                                <li><a href="index.php"><?php echo lang('Home');?></a></li>
                                <li><a href="#"><?php echo lang('manual');?></a></li>
                                <li><a href="#"><?php echo lang('privacy policy');?></a></li>
                                <li><a href="contact.php"><?php echo lang('Contact Us');?></a></li>
                            </ul>
                        </div>
                    </div>
                    <hr class="small">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-sm-6 col-12">
                                <p class="copyright-text"><?php echo lang('Copyright &copy; 2021 All Rights Reserved By');?> <a href="index.php"><?php echo lang('Arab Auctions');?></a></p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <ul class="social-icons">
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                                    <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php if(isset($paypal) && $paypal == 'on'){?>
        <script src="https://www.paypal.com/sdk/js?client-id=AW_ez3gXuMEQaAVqIlmS35-HV513qvhDu62lUDBPebFLmGTj1EQpohXfCc-oouIG24SXtOYJmWoDvayw"></script>
        <script>
            paypal.Buttons({
                style:{shapes:'pill',},
                createOrder:function(data,actions){
                    return actions.order.create({
                        purchase_units:[{
                            amount:{
                                value:'10.0'
                            }
                        }]
                    });
                },
                onApprove:function(data,actions){
                    return actions.order.capture().then(function(details){
                        console.log(details)
                    window.location.assign("http://localhost/arab-auction/controlPanel/includes/libraries/Done.php")
                    })
                },
                onCancel: function(data){
                    window.location.assign("http://localhost/arab-auction/profile.php")
                }
                }).render('#paypal-payment-button');
        </script>
    <?php }?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="<?php echo $js ;?>jquery.min.js"></script>
    <script src="<?php echo $js ;?>javaScript.js"></script>
  </body>
</html>