function press_toggle(toggle) {

  let group = toggle.parentElement.getAttribute("data-group");
  let item = toggle.getAttribute("data-group-item");
  let href = document.getElementById('applyButtonHref').getAttribute("href").split('?');
  let querys = "";
  if (toggle.classList.contains('active')) {
    toggle.classList.remove('active');

    if (href.length > 1) {
      querys = href[1].split('&');
    }

    let ans1 = -1;
    let ans12 = -1;

    for (var i = 0; i < querys.length; i++) {
      querys[i] = querys[i].split('=');

      if (querys[i][0] == group) {
        ans1 = i;
        querys[i][1] = querys[i][1].split(',');
        for (var j = 0; j < querys[i][1].length; j++) {
          if (decodeURI(querys[i][1][j]) == item) {
            ans12 = j;
          }
        }
      }
    }


    let a = '';

    for (var i = 0; i < ans1; i++) {
      if (i > 0) a += "&";
      a += querys[i][0] + "=" + querys[i][1];
    }

    if (querys[ans1][1].length-1 > 0) {
      if (ans1 > 0) a += "&";
      a += querys[ans1][0] + "=";
    }
    for (var i = 0; i < ans12; i++) {
      if (i > 0) a += ",";
      a += querys[ans1][1][i];
    }

    for (var i = ans12+1; i < querys[ans1][1].length; i++) {
      if (i > ans12+1) a += ",";
      a += querys[ans1][1][i];
    }


    if (querys[ans1][1].length-1 > 0 && querys.length > ans1 + 1) a += "&";
    for (var i = ans1 + 1; i < querys.length; i++) {
      if (i > ans1 + 1) a += "&";
      a += querys[i][0] + "=" + querys[i][1];
    }

    if (a.length > 0) {
      document.getElementById('applyButtonHref').setAttribute("href", href[0]+'?'+a);
    } else {
      document.getElementById('applyButtonHref').setAttribute("href", href[0]);
    }


  }
  else {
    querys = '?';
    if (href.length > 1) {
      querys += href[1];
    }
    toggle.classList.add('active');
    let index = querys.search(group);
    if (index >= 0) {
      index = querys.indexOf('&',index);
      if (index >= 0) {
        querys = querys.substr(0, index) + "," + item + querys.substr(index);
        
      } else {
        querys += "," + item;
      }
    } else {
      // find '?'
      if (querys.length == 1) {
        querys += group + "=" + item;
      } else {
        querys += "&" + group + "=" + item;
      }
    }
    document.getElementById('applyButtonHref').setAttribute("href", href[0]+querys);
  }
}






function init() {
  toggles = document.getElementsByClassName('toggle');
  /*let href1 = document.getElementById('applyButtonHref').getAttribute("href").split('?');
  let querys1 = '?';
  if (href1.length > 1) {
    querys1 += href1[1];
  }*/
  for (var i=0; i<toggles.length; i++) {
    let toggle = toggles[i];
    /*let group1 = toggle.parentElement.getAttribute("data-group");
    let item1 = toggle.getAttribute("data-group-item");
*/
    toggle.onclick = function() {
      press_toggle(toggle);
    };

    /*console.log("index");
    let index1 = querys1.search(group1);
    console.log(index1);
    if (index1 >= 0) {
      console.log("index1 > 0");
      let index11 = querys1.indexOf('&',index1);
      let a1 = querys1.substr(index1, index11);
      console.log(index11);
      console.log(a1);
      console.log(a1.includes(item1));
      if (a1.includes(item1)){
        toggle.classList.add('active');
        console.log('active');
      }
    }*/
  }
}

window.onload = init;
