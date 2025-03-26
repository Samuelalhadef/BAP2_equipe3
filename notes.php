<form action="PHP_Pesee_Insertion_Pesee.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_pesee_add']; ?>">
    
    <div class="pesee_RestesRepas">
        <div class="pesee_item">
            <div class="pesee_restes">
                <p>Pesée des restes jetés</p>
                <input type="number" name="pesee_restes" required>
            </div>
            <div class="pesee_restes">
                <p>Pesée du pain jeté</p>
                <input type="number" name="pesee_pain" required>
            </div>
        </div>

        <div class="pesee_repas">
            <p>Nombre de repas prévus</p>
            <input type="number" name="nb_repasprevus" required>
            
            <p>Nombre de repas consommés</p>
            <input type="number" name="nb_repasconsommes" required>
            
            <p>Repas consommés par les adultes</p>
            <input type="number" name="nb_repasconsommesadultes" required>
        </div>
    </div>

    <div class="valeurs">
        <button type="submit">Ajouter la pesée</button>
    </div>
</form>