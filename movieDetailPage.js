window.UrlUtil = (function(util){

  util.urlParameters = (function(){

    var qPos = window.document.URL.indexOf('?');
    var qParams = {};

    if(qPos>-1){

      var qStr = window.document.URL.substr(qPos+1);
      var temp = qStr.split('&');
      var t, key, value;

      for(var i=0; i<temp.length; i++){

        t = temp[i].split('=');

        if(t[0]){
          key = t[0];
        }else{
          continue;
        }

        value = t[1] ? t[1] : "";

        if(qParams[key] != undefined){

          if(!qParams[key].join){

            var tempVal = qParams[key];
            qParams[key] = [tempVal];

          }

          qParams[key].push((value)? decodeURIComponent(value) : value)

        }else{

          qParams[key] = (value) ? decodeURIComponent(value) : value;

        }
      }
    }

    return qParams;
  });

  //Url parameter value 반환
  //-name : parameter name
  //-defaultValue : 해당 parameter가 없을 때 반환하는 기본값

  util.getUrlParameter = function(name, defaultValue){
    if(!name){
      return defaultValue != undefined ? defaultValue : null;
    }
    return util.urlParameters[name] || (defaultValue != undefined ? defaultValue : null);
  };

  return util;
  
}({}));