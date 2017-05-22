  <?php 
    $page_title = "Produits";   
    
    include("../Pages Partielles/Header.php"); 
    ?>

    <div class="container">
        <h1 class="nom-produit">Poster de Lemongrab (divers)</h1>
        <hr>
        <div class="image-produits">
            <img class="image-principale" src="../Ressources/img1.jpg" alt="">
            <img class="image-secondaire" src="../Ressources/img2.jpg" alt="">
            <img class="image-secondaire" src="../Ressources/img3.jpg" alt="">
        </div>
        <div class="info-produits">
            <p class="retour"><a href="Magasin.htm">Sarcelle Glasses</a></p>
            <p class="prix">$39.99</p>
            <hr>
            <p class="Francois">Qte.</p>
            <div class="select-style">
                <select class="Qte" name="Qte" id="Qte">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            </div>
            <button class="acheter">Ajouter au panier</button>
            <p class="description">
                Bacon ipsum dolor amet strip steak pork drumstick, tongue sausage short ribs filet mignon bacon chuck boudin. Picanha spare
                ribs corned beef turkey ham salami tongue brisket. Shank capicola fatback ribeye flank chuck bacon frankfurter.
                Filet mignon ribeye alcatra pork belly chicken t-bone brisket. <br>
                <br> Pig drumstick pork cow. Chicken frankfurter beef ribs turkey, turducken doner sirloin bacon bresaola
                andouille landjaeger cupim tri-tip pig alcatra. Pork chop chicken pastrami, cupim prosciutto burgdoggen biltong
                turducken ball tip brisket jowl meatball pig shankle. <br>
                <br> Biltong corned beef picanha, bresaola filet mignon shoulder ground round doner prosciutto jerky. Jerky
                shankle prosciutto pork belly strip steak drumstick, ground round t-bone pork cow brisket.
            </p>
            <button class="tag">Poster</button>
            <button class="tag">Lemongrab</button>
            <button class="tag">Tag3</button>
            <button class="tag">Tag4</button>
        </div>
    </div>

    <hr>
    <div class="container">
        <div class="produits">
            <h2>Produits similaires</h2>
            <a class="produit-item" href="produit.htm">
                <img src="../Ressources/img1.jpg" alt="Produit1">
                <h3 class="titre-produit">Titre du produit</h3>
                <p class="produit-prix">$40,00</p>
                <button class="acheter">Ajouter au panier</button>
            </a>
            <a class="produit-item" href="produit.htm">
                <img src="../Ressources/img1.jpg" alt="Produit1">
                <h3 class="titre-produit">Titre du produit</h3>
                <p class="produit-prix">$40,00</p>
                <button class="acheter">Ajouter au panier</button>
            </a>
            <a class="produit-item" href="produit.htm">
                <img src="../Ressources/img1.jpg" alt="Produit1">
                <h3 class="titre-produit">Titre du produit</h3>
                <p class="produit-prix">$40,00</p>
                <button class="acheter">Ajouter au panier</button>
            </a>
            <a class="produit-item" href="produit.htm">
                <img src="../Ressources/img1.jpg" alt="Produit1">
                <h3 class="titre-produit">Titre du produit</h3>
                <p class="produit-prix">$40,00</p>
                <button class="acheter">Ajouter au panier</button>
            </a>
        </div>
    </div>

<?php include("../Pages Partielles/Footer.php"); ?>