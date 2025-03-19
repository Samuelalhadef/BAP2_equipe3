<script>
document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("semaines-container");
    const prevBtn = document.getElementById("prev-week");
    const nextBtn = document.getElementById("next-week");
    const indicator = document.getElementById("semaine-indicator");
    const calendarBtn = document.getElementById("open-calendar");
    const datePicker = document.getElementById("date-picker");
    const selectedDateText = document.getElementById("selected-date");
    const pageRange = document.getElementById("page-range");
    
    // Variables pour la pagination
    const totalSemaines = <?php echo $totalSemaines; ?>;
    const semainesParPage = <?php echo $semainesParPage; ?>;
    let pageActuelle = <?php echo $pageActuelle; ?>;
    let currentIndex = <?php echo ($semainesParPage - 1); ?>; // Indice de la semaine actuelle dans l\'affichage
    
    // Position initiale (semaine actuelle au centre)
    const initialTransform = -((pageActuelle - 1) * (100 / (totalSemaines / semainesParPage)));
    container.style.transform = `translateX(${initialTransform}%)`;
    
    // Mise à jour de l\'indicateur de semaine
    function updateIndicator() {
        const visibleSemaines = document.querySelectorAll(".semaine");
        if (visibleSemaines.length > 0) {
            // Trouver la semaine au centre de l\'affichage
            const centerIndex = Math.floor(currentIndex / semainesParPage) * semainesParPage + Math.floor(semainesParPage / 2);
            const centerSemaine = visibleSemaines[centerIndex];
            if (centerSemaine) {
                const semaine = centerSemaine.getAttribute("data-semaine");
                const annee = centerSemaine.getAttribute("data-annee");
                indicator.textContent = `Semaine ${semaine} - ${annee}`;
                
                // Mise à jour de la plage affichée
                const startWeek = (pageActuelle - 1) * semainesParPage + 1;
                const endWeek = Math.min(startWeek + semainesParPage - 1, totalSemaines);
                pageRange.textContent = `${startWeek}-${endWeek}`;
            }
        }
    }
    
    // Mise à jour des boutons de pagination actifs
    function updatePaginationButtons() {
        const pageButtons = document.querySelectorAll(".page-num");
        pageButtons.forEach(btn => {
            btn.classList.remove("active");
            if (parseInt(btn.getAttribute("data-page")) === pageActuelle) {
                btn.classList.add("active");
            }
        });
    }
    
    // Gestionnaire pour semaine précédente
    prevBtn.addEventListener("click", function() {
        if (currentIndex > 0) {
            currentIndex--;
            navigateToIndex(currentIndex);
            
            // Mise à jour de la page si nécessaire
            const newPage = Math.floor(currentIndex / semainesParPage) + 1;
            if (newPage !== pageActuelle) {
                pageActuelle = newPage;
                updatePaginationButtons();
            }
            
            // Réinitialise la sélection de date
            resetDateHighlight();
            selectedDateText.textContent = "";
        }
    });
    
    // Gestionnaire pour semaine suivante
    nextBtn.addEventListener("click", function() {
        if (currentIndex < totalSemaines - 1) {
            currentIndex++;
            navigateToIndex(currentIndex);
            
            // Mise à jour de la page si nécessaire
            const newPage = Math.floor(currentIndex / semainesParPage) + 1;
            if (newPage !== pageActuelle) {
                pageActuelle = newPage;
                updatePaginationButtons();
            }
            
            // Réinitialise la sélection de date
            resetDateHighlight();
            selectedDateText.textContent = "";
        }
    });
    
    // Fonction pour naviguer vers un index spécifique
    function navigateToIndex(index) {
        const percentPerSemaine = 100 / totalSemaines;
        const translateX = -(index * percentPerSemaine);
        container.style.transform = `translateX(${translateX}%)`;
        updateIndicator();
    }
    
    // Fonction pour naviguer vers une page spécifique
    function navigateToPage(page) {
        pageActuelle = page;
        const newIndex = (page - 1) * semainesParPage;
        currentIndex = newIndex;
        
        const translateX = -(newIndex * (100 / totalSemaines));
        container.style.transform = `translateX(${translateX}%)`;
        
        updatePaginationButtons();
        updateIndicator();
        resetDateHighlight();
        selectedDateText.textContent = "";
    }
    
    // Gestionnaires pour la pagination
    document.getElementById("first-page").addEventListener("click", function() {
        navigateToPage(1);
    });
    
    document.getElementById("last-page").addEventListener("click", function() {
        navigateToPage(Math.ceil(totalSemaines / semainesParPage));
    });
    
    document.getElementById("prev-page").addEventListener("click", function() {
        if (pageActuelle > 1) {
            navigateToPage(pageActuelle - 1);
        }
    });
    
    document.getElementById("next-page").addEventListener("click", function() {
        if (pageActuelle < Math.ceil(totalSemaines / semainesParPage)) {
            navigateToPage(pageActuelle + 1);
        }
    });
    
    // Gestionnaires pour les boutons de numéro de page
    document.querySelectorAll(".page-num").forEach(btn => {
        btn.addEventListener("click", function() {
            const page = parseInt(this.getAttribute("data-page"));
            navigateToPage(page);
        });
    });
    
    // Support pour les gestes de swipe sur mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    container.addEventListener("touchstart", function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, false);
    
    container.addEventListener("touchend", function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, false);
    
    function handleSwipe() {
        if (touchEndX < touchStartX - 50) { // Swipe gauche -> semaine suivante
            if (currentIndex < totalSemaines - 1) {
                currentIndex++;
                navigateToIndex(currentIndex);
                
                // Mise à jour de la page si nécessaire
                const newPage = Math.floor(currentIndex / semainesParPage) + 1;
                if (newPage !== pageActuelle) {
                    pageActuelle = newPage;
                    updatePaginationButtons();
                }
                
                resetDateHighlight();
                selectedDateText.textContent = "";
            }
        }
        if (touchEndX > touchStartX + 50) { // Swipe droite -> semaine précédente
            if (currentIndex > 0) {
                currentIndex--;
                navigateToIndex(currentIndex);
                
                // Mise à jour de la page si nécessaire
                const newPage = Math.floor(currentIndex / semainesParPage) + 1;
                if (newPage !== pageActuelle) {
                    pageActuelle = newPage;
                    updatePaginationButtons();
                }
                
                resetDateHighlight();
                selectedDateText.textContent = "";
            }
        }
    }
    
    // Fonctionnalité du calendrier
    calendarBtn.addEventListener("click", function() {
        datePicker.click();
    });
    
    datePicker.addEventListener("change", function() {
        const selectedDate = new Date(this.value);
        const formattedDate = formatDate(selectedDate);
        
        // Affiche la date sélectionnée
        selectedDateText.textContent = formattedDate;
        
        // Trouve la semaine correspondante
        const dayOfWeek = selectedDate.getDay(); // 0 = dimanche, 1 = lundi, etc.
        const year = selectedDate.getFullYear();
        
        // Calcule le numéro de la semaine
        const firstDayOfYear = new Date(year, 0, 1);
        const pastDaysOfYear = (selectedDate - firstDayOfYear) / 86400000;
        const weekNumber = Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
        
        // Trouve l\'index de la semaine dans notre container
        const weeks = document.querySelectorAll(".semaine");
        let targetIndex = -1;
        
        for (let i = 0; i < weeks.length; i++) {
            const weekAttr = parseInt(weeks[i].getAttribute("data-semaine"));
            const yearAttr = parseInt(weeks[i].getAttribute("data-annee"));
            
            if (weekAttr === weekNumber && yearAttr === year) {
                targetIndex = parseInt(weeks[i].getAttribute("data-index"));
                break;
            }
        }
        
        // Si la semaine est trouvée, on y navigue
        if (targetIndex !== -1) {
            currentIndex = targetIndex;
            navigateToIndex(currentIndex);
            
            // Mise à jour de la page
            const newPage = Math.floor(currentIndex / semainesParPage) + 1;
            if (newPage !== pageActuelle) {
                pageActuelle = newPage;
                updatePaginationButtons();
            }
            
            // Surligne le jour sélectionné
            highlightSelectedDay(this.value);
            
            // Scroll vers le jour sélectionné
            const selectedDayElement = document.querySelector(`.jour[data-date="${this.value}"]`);
            if (selectedDayElement) {
                selectedDayElement.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "center" });
            }
        } else {
            alert("La date sélectionnée n\'est pas dans la plage des semaines affichées.");
        }
    });
    
    function formatDate(date) {
        const options = { weekday: "long", day: "numeric", month: "long", year: "numeric" };
        return date.toLocaleDateString("fr-FR", options);
    }
    
    function resetDateHighlight() {
        const allDays = document.querySelectorAll(".jour");
        allDays.forEach(day => {
            day.classList.remove("highlighted");
        });
    }
    
    function highlightSelectedDay(dateStr) {
        resetDateHighlight();
        const selectedDayElement = document.querySelector(`.jour[data-date="${dateStr}"]`);
        if (selectedDayElement) {
            selectedDayElement.classList.add("highlighted");
        }
    }
    
    // Initialisation
    updateIndicator();
    
    // Trouver et mettre en surbrillance la semaine actuelle au chargement
    const todaySemaine = document.querySelector(".semaine.current-week");
    if (todaySemaine) {
        const indexAttr = parseInt(todaySemaine.getAttribute("data-index"));
        if (!isNaN(indexAttr)) {
            // Ajouter une légère temporisation pour assurer que la page est chargée
            setTimeout(() => {
                currentIndex = indexAttr;
                navigateToIndex(currentIndex);
                
                // Mise à jour de la page
                pageActuelle = Math.floor(currentIndex / semainesParPage) + 1;
                updatePaginationButtons();
            }, 100);
        }
    }
});
</script>