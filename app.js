var app = new Vue({
el : '#vueapp',
data :{
   notes :[],  // le jeu d'enregistrements au format json stocké dans un tableau 
   errors : [], // errors on createNote 
   showTable :false,// boolean show table notes
   showForm : false,// boolean show form notes
   // variable d'état du formulaire de saisie
   label: '',
   commentaire: '',
   code: '',
   showOrder: 1,
   blocknote_id : 0,


},
mounted : function(){
    console.log('mounted');
    this.getNotes();
},

methods :{


// Ajax call
getNotes : function(){
    axios.get('api/notes.php')
    .then(function (response) {
        //console.log(response.data);
        app.notes = response.data;

    })
    .catch(function (error) {
        console.log(error);
    });
 },

 showData : function(){
   
    this.showTable = !this.showTable;
    this.showForm = false;
 },


 showNoteForm: function(){
 
  this.showForm = !this.showForm;
  this.showTable = false;
 },

 createNote: function(){
   // console.log("Create Note!")

    let formData = new FormData();
   
    formData.append('label', this.label)
    formData.append('commentaire', this.commentaire)
    formData.append('code', this.code)
    formData.append('showorder', this.showOrder)
    formData.append('blocknote', this.blocknote_id)
    formData.append('action', 'createNote')
    var note = {};
    formData.forEach(function(value, key){
        note[key] = value;
    });
    //console.log(note);


    //ajax call
    axios({
        method: 'post',
        url: 'api/notes.php',
        data: formData,
        config: { headers: {'Content-Type': 'multipart/form-data' }}
    })
    .then(function (response) {
       // console.log(response)
        if (response.data.success){
              console.log('no error in form proceed to save')  
        }else{
             this.errors  = response.data.errors ;    
             console.log(this.errors)  
        }
        //handle success
        
      
        //app.notes.push(note)
        app.resetForm();
    })
    .catch(function (response) {
        //handle error
        console.log(response)
    });
},

updateNote:function(id){
   
  console.log('CLICKED UPDATE! ' + id);
  
  // load data from this id

  // feed the form update

    


},
deleteNote:function(id){
   
    console.log('CLICKED DELETE! ' + id);
    
    // load data from this id
    axios({
        method: 'GET',
        url: 'api/notes.php?action=delete&id =' +id,
    })

    .then (function (response){})
    .catch(function (response) {    console.log(response)}
    
    );
    
    
      
  
  
  },

//like it says ...
resetForm: function(){
    this.showForm = false;
    this.showTable = true;
    this.label = '';
    this.commentaire = '';
    this.code = '';
    this.showOrder = 1;
    this.blocknote = 1;
}
 





}, //methods

});