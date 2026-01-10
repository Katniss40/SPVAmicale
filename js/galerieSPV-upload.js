function initGalleryUpload() {
    
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const form = document.getElementById('formAjouterPhoto');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const btnClearImage = document.getElementById('btnClearImage');
    const commentaire = document.getElementById('commentaire');
    const charCount = document.getElementById('charCount');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');

    if (!fileInput || !form) {
        return;
    }

    const MAX_FILE_SIZE = 10 * 1024 * 1024;
    const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'image/webp'];

    function handleFileSelect(file) {
        
        if (!ALLOWED_TYPES.includes(file.type)) {
            alert('❌ Format non accepté. PNG, JPG ou WEBP seulement.');
            return;
        }
        if (file.size > MAX_FILE_SIZE) {
            alert('❌ Fichier trop volumineux (max 10 Mo).');
            return;
        }

        // Assigner le fichier à l'input file avec DataTransfer
        try {
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
        } catch(e) {
            // Erreur silencieuse
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            fileName.textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' Mo)';
            previewContainer.style.display = 'block';
            dropZone.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }

    // FILE INPUT CHANGE
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            handleFileSelect(this.files[0]);
        }
    });

    // DRAG & DROP
    // Empêcher le comportement par défaut du navigateur
    ['dragenter', 'dragover', 'drop'].forEach(eventName => {
        document.addEventListener(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    // Ajouter visuellement au survol
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
            dropZone.style.borderColor = '#45a049';
            dropZone.style.background = '#e8f5e9';
        });
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.style.borderColor = '#2E7D32';
        dropZone.style.background = '#f0f7f0';
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        e.stopPropagation();
        dropZone.style.borderColor = '#2E7D32';
        dropZone.style.background = '#f0f7f0';
        if (e.dataTransfer.files && e.dataTransfer.files[0]) {
            handleFileSelect(e.dataTransfer.files[0]);
        }
    });

    // CLEAR IMAGE
    btnClearImage.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.value = '';
        previewContainer.style.display = 'none';
        dropZone.style.display = 'flex';
    });

    // CHARACTER COUNTER
    commentaire.addEventListener('input', function() {
        charCount.textContent = this.value.length + ' / 500';
        if (this.value.length > 500) {
            this.value = this.value.substring(0, 500);
        }
    });

    // FORM SUBMIT
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!fileInput.files || !fileInput.files[0]) {
            alert('⚠️ Sélectionnez une image.');
            return;
        }

        const formData = new FormData(this);
        progressContainer.style.display = 'block';

        const xhr = new XMLHttpRequest();
        
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const pct = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = pct + '%';
                progressText.textContent = pct + '% - Upload...';
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                progressText.textContent = '✅ Succès!';
                setTimeout(() => {
                    window.location.href = '/GalerieSPV';
                }, 1000);
            } else {
                progressText.textContent = '❌ Erreur: ' + xhr.status;
                progressBar.style.background = '#c41d1d';
            }
        });

        xhr.addEventListener('error', function() {
            progressText.textContent = '❌ Erreur réseau';
            progressBar.style.background = '#c41d1d';
        });

        xhr.open('POST', '/pages/galerie/ajouter_photo.php');
        xhr.send(formData);
    });
}

// Appel du script quand la page se charge
initGalleryUpload();
