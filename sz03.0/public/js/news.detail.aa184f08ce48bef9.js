webpackJsonp([17],{124:function(t,e,n){"use strict";function s(t,e){try{var n=JSON.parse($(t).html());e.__proto__.lang=n}catch(t){alert("系統繁忙，請稍後重試。(The system is busy, please try again later.)")}}e.a=s},16:function(t,e){t.exports=libs_6290e223},799:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s=n(800),a=(n.n(s),n(27)),i=n(78),o=n(96),r=n(33),c=n(66),h=n(51),u=n(124),l=n(76);$(document).ready(function(){function t(){Object(o.a)({url:"/ajax_news/commentList?id="+d,method:"GET",success:function(t){var n=(t.status,t.data);if(Object(r.a)(n,"Array")&&n.length>0){var s=function(t){var e=new Date(1e3*t),n=e.getMinutes();return n-9<=0&&(n="0"+n),{year:e.getFullYear(),month:e.getMonth()<9?"0"+(e.getMonth()+1):e.getMonth()+1,date:e.getDate(),hh:e.getHours()+":"+n}},a=function(t){if(!t)return"";var n=o.getTime(),a=parseInt(t),i=parseInt(n/1e3)-a,r="";if(i<=60&&(r=e.just),i>60&&i<=3600&&(r=""+(parseInt(i/60)+e.min)),i>3600&&i<=86400&&(r=""+(parseInt(i/60/60)+e.hour)),i>86400&&i<=172800&&(r=""+(e.yesterday+s(t).hh)),i>172800&&i<=259200&&(r=""+(e.the_day_before_yesterday+s(t).hh)),i>259200){var c=s(t);r=c.year==o.getFullYear()?c.month+"-"+c.month+" "+c.hh:c.year+"-"+c.month+"-"+c.month+" "+c.hh}return r};$("#noIssData").hide();var i="",o=new Date;n.reverse().forEach(function(t){var e="";e=t.mo?t.mo.slice(0,3)+"****"+t.mo.slice(-4):t.email,i+='<li>\n              <div class="iss-li-top">\n                <span>'+e+"</span><span>"+a(t.created)+'</span>\n              </div>\n              <div class="iss-describe">'+t.content+"</div>\n            </li>"}),$("#issListShow").html(i)}else Array.isArray(n)&&0===n.length&&$("#noIssData").show()}})}Object(u.a)("#baseLang",o.a);var e=Object(h.a)()||{just:"剛剛",yesterday:"昨天",the_day_before_yesterday:"前天",min:"分鐘",hour:"小時前"},n=new l.a;c.a.setReUrl();var s=(Object(a.a)(),i.a);$("#newsIsset").on("input",function(){var t=$(this).val();$("#issLength").html(t.length)});var d=$("#detailid").attr("data-dds");!function(){Object(o.a)({url:"/ajax_user/getUserInfo",method:"GET",success:function(t){var e=t.status,n=t.data;1===parseInt(e)&&n?($("#issNLG").hide(),$("#issDom").css({opacity:1}).show()):($("#issNLG").show(),$("#issDom").hide())}})}(),window.REGX_HTML_ENCODE=/"|&|'|<|>|[\x00-\x20]|[\x7F-\xFF]|[\u0100-\u2700]/g,window.encodeHtml=function(t){return"string"!=typeof t?t:t.replace(this.REGX_HTML_ENCODE,function(t){var e=t.charCodeAt(0),n=["&#"];return e=32==e?160:e,n.push(e),n.push(";"),n.join("")})},$("#seedIss").click(function(){var e=$("#newsIsset"),a=$("#hahaha").text();if(e.length>0){var i=window.encodeHtml(e.val());Object(o.a)({url:"/ajax_news/newsComment",method:"POST",data:{nid:d,content:i,reqToken:a},success:function(a){var i=a.status,o=a.data,r=a.msg;1===parseInt(i)?(e.val(""),$("#issLength").text("0"),t()):(r.content?n.show(r.content):n.show(r),1==o.need_login&&$('[data-btnsu="sureBtn"]').click(function(t){n.closed(function(){s.loginAlert()})}))}},"noAlert")}}),$("#loginBtn").click(function(){s.$watch("isLogin",function(){$("#issNLG").hide(),$("#issDom").css({opacity:1}).show()}),s.loginAlert()}),$("#backToNewsList").on("click",function(){var t=$(".act-ti").attr("href");location.href=t}),t()})},800:function(t,e){}},[799]);
//# sourceMappingURL=news.detail.aa184f08ce48bef9.js.map