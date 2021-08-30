/* logic response for filters on  view page*/
let form = document.forms.filters;
let href = window.location.search.split('?');
if (href.length > 1){
  href = decodeURI(href[1]);
  href = href.replace(/\+/g, ' ');
  href = href.replace(/\[\d+\]/g, '[]');
  href = href.split('&');
  for (let i = 0; i < href.length; i++) {
    let v = href[i].split('=');
    for (let j = 0; j < form[v[0]].length; j++) {
      if (form[v[0]][j].value == v[1]) form[v[0]][j].setAttribute('checked', '');
    }
  }
}

function submitform() {
  document.forms.filters.submit();
}