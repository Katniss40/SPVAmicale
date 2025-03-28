<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1>Galerie</h1>
        </div>
</div>

<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .editable {
            cursor: pointer;
        }
    </style>

<h1>Calendrier Modifiable</h1>
    <table id="calendar">
        <thead>
            <tr>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="editable">1</td>
                <td class="editable">2</td>
                <td class="editable">3</td>
                <td class="editable">4</td>
                <td class="editable">5</td>
                <td class="editable">6</td>
                <td class="editable">7</td>
            </tr>
            <!-- Ajoutez plus de lignes pour compléter le mois -->
        </tbody>
    </table>

    <script>
        document.querySelectorAll('.editable').forEach(cell => {
            cell.addEventListener('click', function() {
                let newValue = prompt('Entrez une nouvelle valeur:', this.textContent);
                if (newValue !== null) {
                    this.textContent = newValue;
                }
            });
        });
    </script>