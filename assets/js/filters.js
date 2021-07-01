function init_filters() {
  let form = document.forms['filters'];



  let href = window.location.search.split('?');
  if (href.length > 1){
    href = decodeURI(href[1]);
    while (href.includes('+')) href = href.replace('+', ' ');
    

    href = href.split('&');

    for (let i = 0; i < href.length; i++) {
      let v = href[i].split('=');
      for (let j = 0; j < form[v[0]].length; j++) {
        if (form[v[0]][j].value == v[1]) form[v[0]][j].setAttribute('checked', '');
      } 

    }

    
  }
}

/*window.onload = init_filters;*/
init_filters()


function submitform() {
  document.forms['filters'].submit();
}