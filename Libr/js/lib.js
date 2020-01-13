// function to set a given theme/color-scheme
        function setTheme(themeName) {
            localStorage.setItem('theme', themeName);
            document.documentElement.className = themeName;
        }
        // function to toggle between light and dark theme
        function toggleTheme() {
            if (localStorage.getItem('theme') === 'theme-dark') {
                setTheme('theme-light');
            } else {
                setTheme('theme-dark');
            }
        }
        // Immediately invoked function to set the theme on initial load
        (function () {
            if (localStorage.getItem('theme') === 'theme-dark') {
                setTheme('theme-dark');
            } else {
                setTheme('theme-light');
            }
        })();














///////////////////////////////
function Borrow(bookId){
  var url = 'controller/testFunction.php?request_function=Borro';

  //evt.preventDefault();
  var fd = new FormData();

  var bookId = bookId;

  fd.append('bookId', bookId);

  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
            console.log(bookId);
        console.log(JSON.stringify(data));
      });
    }
  )
}

////////////////////////////////////


function Borrowing(){
    if(localStorage.getItem('LoginStatus') == 'false'){
         alert('you need to login');
    }
    else{
    alert('welcome');
    }
  var url = 'controller/testFunction.php?request_function=Borrowing';
  var HTMLcode = '';
  var HTMLTemplate =Borrowing1.innerHTML;
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }else if(data.result == 'false'){
          document.getElementById(id).innerHTML = 'not found';
        }else{
            localStorage.setItem('Borrowing',JSON.stringify(data));
          for(var loop = 0;loop<data.length;loop++){
            HTMLcode += HTMLTemplate.replace(/{{BookTitle}}/g, data[loop].BookTitle)
              .replace(/{{Name}}/g, data[loop].Name)
              .replace(/{{lastName}}/g, data[loop].lastName)
              .replace(/{{BookBorrowingDate}}/g, data[loop].BookBorrrowingDate)
              .replace(/{{BookBorrrowingDueDate}}/g, data[loop].BookBorrrowingDueDate);
          }
        }
        BorrowingContent.innerHTML = HTMLcode;
        console.log(JSON.stringify(data));
      });
    }
  )
}
/////////////////////////////////////////


function Staff(){

  var url = 'controller/testFunction.php?request_function=Staff';
  var HTMLcode = '';
  var HTMLTemplate =Staff1.innerHTML;
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }else if(data.result == 'false'){
          document.getElementById(id).innerHTML = 'not found';
        }else{
            localStorage.setItem('Staff',JSON.stringify(data));
          for(var loop = 0;loop<data.length;loop++){
            HTMLcode += HTMLTemplate.replace(/{{StaffName}}/g, data[loop].StaffName)
              .replace(/{{StaffLastName}}/g, data[loop].StaffLastName)
              .replace(/{{lastName}}/g, data[loop].lastName);

          }
        }
        StaffContent.innerHTML = HTMLcode;

          document.getElementById("spinner-box").style.display = "none";
          // .replace(replace_spinner, Staff1);
          console.log(JSON.stringify(data));

      });
    }
  )
}











/////////////////////////////////////////////////////////////////////
function pro(){
    if(localStorage.getItem('LoginStatus') =='false')
    {
         alert('you need to login');
    }else{
    alert('welcome');
    }

  var url = 'controller/testFunction.php?request_function=pro';
  var HTMLcode = '';
  var HTMLTemplate = pro1.innerHTML;
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }else if(data.result == 'false'){
          document.getElementById(id).innerHTML = 'not found';
        }else{
            localStorage.setItem('pro',JSON.stringify(data));
          for(var loop = 0;loop<data.length;loop++){
            HTMLcode += HTMLTemplate.replace(/{{studentId}}/g, data[loop].studentId)
            .replace(/{{Name}}/g, data[loop].Name)
            .replace(/{{lastName}}/g, data[loop].lastName)
            .replace(/{{Email}}/g, data[loop].Email)
            .replace(/{{PhoneNo}}/g, data[loop].PhoneNo)
              .replace(/{{address}}/g, data[loop].address);
          }
        }
        proContent.innerHTML = HTMLcode;
          document.getElementById("spinner-box1").style.display = "none";
        console.log(JSON.stringify(data));
      });
    }
  )
}




//post data using  json fetch api foe student Register
function Register(){

  var url = 'controller/testFunction.php?request_function=Register';

  //evt.preventDefault();
  var fd = new FormData();
  var Name = $('#Name').val();
  var lastName = $('#lastName').val();
  var Email = $('#Email').val();
alert(Email);
  var PhoneNo = $('#PhoneNo').val();
  var address = $('#address').val();
  var password = $('#password').val();

  fd.append('Name', Name);
  fd.append('lastName', lastName);
  fd.append('Email', Email);
  fd.append('PhoneNo', PhoneNo);
  fd.append('address', address);
  fd.append('password', password);
  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){

        console.log(JSON.stringify(data));
      });
    }
  )
}
////post data using  json fetch api for student Login
function addlogin(){
    if('null'!=localStorage.getItem('LoginStatus')){
         alert('you are login');
    }
    else{
    alert('you not login');
    }
  var url = 'controller/testFunction.php?request_function=addlogin';
  var fd = new FormData();

  var Email = $('#Email1').val();

  var password = $('#password1').val();


  fd.append('Email', Email);
  fd.append('password', password);

  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.Login== 'true'){
          localStorage.setItem('LoginStatus',JSON.stringify(data));
        }
          else if (data.Login== 'false'){
              localStorage.setItem('LoginStatus',null);

          }

          get_content(home_content);

      });
    }
  )
}
///setitem in localstorage for login
function islogin(){
    console.log('hellow');
  var url = 'controller/testFunction.php?request_function=islogin';

  fetch(url,{
      method:'GET',
      credentials:'include'
  })
  .then(
      function(response){
          if(response.status != 200){
              console.log('Looks like there was a problem. Status Code:' + response.status);
          }
          response.json().then(function(data){
              if(data.islogin == 'true')
              {

                  localStorage.setItem('LoginStatus',true);
              }
              else{
                localStorage.setItem('LoginStatus',false);
              }
              //console.log(JSON.stringify(login_content));
          });
      }
  )
}









///fetchbook

function fetchbook(){
  var url = 'controller/testFunction.php?request_function=selectbook';
  var HTMLcode = '';
  var HTMLTemplate = book.innerHTML;
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
           localStorage.setItem('selectbook',JSON.stringify(data));
        if(data.error == 'true'){
          alert("error");
        }else if(data.result == 'false'){
          document.getElementById(id).innerHTML = 'no book found';
        }else{
             localStorage.setItem('selectbook',JSON.stringify(data));

          for(var loop = 0;loop<data.length;loop++){
            HTMLcode += HTMLTemplate.replace(/{{bookId}}/g, data[loop].bookId)
            .replace(/{{BookTitle}}/g, data[loop].BookTitle)
            .replace(/{{ISBN}}/g, data[loop].ISBN)
            .replace(/{{bookAuthor}}/g, data[loop].bookAuthor)
            .replace(/{{bookImage}}/g, data[loop].bookImage)
            .replace(/{{bookPublisher}}/g, data[loop].bookPublisher)
            .replace(/{{bookAddtion}}/g, data[loop].bookAddtion)
            .replace(/{{bookDes}}/g, data[loop].bookDes)
            .replace(/{{BookCatId}}/g, data[loop].BookCatId);


            }
        }
        bookContent.innerHTML = HTMLcode;
           document.getElementById("spinner-box3").style.display = "none";
        console.log(JSON.stringify(data));
      });
    }
  )
}
/////////////////////////////////////





///post data using  json fetch api for student update record
function Update(){
  var url = 'controller/testFunction.php?request_function=Update';
  var fd = new FormData();

  var Name = $('#Name2').val();
var lastName = $('#lastName2').val();
var Email = $('#Email2').val();
 var PhoneNo = $('#PhoneNo2').val();
    var address = $('#address2').val();
  fd.append('Name', Name);
  fd.append('lastName', lastName);
fd.append('Email',Email);
fd.append('PhoneNo',PhoneNo);
 fd.append('address',address);

  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }
        console.log(JSON.stringify(data));
      });
    }
  )
}



///

////post data using  json fetch api for staff(user creat)
function AddUser(){
  var url = 'controller/testFunction.php?request_function=addstaff';
  //console.log(url);
  var fd = new FormData();
  var StaffName = $('#StaffName').val();
  var StaffLastName = $('#StaffLastName').val();
  var StaffEamil  = $('#StaffEamil').val();
  var StaffPhone  =  $('#StaffPhone').val();
  var staffpassword = $('#staffpassword').val();

  fd.append('StaffName', StaffName);
  fd.append('StaffLastName', StaffLastName);
  fd.append('StaffEamil', StaffEamil);
  fd.append('StaffPhone', StaffPhone);
  fd.append('staffpassword', staffpassword);

  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }
        console.log(JSON.stringify(data));
      });
    }
  )
}
//post data using  json fetch api for add book category//
function addcat(){

  var url = 'controller/testFunction.php?request_function=addcat';
  //console.log(url);
  var fd = new FormData();
  var BookCatName  = $('#BookCatName').val();
  fd.append('BookCatName', BookCatName);
  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }
        console.log(JSON.stringify(data));
      });
    }
  )
}
//get data using  json fetch api for display book category
function load_bookcat(){
    var url = 'controller/testFunction.php?request_function=bookcat';
    console.log(url);
    fetch(url,{
        method:'GET',
        credentials:'include'
    })
    .then(
        function(response) {
            if(response.status != 200){
                console.log('Looks like there was a problem. Status Code:' + response.status);
            }
            response.json().then(function(data){
                console.log(data);
                var outHTML = '';
               for(loop=0; loop<data.length;loop++){
  outHTML+='<option value="'+ data[loop].BookCatId +'">' + data[loop].BookCatName + '</option>';

                };

                bookcat.innerHTML = outHTML;

            });
        }
    );
}

//get data using  json fetch api for diplay log data
function fetchLog(){
  var url = 'controller/testFunction.php?request_function=selectlog';
  var HTMLcode = '';
  var HTMLTemplate = logrow.innerHTML;
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'true'){
          alert("error");
        }else if(data.result == 'false'){
          document.getElementById(id).innerHTML = 'no logs found';
        }else{
          for(var loop = 0;loop<data.length;loop++){
            HTMLcode += HTMLTemplate.replace(/{{logID}}/g, data[loop].logID)
            .replace(/{{ipAddress}}/g, data[loop].ipAddress)
            .replace(/{{time}}/g, data[loop].time)
            .replace(/{{action}}/g, data[loop].action);
          }
        }
        logContent.innerHTML = HTMLcode;
        console.log(JSON.stringify(data));
      });
    }
  )
}
///////////////////////////////////////


function logout(){

  var url = 'model/logout.php';

  //evt.preventDefault();
  var fd = new FormData();


  fetch(url, {
    method: 'POST',
    body: fd,
    credentials: 'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
     if(data.logout == 'true')
              {

                  localStorage.setItem('LoginStatus',false);
              }

              //console.log(JSON.stringify(login_content));
          });
    }
  )
}












// rate limit for check24hr
function check24hr(){
  var url = 'controller/testFunction.php';
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == '24hours'){
          alert("More than 10 requests in last 24hours!");
        }
      });
    }
  )
}
//rate limit for oneSecond
function oneSecond(){
  var url = 'controller/testFunction.php';
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'oneSecond'){
          alert("More than one request per second per user session!");
        }
      });
    }
  )
}
//checkDomain
function checkDomain(){
  var url = 'controller/testFunction.php';
  //console.log(url);

  fetch(url,{
    method:'GET',
    credentials:'include'
  })
  .then(
    function(response){
      if(response.status != 200){
        console.log('Looks like there was a problem. Status Code:' + response.status);
      }
      response.json().then(function(data){
        if(data.error == 'domain'){
          alert("Your request not in a whitelist of referrers");
        }
      });
    }
  )
}
