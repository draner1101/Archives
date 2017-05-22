 <div class="footer_wrapper" > 
 
<script>
    //Fixe la position du footer si la page est plus petite que la hauteur de l'écran sinon c'est laid un footer en milieu de page.
    //ex: panier vide 
    //Le script est placé ici pour que ce calcul s'effectue apres que le footer_wrapper soit créé, mais avant
    // que le footer lui même ne le soit. Sinon le footer flash au milieu de l'écran et se repositionne à chaque ouverture de page.
if ($(".Page").height()+150<$(window).height()){
        $(".footer_wrapper").addClass("fixed");
    }else{
        $(".footer_wrapper").removeClass("fixed");
    }   

</script>

  <nav class="footer">
        <footer>
            <div class="container">
                <a class="logoFooter"  href="<?php echo $relpath?>accueil.php">
                    <img src="<?php echo $relpath?>Ressources/LogoFooter.png" alt="">
                </a>
                <ul class="menuFooter">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#about">About</a></li>
                    <li class="iconeFooter"><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-twitter fa-2"></i></a></li>
                    <li class="iconeFooter"><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-youtube-play fa-2"></i></a></li>
                    <li class="iconeFooter"><a href="https://twitter.com/SarcelleGlasses"><i class="fa fa-facebook fa-2"></i></a></li>
                </ul>
            </div>
        </footer>
    </nav>        
</div>
</div> <!--Fin de Page -->
     <script>
$(document).ready(function(){
 $('.update-quantity-form').on('submit', function(){
 
    // Recherche de l'id et de la quantité qui sont à l'intérieur du form
    var id = $(this).find('.product-id').text();
    var quantity = $(this).find('.cart-quantity').val();
 
    // Appel d'ajustementPanier avec les paramètres à modifier
    window.location.href = "AjustementPanier.php?id=" + id + "&quantity=" + quantity;
    return false;
    });
});
</script>


</body>

</html>