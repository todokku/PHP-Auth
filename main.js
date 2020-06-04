"use strict";
/**************************
          HEADER
**************************/
let loginBtn = function() {
  // show login modal
  document.querySelector("#login-modal").style.display = "block";
  // if user click outside form
  window.onclick = function(e) {
    if (e.target == document.querySelector('#login-modal')) {
      // hide login form
      document.querySelector('#login-modal').style.display = "none";
    }
  }
};

let settingsBtn = function() {
  // show settings modal
  document.querySelector("#settings-modal").style.display = "block";

  window.onclick = function(e) {
    if (e.target == document.querySelector('#settings-modal')) {
      document.querySelector('#settings-modal').style.display = "none";
    }
  }

  /**************************
            SETTINGS
  **************************/
  //change password
  document.querySelector('.sett-form-submit').addEventListener("click", function(e) {
    e.preventDefault();

    let error = 0;
    let msg = '<ul>';
    let form = {
      form: document.querySelector('#change-password-form'),
      old: document.querySelector('.sett-form-oldPwd'),
      pwd: document.querySelector('.sett-form-newPwd'),
      rePwd: document.querySelector('.sett-form-reNewPwd'),
      msgBox: document.querySelector('.msg-box')
    };

    //VALIDATE OLD PASSWORD
    if (form.old.value == null || form.old.value == '') {
      msg += '<li>Old Password is required</li>';
      form.old.classList.add("input-error");
      error += 1;

    } else {
      form.old.classList.remove("input-error");
    }

    // VALIDATE NEW PASSWORD
    if (form.pwd.value == null || form.pwd.value == '') {
      msg += '<li>Password is required</li>';
      form.pwd.classList.add("input-error");
      error += 1;

    } else if (form.pwd.value.length < 5 || form.pwd.value.length > 25) {
      msg += '<li> invalid password length</li>';
      form.pwd.classList.add("input-error");
      error += 1;

    } else {
      form.pwd.classList.remove("input-error");
    }

    // VALIDATE REPASSWORD
    if (form.rePwd.value == null || form.rePwd.value == '') {
      msg += '<li>Confirm Password is required</li>';
      form.rePwd.classList.add("input-error");
      error += 1;

    } else if (form.pwd.value !== form.rePwd.value) {
      msg += '<li>Password and Confirm Password did`nt match</li>';
      form.pwd.classList.add("input-error");
      form.rePwd.classList.add("input-error");
      error += 1;

    } else {
      form.pwd.classList.remove("input-error");
      form.rePwd.classList.remove("input-error");
    }

    if (error > 0) {
      form.msgBox.classList.add("alert", "alert-danger");
    }

    if (error === 0) {
      form.form.submit();
    }

    msg += '</ul>';
    form.msgBox.innerHTML = msg;

  });

  //delete account
  document.querySelector('.del-form-submit').addEventListener("click", function(e) {
    e.preventDefault();
    let delUser = confirm('Are you sure you want to delete your account?');
    if (delUser) {
      document.querySelector('#delete-form').submit();
    }
  });

};

/**************************
          REGISTER
**************************/
document.querySelector('.reg-form-submit').addEventListener("click", function(e) {
  e.preventDefault();

  let error = 0;
  let msg = '<ul>';
  let form = {
    form: document.querySelector('#register-form'),
    csrf: document.querySelector('.csrf'),
    name: document.querySelector('.reg-form-userName'),
    email: document.querySelector('.reg-form-email'),
    pwd: document.querySelector('.reg-form-pwd'),
    rePwd: document.querySelector('.reg-form-rePwd'),
    type: document.querySelector('.reg-submit-type'),
    msgBox: document.querySelector('.msg-box')
  };

  // VALIDATE USERNAME
  if (form.name.value == null || form.name.value == '') {
    msg += '<li>Username is required</li>';
    form.name.classList.add("input-error");
    error += 1;

  } else if (form.name.value.length < 5 || form.name.value.length > 15) {
    msg += '<li> invalid username length</li>';
    form.name.classList.add("input-error");
    error += 1;

  } else if (!form.name.value.match(/^[a-zA-Z0-9]+$/)) {
    msg += '<li> invalid username</li>';
    form.name.classList.add("input-error");
    error += 1;

  } else {
    form.name.classList.remove("input-error");
  }

  // VALIDATE EMAIL
  if (form.email.value == null || form.email.value == '') {
    msg += '<li>Email is required</li>';
    form.email.classList.add("input-error");
    error += 1;

  } else if (!form.email.value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
    msg += '<li> invalid email</li>';
    form.email.classList.add("input-error");
    error += 1;

  } else {
    form.email.classList.remove("input-error");
  }

  // VALIDATE PASSWORD
  if (form.pwd.value == null || form.pwd.value == '') {
    msg += '<li>Password is required</li>';
    form.pwd.classList.add("input-error");
    error += 1;

  } else if (form.pwd.value.length < 5 || form.pwd.value.length > 25) {
    msg += '<li> invalid password length</li>';
    form.pwd.classList.add("input-error");
    error += 1;

  } else {
    form.pwd.classList.remove("input-error");
  }

  // VALIDATE REPASSWORD
  if (form.rePwd.value == null || form.rePwd.value == '') {
    msg += '<li>Confirm Password is required</li>';
    form.rePwd.classList.add("input-error");
    error += 1;

  } else if (form.pwd.value !== form.rePwd.value) {
    msg += '<li>Password and Confirm Password did`nt match</li>';
    form.pwd.classList.add("input-error");
    form.rePwd.classList.add("input-error");
    error += 1;

  } else {
    form.pwd.classList.remove("input-error");
    form.rePwd.classList.remove("input-error");
  }

  if (error > 0) {
    document.querySelector('.msg-box').classList.add("alert", "alert-danger");
  }

  if (error === 0) {
    form.form.submit();
  }

  msg += '</ul>';
  form.msgBox.innerHTML = msg;
});




// let xhttp = new XMLHttpRequest();
// let data = "string";
//
// xhttp.onreadystatechange = function() {
//   if (this.readyState == 4 && this.status == 200) {
//     console.log(this.responseText);
//   }
// };
//
// xhttp.open("POST", "route/account.route.php", true);
// xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// xhttp.send(data);
