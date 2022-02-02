$(document).ready(function(){
    $('.mobile-menu-icon').click(function(){
        $('.mobile-menu').toggleClass('show');
    }); 
    
    
    
    
    $('.slider-category-name').hide();  
  $('.owl-one .item').hover( function () {
    $(this).find('.slider-category-name').slideToggle(200);  
  });

    
     $('.cat-menu-sign').on('click', function(e) {
      $('.categories-menu').toggleClass("categories-menu-hide categories-menu-show"); 
    $('.orders-store-icon').addClass("orders-pop-hide"); 
      e.preventDefault();
    });
    
    
    $('.cat-mobile').on('click', function(e) {
      $('.categories-menu-mobile').slideToggle(200); 
    });
    
    
    $('.shopping-cart-icon').on('click', function(e) {
      $('.orders-store-icon').toggleClass("orders-pop-hide orders-pop-show"); 
      $('.categories-menu').addClass("categories-menu-hide"); 
      e.preventDefault();
    });
    
     $('.add').click(function () {
		if ($(this).prev().val() ) {
    	$(this).prev().val(+$(this).prev().val() + 1);
		}
});
$('.sub').click(function () {
  if($(this).next().val() != 1){
		if ($(this).next().val() > 1) {
    	if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
		}
  }
});
    
    
    
    
    
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select1");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);    
    
   
    $('#cardnumber').on('keypress change', function () {
  $(this).val(function (index, value) {
	  return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
  });
});
    
    
     $( function() {
    $( "#tabs" ).tabs();
  } );
    
    
});
