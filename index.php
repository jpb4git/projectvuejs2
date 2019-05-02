

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="css/app.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">vueJs</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">test</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  
  <div class="pl-3 pr-3" >
     
<div id='vueapp'>
<div class="d-flex flex-row justify-content-around">
        <h1>notes</h1>
        <button @click="showData()">Visualiser</button>  
        <button @click="showNoteForm()">créer une Note</button> 
</div>
<!--toast error -->
<div class="col-sm-12" v-if="errors != ''">
    <div class="card"  aria-live="assertive" aria-atomic="true">
        <div class="card-header">
            <img src="" class="rounded mr-2" alt="">
            <strong class="mr-auto">Erreur Formulaire</strong>
            <small>création de note</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card-body">
            <ul>
                <li v-for="error in errors"> {{error.label}} </li>
            </ul>
        </div>
    </div>
 </div> 
<div class="row mt-5 mb-5" v-if="showForm">
     
  
 <div class="col-sm-12  p-5 m-2">
        <h1>Nouvelle Note</h1> 
        <form class="w-100 formAdd">
            <div class="form-group ">
                <label>label</label>
                <input type="text" class="w-100" name="label" v-model="label">    
            </div>
            <div class="form-group w-100">
                <label>commentaire</label>
                <input type="text" class="w-100"name="commentaire" v-model="commentaire">
            </div>
            <div class="form-group w-100">
                <label>Code</label>
                <input type="text" class="w-100" name="code" v-model="code">
            </div>
            <div class="form-group w-100">
                <label>ShowOrder</label>
                <input type="numeric" class="w-100" name="showOrder" v-model="showOrder">
            </div>
            <div class="form-group w-100">
                <label>blocknote</label>
                <input type="numeric" class="w-100" name="blocknote" v-model="blocknote_id">
            </div>
            <input type="button" class="btn btn-success w-100" @click="createNote()" value="Add">    
        </form>
    </div>
 </div>   

<table border='1' width='100%' class="mt-2 text-center table-dark" v-if="showTable">
    <thead class=".thead-dark">
    <tr>
    <th>id</th>
        <th>label</th>
        <th>commentaire</th>
        <th>code</th>
        <th>showOrder</th>
        <th>Blocknote</th>
      

    </tr>
</thead>

   <tr v-for='note in notes'>
   <td>{{ note.id }}</td>
     <td>{{ note.label }}</td>
     <td>{{ note.com }}</td>
     <td>{{ note.code }}</td>
     <td>{{ note.showOrder }}</td>
     <td>{{ note.blocknote_id }}</td>
     <td><a  href="" @click.prevent="updateNote(note.id)" ><i class="material-icons">edit</i></a> </td>
     <td><a  href="" @click.prevent="deleteNote(note.id)" ><i class="material-icons">delete</i></a> </td>

   </tr>

 </table>

</div>

  <footer>

  </footer>

  <!-- development version, includes helpful console warnings -->
  <script src="vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="app.js"></script>


</body>

</html>