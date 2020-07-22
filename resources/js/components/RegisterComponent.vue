<template>
    <div class="card bg-light mt-7">
        <article class="card-body mx-auto min-vh-100" style="max-width: 500px;">
                <h4 class="card-title mt-3 text-center">Create Account</h4>
	<p class="text-center">Get started with your free account</p>
            <form @submit.prevent="register">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                 </div>
                <input v-model="user.name"  class="form-control" placeholder="Full name" type="text" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                 </div>
                <input v-model="user.email" class="form-control" placeholder="Email address" type="email" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                </div>
                <select class="custom-select" style="max-width: 120px;">
                    <option selected="">+971</option>
                </select>
                <input v-model="user.phone" class="form-control" placeholder="Phone number" type="text" required>
            </div> <!-- form-group// -->

            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input v-model="user.password" class="form-control" placeholder="Create password" type="password" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input v-model="user.cpassword" class="form-control" placeholder="Repeat password" type="password" required>
            </div> <!-- form-group// -->
             <div v-if='this.user.password != this.user.cpassword' class="alert alert-danger" role="alert">
             <strong>password should match</strong>
         </div>
            <div class="form-group">
                <button type='submit' class="btn btn-primary btn-block"> Create Account  </button>

            </div> <!-- form-group// -->

            <p class="text-center">Have an account? <a href="">Log In</a> </p>
        </form>

        </article>
        </div> <!-- card.// -->
</template>

<script>
    export default {
         data: function () {
    return {
      user: {
          name: '',
      email:'',
      phone: '',
      password: '',
      cpassword: '',
      },
    }
  },
  methods: {
      register: function(event)
            {
                if(this.user.password !== this.user.cpassword){
                    swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Your password does not match with the confirm password',
                    showConfirmButton: false,
                    timer: 1500
                    });
                    return false;
            }


                if (event) {
                    event.preventDefault()
                }
                const requestOptions = {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(this.user)
                };
                fetch("api/register", requestOptions)
                .then(response => response.json())
                .then(data => {
                if(data.status)
                {
                    console.log(data.status);
                    swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: data.message,
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                    window.location = '/login';
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
