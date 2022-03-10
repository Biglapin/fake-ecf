const filter = document.querySelector("#filter");
const checkbox = document.querySelectorAll('#filter input[type=checkbox]');

checkbox.forEach(element => {
  element.checked = false;
})

checkbox.forEach(input => {
  input.addEventListener("change", () => {

    const Form = new FormData(filter);

    const Params = new URLSearchParams();

    Form.forEach((value, key) => {
      Params.append(key, value)
     // console.log(value, key);
    } )

    const url = new URL(window.location.href);
    
    fetch(url.pathname + "?" + Params.toString() + "&ajax=1", {
      headers:{
        "X-Requested-with": "XMLHttpRequest"
      }
    }).then(response => 
      response.json()  
    ).then(data => {

      const divBooks = document.querySelector('#books')
      divBooks.innerHTML = '';
      data.books.forEach(book => {
        elementsBooks.forEach(elementBook => {
          if(elementBook.id == book.id ) {
            if(elementBook.isReserved == false){
              divBooks.innerHTML +='<div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col text-center">'+
              '<a href="#">'+
              '<img class="hover:grow hover:shadow-lg" src="'+elementBook.image+'">'+
              '<div class="pt-3 flex items-center justify-center">'+
              '<p class="text-xl mb-2 font-bold ">'+elementBook.title+'</p>'+
              '</div>'+
              '<p class="pt-1 text-gray-700 text-base">'+elementBook.description+'</p>'+
              '<button id="rental" class=" h-20 bg-transparent hover:bg-blue-500 text-blue-700'+ 
              'font-semibold hover:text-white py-2 px-4 border border-blue-500 '+
              'hover:border-transparentrounded "> Emprunte moi </button>'
            } else {
              divBooks.innerHTML +='<div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col text-center">'+
              '<a href="#">'+
              '<img class="hover:grow hover:shadow-lg" src="'+elementBook.image+'">'+
              '<div class="pt-3 flex items-center justify-center">'+
              '<p class="text-xl mb-2 font-bold ">'+elementBook.title+'</p>'+
              '</div>'+
              '<p class="pt-1 text-gray-700 text-base">'+elementBook.description+'</p>'+
              '<button id="rental" class="h-20 bg-transparent  text-blue-700 font-semibold'+ 
              ' py-2 px-4 border border-blue-500'+
              'rounded opacity-50 cursor-not-allowed">'+
              'Non disponible'+
              '</button>'
            }
          }
        })
      })
    })
  })
})



//Event when rental button is clicked
$(document).ready(function() {
  $.ajax({
    type: 'GET',
    url: '/allbook',
    datatype: 'json',
    success: function(result)
      {
        $( "#rental" ).click(function() {
          var obj = JSON.parse(result);
          var isReserved = obj.isReserved;

          for (var i = 0; i < obj.length; i++) {
            var isReserved = obj[i].isReserved;
       /*      if ( isReserved == false ) {
             // return (isReserved === true);  
           } */
          }
      
          console.log(obj);
          console.log(isReserved);
        
        });
        
      }
    })
  });