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
<li><a href="{{url('/transaction') }}">Home</a></li>
<li><a href="#news">News</a></li>
<li class="dropdown">
<a href="#" class="dropbtn">Dropdown</a>
<div class="dropdown-content">
<a href="#">Link 1</a>
<a href="#">Link 2</a>
<a href="#">Link 3</a>
</div>
</li>
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
      <th scope="col">Qty</th>
      <th scope="col">Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody v-for='item in transaction'>
    <tr>
      <td>@{{item.product}}</td>
      <td>@{{item.description}}</td>
      
      <td><a href="#" @click="editData(item)" class="btn btn-primary btn-sm pull-right">Edit</a><a href="#" @click="editData(item)" class="btn btn-danger btn-sm pull-right">Delete</a></td>
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
         <div class="form-group">
                  <label>Product</label>
                  <input type="text" name="id" v-model="id" :value="id">
                  <input type="text" name="product" v-model="product" :value="product" min="0" maxlength="15" size="15" class="form-control" placeholder="Input Nomor Telepon">
                </div>
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea type="text" name="description" v-model="description" id="description" class="form-control" placeholder="Input Deskripsi" rows="4"></textarea>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" @click="submitForm" class="btn btn-primary">Save changes</button>
      </div>
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
  <script src="https://unpkg.com/vue/dist/vue.js"></script>
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
      this.actionUrl = '{{ url('transaction_create') }}';
      $('#createModal').modal('show')
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
   $('#createModal').modal('show')
    },
    // deleteData() {

    // },
    
    submitForm(){
      debugger
        // if (this.number_phone.length > 15) {
        //     toastr.error("Anda Terlalu Banyak Memasukan Nomor Telepon ")
        //     return
        //  }
        // if (this.number_phone == undefined || this.number_phone == "") {
        //   toastr.error("Nomor Telepon Harus Diisi!");
        //   return
        // }
        if (this.description == undefined || this.alamat == "") {
          toastr.error("Deskripsi Harus Diisi!"); 
          return
        }
        // if (this.jam == undefined || this.jam == "") {
        //   toastr.error("Jam Harus Diisi!");
        //   return
        // }
        // if (this.pegawai == undefined || this.pegawai == "") {
        //   toastr.error("Pegawai Harus Diisi!");
        //   return 
        // }

        var data = {
          "id": this.id,
          "product": this.product,
          "address": this.alamat,
          "jam": this.jam,
          "pegawai": this.pegawai,
          "price": this.price
        }
        this.actionUrl = '{{ url('create_transaction') }}'
        axios.post(this.actionUrl,data).then(response => {
          debugger
          
            $('#createModal').modal('hide');
            // $('#notification').modal('show');
             
           this.actionUrl = '{{ url('transaction') }}'
       axios.get(this.actionUrl).then(res => {
        debugger
      this.transaction = res.data
    });
          

        }).catch(function (error) {
       toastr.error(error);
      });

    },
    // notifications(){
    //   debugger
      // this.actionUrl = '{{ url('transaction') }}'
      // axios.get(this.actionUrl).then(res => {
      //            // window.parent.location.reload();
      //           debugger
                
      //           this.notification = res.data[0]
      //           this.notif_count = res.data[0].count
      //           if (this.notification.count > 0 && this.notification.response == 1) {
      //             $('#notification').modal('show');
      //           }
                
      //       });
    // }

  }
 });
</script>