window.onload=function  () {
    var sUrl = location.search.toLowerCase();
    var sQuery = sUrl.substring(sUrl.indexOf("=") + 1);
    re = /select|update|delete|truncate|join|union|and|in|all|as|by|group|exec|insert|drop|count|'|"|;|>|<|%/i;
    if (re.test(sQuery)) {
        alert("请勿输入非法字符");
        location.href = sUrl.replace(sQuery, "");
    }
}