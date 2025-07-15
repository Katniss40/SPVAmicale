<div class="hero-scene text-center text-white">
        <div class="hero-scene-content">
                <h1 class="hero-scene-text">Calendriers des Gardes et Formations SPV</h1>
                <div><a href="/admin" class="btn btn-primary" data-show="admin">Retour au Tableau de bord</a></div>
        </div>
</div>
<br>
<br>
<br>
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
<section>
<nav class="navbar navbar-expand-lg bg-primary " data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin" data-show="admin">Tableau de bord Administrateur</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/spv"data-show="admin">Liste des membres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/calendrier" data-show="admin">Gérer le calendrier</a>
                </li>
               
            </ul>
        </div>
    </div>
</nav>


<h1 align="center">Formations a venir</h1>
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

    <!-- Here we are using attributes like
        cellspacing and cellpadding -->
  
    <!-- The purpose of the cellpadding is 
        the space that a user want between
        the border of cell and its contents-->
  
    <!-- cellspacing is used to specify the 
        space between the cell and its contents -->
        <h2 align="center" style="color: orange;">
        Garde SPV Du mois en cours
    </h2>
    <br />
      
    <table bgcolor="lightgrey" align="center" 
        cellspacing="21" cellpadding="21">
          
        <!-- The tr tag is used to enter 
            rows in the table -->
  
        <!-- It is used to give the heading to the
            table. We can give the heading to the 
            top and bottom of the table -->
  
        <caption align="top">
            <!-- Here we have used the attribute 
                that is style and we have colored 
                the sentence to make it better 
                depending on the web page-->
        </caption>
  
        <!-- Here th stands for the heading of the
            table that comes in the first row-->
  
        <!-- The text in this table header tag will 
            appear as bold and is center aligned-->
  
        <thead>
            <tr>
                <!-- Here we have applied inline style 
                     to make it more attractive-->
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>sat</th>
            </tr>
        </thead>
          
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td>2</td>
            </tr>
            <tr></tr>
            <tr>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
            </tr>
            <tr>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
            </tr>
            <tr>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
            </tr>
            <tr>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
                <td>28</td>
                <td>29</td>
                <td>30</td>
            </tr>
            <tr>
                <td>31</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </tr>
        </tbody>
    </table>
</section>

<section>
<div class="calendar">
    <div class="month">
      <button id="prev">◀</button>
      <h2 id="month-year"></h2>
      <button id="next">▶</button>
    </div>
    <div class="weekdays">
      <div>Dim</div>
      <div>Lun</div>
      <div>Mar</div>
      <div>Mer</div>
      <div>Jeu</div>
      <div>Ven</div>
      <div>Sam</div>
    </div>
    <div class="days" id="days"></div>
  </div>

  <div id="event-modal" class="modal hidden">
    <div class="modal-content">
      <h3>Ajouter un événement</h3>
      <input type="text" id="event-input" placeholder="Nom de l'événement">
      <button id="save-event">Enregistrer</button>
      <button id="close-modal">Annuler</button>
    </div>
  </div>


</section>
   <!-- <div class="container-md">
        <br>   
            <div class="full-page">
                <h2 class="text-center">Liste des réservations</h2>
            </div>
        
            <div class="ratio ratio-4x3 full-page">
                <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR2te9l6QycpYyrlB4LIm_KPOmBnbYOVAY85FovGNIK7lPGlVvidho34BSzkGYD8WdzLotFS8Qm9bLU/pubhtml?gid=312686297&amp;single=true&amp;widget=true&amp;headers=false"></iframe>    
            </div>
        <br>
    </div>-->




    <style>

        .calendar {
  width: 350px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  overflow: hidden;
}

.month {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
  background: #007bff;
  color: #fff;
}

.weekdays, .days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  text-align: center;
}

.weekdays div {
  font-weight: bold;
  padding: 10px 0;
  background: #f0f0f0;
}

.days div {
  padding: 15px;
  cursor: pointer;
  transition: background 0.3s;
}

.days div:hover {
  background: #007bff;
  color: #fff;
}

.days .event {
  background: #ffcc00;
  border-radius: 50%;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal.hidden {
  display: none;
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 10px;
  text-align: center;
}

</style>



<script>
    // page calendrier mise en place du calendrier modifiable

const daysContainer = document.getElementById("days");
const monthYear = document.getElementById("month-year");
const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");
const eventModal = document.getElementById("event-modal");
const eventInput = document.getElementById("event-input");
const saveEventButton = document.getElementById("save-event");
const closeModalButton = document.getElementById("close-modal");

let currentDate = new Date();
let events = {};

function renderCalendar() {
  const year = currentDate.getFullYear();
  const month = currentDate.getMonth();
  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  monthYear.textContent = currentDate.toLocaleDateString("fr-FR", {
    month: "long",
    year: "numeric",
  });

  daysContainer.innerHTML = "";

  for (let i = 0; i <script firstDay; i++) {
    daysContainer.innerHTML += `<div></div>`;
  }
}

</script>