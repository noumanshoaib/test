
<template>

 <div class="row">

          <div v-for="(item, index) in products" :key="index" class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" :src="'images/'+item.image" alt=""></a>
              <div  class="card-body">
                <h4 class="card-title">
                  <a v-on:click="changeIndex(index)" data-toggle="modal" data-target="#exampleModalLong" href="#">{{item.name}}</a>
                </h4>
                <h5>AED {{item.price}}</h5>
                <p class="card-text">{{item.description}}</p>
              </div>
              <div class="card-footer">
<button v-on:click='orderIt(item.id)' type="button" class="btn btn-primary">Order</button>
              </div>
            </div>
          </div>



<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


<div class="">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" :src="'images/'+modelProduct[displayIndex].image" alt=""></a>
              <div  class="card-body">
                <h4 class="card-title">
                  <a  href="#">{{modelProduct[displayIndex].name}}</a>
                </h4>
                <h5>AED {{modelProduct[displayIndex].price}}</h5>
                <p class="card-text">{{modelProduct[displayIndex].description}}</p>
              </div>

            </div>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>




        </div>
        <!-- /.row -->


</template>

<script>
export default {
    data() {
        return {
           products: [
           ],
           modelProduct: [
                { id: '',
                name: '',
                image: '',
                description: '',
                },
           ],
           displayIndex: 0,
        }
    },

    mounted() {
const requestOptions = {
                    method: "GET",
                };

                fetch("api/product", requestOptions)
                .then(response => response.json())
                .then(data => {
                    this.products = data.data;
                    this.modelProduct = data.data;

                });
    },
    methods: {
        changeIndex(value)
        {
          this.displayIndex = value;
        },
        orderIt(value)
        {
            this.index = value;
            if(Vue.$cookies.isKey('token'))
        {

            swal.fire({
  title: 'Enter Your address',
  input: 'text',
  inputAttributes: {
    autocapitalize: 'off'
  },
  showCancelButton: true,
  confirmButtonText: 'Submit',
  showLoaderOnConfirm: true,
  preConfirm: (address1,value) => {
     const requestOptions = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        product_id: this.index,
                        token: Vue.$cookies.get('token'),
                        address: address1,


                    })
                };


                fetch("api/order", requestOptions)
                .then(response => response.json())
                .then(data => {
                if(data.status)
                {
                    swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                    });


            }
        });
  },
  allowOutsideClick: () => !swal.isLoading()
});


        }
        else
        {
            swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'You need to login before order',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        window.location = '/login';
                         });
        }

        }
    },
}
</script>
