<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<style>
ul {
list-style-type: none;
margin: 0;
padding: 0;
overflow: hidden;
background-color: #333;
}

li {
float: left;
}

li a, .dropbtn {
display: inline-block;
color: white;
text-align: center;
padding: 14px 16px;
text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
background-color: red;
}

li.dropdown {
display: inline-block;
}

.dropdown-content {
display: none;
position: absolute;
background-color: #f9f9f9;
min-width: 160px;
box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
z-index: 1;
}

.dropdown-content a {
color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
display: block;
}
</style>
<body>
  <div class="container" id="controller">
   <ul>
<li><a href="{{ url('home') }}">Home</a></li>
</ul>
<div class="col-md-12">
  <div class="card-header">
        <a href="#" @click="addData()" class="btn btn-primary btn-sm pull-right">Tambah Transaksi</a>
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-transaction">Tambah Transaksi</button> -->
      </div>

  <div class="car-body">
  <table class="table table-sm" >
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Product</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Harga Discount</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody v-for='item in transaction'>
    <tr>
      <td>@{{item.id}}</td>
      <td>@{{item.product}}</td>
      <td>@{{item.description}}</td>
      <td><img height="30" width="50" v-bind:src="item.image" alt=""></a></td>
      <td>@{{item.qty}}</td>
      <td>@{{item.price}}</td>
      <td>@{{item.discount}}</td>
      <td><a href="#" @click="editData(item)" class="btn btn-primary btn-sm pull-right">Edit</a><a href="#" @click="deleteData(item)" class="btn btn-danger btn-sm pull-right">Delete</a></td>
    </tr>
  </tbody>
</table>
</div>
</div>

 <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" autocomplete="off" enctype="multipart/form-data">
         <div class="form-group">
                  <label>Product</label>
                  <input type="text" name="id" v-model="id" :value="id" hidden>
                  <input type="text" name="product" v-model="product" :value="product" class="form-control" placeholder="Input Product">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea type="text" name="description" v-model="description" :value="description" id="description" class="form-control" placeholder="Input Deskripsi" rows="4"></textarea>
                </div>
                 <div class="form-group">
              <label>Price</label>
              <input type="number" name="price" :value="price" v-model="price" id="description" class="form-control" placeholder="Input Price" required="">
            </div>
              <div class="form-group">
              <label>Quantity</label>
              <input type="number" name="quantity" :value="quantity" v-model="quantity" id="description" class="form-control" placeholder="Input quantity" required="">
            </div>
             <div class="form-group">
              <label>Discount</label>
              <input type="number" name="discount" :value="discount" v-model="discount" id="discount" class="form-control" placeholder="Input quantity" required="">
            </div>
            <div class="form-group">
              <label>Image</label>
              <input type="file" name="file" :value="file" v-model="file" id="file" class="form-control" @change="uploadFile" required="">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" @click="submitForm" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

</div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
<script src="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.js"></script>
<link rel="stylesheet" href="https://unpkg.com/vue-toastr-2/dist/vue-toastr-2.min.css">
  <script>
debugger
  var actionUrl = '{{ url('tes') }}';
  var apiUrl = '{{ url('api/tes') }}';
 var controller = new Vue({
  el: '#controller',
  data: {
    data: {},
    actionUrl,
    apiUrl,
    
   
    
  },
  mounted: function () {
    this.addDatas();
    // this.notifications();
  },
   data() {
    return {
      
      transaction: [],
      product : {},
      id: {},
      
     
    };
  },
  methods: {
    addData() {
      debugger
      this.id = ''
      this.product = ''
      this.actionUrl = '{{ url('transaction_create') }}';
      $('#createModal').modal('show')
    },
    uploadFile(e){
                const image = e.target.files[0];
                const reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e =>{
                    this.file = e.target.result;
                   
                };
            },
    addDatas() {
      debugger
      this.actionUrl = '{{ url('transaction') }}'
       axios.get(this.actionUrl).then(res => {
        debugger
      this.transaction = res.data
    });
    },
    
    editData(item) {
      debugger
      this.id = item.id
    this.product = item.product
    this.description = item.description
    this.price = item.price
    this.quantity = item.qty
    this.discount = item.discount
    this.file = item.image
   $('#createModal').modal('show')
    },
    deleteData(item) {

      var data = {
        'id': item.id
      }
      this.actionUrl = '{{ url('delete_transaction') }}'
        axios.post(this.actionUrl,data).then(response => {
          debugger
             this.actionUrl = '{{ url('transaction') }}'
               axios.get(this.actionUrl).then(res => {
                debugger
              this.transaction = res.data
            });
            if (response.data.status == 201) {
            toastr.success('Berhasil!')
              return
            }else{
              toastr.error('Gagal!')
              return
            }
              
          

        }).catch(function (error) {
       toastr.error('Gagal!');
      });
    },
    
    submitForm(){
      debugger
        if (this.product == undefined || this.product == "") {
            toastr.error("Product Harus Diisi!")
            return
         }
        if (this.price == undefined || this.price == "") {
          toastr.error("Price Harus Diisi!");
          return
        }
        if (this.description == undefined || this.description == "") {
          toastr.error("Deskripsi Harus Diisi!"); 
          return
        }
        if (this.quantity == undefined || this.quantity == "") {
          toastr.error("Quantity Harus Diisi!");
          return
        }
        if (this.file == undefined || this.file == "") {
          toastr.error("Image Harus Diisi!"); 
          return
        }

        var data = {
          "id": this.id,
          "product": this.product,
          "description": this.description,
          "quantity": this.quantity,
          "discount": this.discount,
          "price": this.price,
          "file": this.file
        }
        this.actionUrl = '{{ url('create_transaction') }}'
        axios.post(this.actionUrl,data).then(response => {
          debugger
            $('#createModal').modal('hide');
               this.actionUrl = '{{ url('transaction') }}'
               axios.get(this.actionUrl).then(res => {
                debugger
              this.transaction = res.data
            });
            if (response.data.status == 201) {
            toastr.success('Berhasil!')
              return
            }else{
              toastr.error('Gagal!')
              return
            }
        }).catch(function (error) {
       toastr.error('Gagal!');
      });

    },
  }
 });
</script>