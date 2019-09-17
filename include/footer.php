</section>
<footer class="footer p-t-1">
        <div class="container">
            <div class="pull-right">
                <nav class="navbar" >
                    <nav class="nav navbar-nav pull-xs-left" style="margin: 30px 10px;">
                        <a class="nav-item nav-link" href="index.php" style="margin: 0px 5px; display: inline; color: blue; text-decoration: none;">Home </a>
                        <a class="nav-item nav-link" href="about.php" style="margin: 0px 5px; display: inline; color: blue; text-decoration: none;"> About </a>
                        <a class="nav-item nav-link" href="#" style="margin: 0px 5px; display: inline; color: blue; text-decoration: none;"> Help</a>
                    </nav>
                </nav>
            </div>

            <a style="display: inline;" href="https://www.facebook.com/amr.degheidy" target="_blank"><i class="fa fa-facebook-official fa-2x" style="color: #3b5998;margin: 10px 5px;"></i></a>
            <a style="display: inline;" href="https://twitter.com/Amr_Degheidy"> <i class="fa fa-twitter fa-2x" style="color: #1da1f2;margin: 10px 5px;"> </i> </a>
            <a style="display: inline;" href="https://www.linkedin.com/in/amr-degheidy-291b83110/" target="_blank"><i class="fa fa-linkedin fa-2x" style="color: #0077b5; margin: 10px 5px;"></i></a>
            <a style="display: inline;" href="https://plus.google.com/u/0/115050668040456092894"><i class="fa fa-google fa-2x" style="color: #db4437;margin: 10px 5px;"></i></a>
            <a style="display: inline;" href="https://www.instagram.com/amrdegheidy/"><i class="fa fa-instagram fa-2x " style="color: white; margin: 10px 5px;"></i></a>
            <h3 id="clockbox" style="margin-top: 0px; color: #a7a7a7;"></h3>
            <p class="h6">
                
                <a style="color:#333;" href="https://www.facebook.com/amr.degheidy" target="_blank">Powered by BEST OFFER Team</a>

            </p>


        </div>  

    </footer>
<?php close_db(); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ct-navbar.js"></script>
    <script src="js/form.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">

function GetClock(){
d = new Date();
nhour  = d.getHours();
nmin   = d.getMinutes();
nsec   = d.getSeconds();
     if(nhour ==  0) {ap = " AM";nhour = 12;} 
else if(nhour <= 11) {ap = " AM";} 
else if(nhour == 12) {ap = " PM";} 
else if(nhour >= 13) {ap = " PM";nhour -= 12;}

if(nmin <= 9) {nmin = "0" +nmin;}


document.getElementById('clockbox').innerHTML=" "+nhour+":"+nmin+":"+nsec+" "+ap+" ";
setTimeout("GetClock()", 1000);
}
window.onload=GetClock;
</script>


  </body>
</html>