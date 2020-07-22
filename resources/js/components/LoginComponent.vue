<template>
    <div class="card bg-light mt-7">

        <article class="card-body mx-auto min-vh-100" style="max-width: 500px;">
                <h4 class="card-title mt-3 text-center">Login</h4>
	<p class="text-center">Login to explore your account</p>
            <form @submit.prevent="login">
           <!-- <div v-if='alertMessage != null' class="alert alert-primary" role="alert">
             <strong>{{alertMessage}}</strong>
         </div> -->

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                 </div>
                <input v-model="user.email" class="form-control" placeholder="Email address" type="email" required>
            </div> <!-- form-group// -->

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input v-model="user.password" class="form-control" placeholder="Enter password" type="password" required>
            </div> <!-- form-group// -->

            <div class="form-group">
                <button type='submit' class="btn btn-primary btn-block"> Login  </button>

            </div> <!-- form-group// -->

            <p class="text-center">Do not Have an account? <a href="/register">Sign up</a> </p>
        </form>

        </article>
        </div> <!-- card.// -->

</template>


<script>
export default {
    data() {
        return {
            user: {
                email: '',
                password: '',
            }
        }
    },
    mounted() {


    },
    methods: {
        login : function()
        {
            const requestOptions = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(this.user)
                };

                fetch("api/login", requestOptions)
                .then(response => response.json())
                .then(data => {
                if(data.status)
                {
                  Vue.$cookies.set('token',data.data.token);

                    swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        window.location = '/';
                         });


            }
            else
            {
               swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                    });
            }
        });
        }
    },
}
</script>
