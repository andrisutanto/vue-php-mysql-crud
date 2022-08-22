<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Vue JS CRUD with PHP</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <link  rel="stylesheet" href="style.css">
  
 </head>
 <body>
  <div class="container" id="crudApp">
   <br />
   <h3 align="center">Vue JS CRUD with PHP</h3>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-6">
       <h3 class="panel-title">PHONE DATA</h3>
      </div>
      <div class="col-md-6" align="right">
       <input type="button" class="btn btn-success btn-xs" @click="openModel" value="Add" />
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Model</th>
        <th>Brand</th>
        <th>Price</th>     
        <th>Edit</th>
        <th>Delete</th>
       </tr>
       <tr v-for="row in allData">
        <td>{{ row.model }}</td>
        <td>{{ row.brand }}</td>
        <td>{{ row.price }}</td>
        <td><button type="button" name="edit" class="btn btn-primary btn-xs edit" @click="fetchData(row.id)">Edit</button></td>
        <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" @click="deleteData(row.id)">Delete</button></td>
       </tr>
      </table>
     </div>
    </div>
   </div>
   <div v-if="myModel">
    <transition name="model">
     <div class="modal-mask">
      <div class="modal-wrapper">
       <div class="modal-dialog">
        <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" @click="myModel=false"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">{{ dynamicTitle }}</h4>
         </div>
         <div class="modal-body">
          <div class="form-group">
           <label>Model</label>
           <input type="text" class="form-control" v-model="model" />
          </div>
          <div class="form-group">
           <label>Brand</label>
           <input type="text" class="form-control" v-model="brand" />
          </div>
           <div class="form-group">
           <label>Price</label>
           <input type="number" class="form-control" v-model="price" />
          </div>

          <br />
          <div align="center">
           <input type="hidden" v-model="hiddenId" />
           <input type="button" class="btn btn-success btn-xs" v-model="actionButton" @click="submitData" />
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </transition>
   </div>
  </div>
  <script src="apps.js"></script>
 </body>
</html>