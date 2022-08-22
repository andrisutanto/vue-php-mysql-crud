var application = new Vue({
    el:'#crudApp',
    data:{
     allData:'',
     myModel:false,
     actionButton:'Insert',
     dynamicTitle:'Add Data',
    },
    methods:{
     fetchAllData:function(){
      axios.post('action.php', {
       action:'fetchall'
      }).then(function(response){
       application.allData = response.data;
      });
     },
     openModel:function(){
      application.model = '';
      application.brand = '';
      application.price = '';
     
      application.actionButton = "Insert";
      application.dynamicTitle = "Add Data";
      application.myModel = true;
     },
     submitData:function(){
      if(application.model != '' && application.brand != '' && application.price != '')
      {
       if(application.actionButton == 'Insert')
       {
        axios.post('action.php', {
         action:'insert',
         model:application.model, 
         brand:application.brand,
         price:application.price
        
        
        }).then(function(response){
         application.myModel = false;
         application.fetchAllData();
         application.model = '';
         application.brand = '';
         application.price = '';
         alert(response.data.message);
        });
       }
       if(application.actionButton == 'Update')
       {
        axios.post('action.php', {
         action:'update',
         model : application.model,
         brand : application.brand,
         price : application.price,
         hiddenId : application.hiddenId
        }).then(function(response){
         application.myModel = false;
         application.fetchAllData();
         application.model = '';
         application.brand = '';
         application.price = '';
         
        
         application.hiddenId = '';
         alert(response.data.message);
        });
       }
      }
      else
      {
       alert("Isi semua field!");
      }
     },
     fetchData:function(id){
      axios.post('action.php', {
       action:'fetchSingle',
       id:id
      }).then(function(response){
       application.model = response.data.model;
       application.brand = response.data.brand;
       application.price = response.data.price;
       application.hiddenId = response.data.id;
       application.myModel = true;
       application.actionButton = 'Update';
       application.dynamicTitle = 'Edit Data';
      });
     },
     deleteData:function(id){
      if(confirm("Anda yakin menghapus data ini?"))
      {
       axios.post('action.php', {
        action:'delete',
        id:id
       }).then(function(response){
        application.fetchAllData();
        alert(response.data.message);
       });
      }
     }
    },
    created:function(){
     this.fetchAllData();
    }
   });