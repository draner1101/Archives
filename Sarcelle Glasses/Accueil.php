


    <!--Instruction php pour render Header.htm ici-->
    <?php 
    $page_title = "Accueil";   
    
    include("Pages partielles/Header.php");
    $_SESSION['Previous'] = "../Accueil.php"; 
    ?>
    <script type="text/javascript">
var id_page = "nav<?php echo $page_title ?>";
document.getElementById(id_page).classList.add("active_tab");
</script>

    <div class="accueil-intro">
        <div class="container">  
            <p class="accueil-titre">Sarcelle Glasses</p>
            <p class="accueil-soustitre">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <hr>
            <ul class="accueil-nous">
                <li>
                    <a href="#NotreVision">
                        <center><i class="fa fa-eye fa-6x" aria-hidden="true"></i></center>
                        <hr>
                        <p class="title">Notre vision</p>
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
                <li>
                    <a href="#NotreVision">
                        <center><i class="fa fa-book fa-6x" aria-hidden="true"></i></center>
                        <hr>
                        <p class="title">Notre histoire</p>
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
                <li>
                    <a href="#NotreVision">
                        <center><i class="fa fa-gamepad fa-6x" aria-hidden="true"></i></center>
                        <hr>
                        <p class="title">Notre passion</p>
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="accueil-blog">
        <div class="container">
            <ul class="accueil-nous">
                <li class="fade">
                    <a href="#NotreVision">
                        <img class="accueil-image" src="Ressources/img1.jpg" alt="">
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
                <li class="fade">
                    <a href="#NotreVision">
                        <img class="accueil-image" src="Ressources/img2.jpg" alt="">
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
                <li class="fade">
                    <a href="#NotreVision">
                        <img class="accueil-image" src="Ressources/img3.jpg" alt="">
                        <p class="subtitle">Lorem ipsum</p>
                        <p class="content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat dolor eu molestie lobortis. Nullam interdum, urna
                            sit amet pulvinar scelerisque, metus mi pellentesque libero, nec dignissim elit augue sit amet
                            velit. Sed accumsan est at nisi aliquet, ut fringilla mi viverra. Donec ultrices commodo tempus.
                            Mauris pretium tristique est eu sollicitudin. Vestibulum mollis auctor tristique. Fusce vel ligula
                            est. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="accueil-store">
        <div class="container">
            <p class="accueil-soustitre">Venez visitez notre magasin en ligne</p>
            <div class="slideshow-container">

                <div class="mySlides fade">
                    <img src="Ressources/img1.jpg" style="width:100%">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <img src="Ressources/img2.jpg" style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <img src="Ressources/img3.jpg" style="width:100%">
                    <div class="text">Caption Three</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
            <script>
                    start();
                </script>
        </div>
    </div>
  <?php     
    include("Pages partielles/footer.php"); 
    ?>
  