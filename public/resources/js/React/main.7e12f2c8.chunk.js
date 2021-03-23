(this["webpackJsonpreact-bewerbung"]=this["webpackJsonpreact-bewerbung"]||[]).push([[0],{31:function(e,t,a){},32:function(e,t,a){},59:function(e,t,a){"use strict";a.r(t);var s=a(0),n=a.n(s),c=a(5),l=a.n(c),o=(a(31),a.p,a(32),a(1));var i=a(7),d=function(e){e&&e instanceof Function&&a.e(3).then(a.bind(null,60)).then((function(t){var a=t.getCLS,s=t.getFID,n=t.getFCP,c=t.getLCP,l=t.getTTFB;a(e),s(e),n(e),c(e),l(e)}))},r=a(13),u=a(6),h={messages:[]},m=function(e){return{type:"SYNC_WITH_DB",payload:e}},g=Object(u.b)((function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:h,t=arguments.length>1?arguments[1]:void 0;switch(t.type){case"ADD_ITEM":return{messages:[].concat(Object(r.a)(e.messages),[{message:t.payload.message}])};case"ADD_CHAT_DATA":return JSON.parse(localStorage.getItem("messages"));case"SYNC_WITH_DB":return{messages:Object(r.a)(e.messages.concat(t.payload))};case"CLEAR_CHAT":return{messages:[]}}})),b=a(3),p=a.n(b),v=a(12),I=a(23),j=a(24),C=a(26),f=a(25),x=a(4),y=a.n(x),S=function(e){Object(C.a)(a,e);var t=Object(f.a)(a);function a(e){var s;return Object(I.a)(this,a),(s=t.call(this,e)).mapStateToProps=function(e){return{messages:g.getState()}},s.updateScroll=function(){var e=document.getElementById("chatList");e.scrollTop=e.scrollHeight},s.fetchData=Object(v.a)(p.a.mark((function e(){var t;return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:t={chatId:localStorage.getItem("chatId")},void 0!=localStorage.getItem("updated")&&(t={chatId:localStorage.getItem("chatId"),timestamp:localStorage.getItem("updated")}),y.a.post("/api/chat/messages",t).then((function(e){200==e.status&&(localStorage.setItem("updated",Date.now()),g.dispatch(m(JSON.parse(e.data))),localStorage.setItem(g.getState()),this.updateScroll())})).catch((function(e){console.log(e)}));case 3:case"end":return e.stop()}}),e)}))),s.createChat=function(){var e=document.getElementById("requestedChat");return""!==e.value?(document.getElementById("requestedChat").classList.remove("btn-outline-danger"),y.a.post("/api/chat/create",{chatId:e.value}).then((function(t){switch(t.status){case 200:localStorage.setItem("chatId",e.value),s.setState({chatId:e.value}),s.fetchData(),document.getElementById("chatInfo").style.display="none";case 201:localStorage.setItem("chatId",e.value),s.setState({chatId:e.value})}})).catch((function(e){console.log(e)}))):document.getElementById("requestedChat").classList.add("btn-outline-danger"),!0},s.joinChat=function(){var e=document.getElementById("requestedChat");return""!==e.value?(document.getElementById("requestedChat").classList.remove("btn-outline-danger"),y.a.post("/api/chat/join",{chatId:e.value}).then((function(t){switch(t.status){case 200:localStorage.setItem("chatId",e.value),s.setState({chatId:e.value}),s.fetchData(),document.getElementById("chatInfo").style.display="none"}})).catch((function(e){console.log(e)}))):document.getElementById("requestedChat").classList.add("btn-outline-danger"),!0},s.leaveChat=function(){localStorage.removeItem("chatId"),localStorage.removeItem("updated"),localStorage.removeItem("messages"),document.getElementById("messageText").value="",document.getElementById("chatInfo").style.display="block",g.dispatch({type:"CLEAR_CHAT"}),s.setState({sendable:!1})},s.addAction=function(){var e=document.getElementById("messageText").value;""!=e&&y.a.post("/api/chat/messages",{chatId:localStorage.getItem("chatId"),timestamp:Date.now(),message:e}).then((function(e){var t;200===e.status&&(localStorage.setItem("updated",Date.now()),g.dispatch({type:"ADD_ITEM",payload:{message:(t={message:document.getElementById("messageText").value,lastUpdate:Date.now()}).message,lastUpdate:t.lastUpdate}}),localStorage.setItem("messages",JSON.stringify(g.getState())),document.getElementById("messageText").value="",s.updateScroll(),s.setState({sendable:!1}))})).catch((function(e){console.log(e)}))},s.messages=function(e){var t="";if(void 0===e.messages)null!==localStorage.getItem("messages")&&void 0!==localStorage.getItem("messages")&&g.dispatch({type:"ADD_CHAT_DATA",payload:localStorage.getItem("messages")});else t=e.messages.messages.map((function(e,t){return Object(o.jsx)("li",{id:t,className:"border border-dark border-rounded mb-2",children:e.message},e.id)}));return Object(o.jsx)("ul",{id:"chatList",className:"list-unstyled ml-3 mr-3 pt-4",children:t})},s.ConnectedCounter=Object(i.b)(s.mapStateToProps)(s.messages),s.state={sendable:!1},s}return Object(j.a)(a,[{key:"componentDidMount",value:function(){var e=Object(v.a)(p.a.mark((function e(){var t=this;return p.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:this.intervalId=setInterval((function(){void 0!=localStorage.getItem("chatId")&&t.fetchData()}),1e3);case 1:case"end":return e.stop()}}),e,this)})));return function(){return e.apply(this,arguments)}}()},{key:"chatIdUpdate",value:function(){""===document.getElementById("requestedChat").value?document.getElementById("requestedChat").classList.add("btn-outline-danger "):document.getElementById("requestedChat").classList.remove("btn-outline-danger")}},{key:"messageChangeAction",value:function(){var e=document.getElementById("messageText");e&&(console.log("test1"),e.value&&""!==e.value?this.setState({sendable:!0}):this.setState({sendable:!1}))}},{key:"render",value:function(){return void 0==localStorage.getItem("chatId")?Object(o.jsxs)("div",{className:"mt-2",children:[Object(o.jsx)("button",{type:"button",id:"createChat",className:"btn btn-info mr-1 mb-3",value:"Erstelle einen Chat",onClick:this.createChat.bind(this),children:"Erstelle einen Chat"}),Object(o.jsx)("button",{type:"button",id:"enterChat",className:"btn btn-info mb-3",value:"Tritt einem Chat bei",onClick:this.joinChat.bind(this),children:"Tritt einem Chat Bei"}),Object(o.jsx)("input",{type:"text",id:"requestedChat",placeholder:"Chatraum ID",onChange:this.chatIdUpdate.bind(this),maxlength:"12"})]}):this.state.sendable?Object(o.jsxs)("div",{children:[Object(o.jsx)("input",{type:"submit",id:"leaveChat",name:"leaveChat",value:"Chat verlassen",className:"btn btn-danger btn-outline-light float-left",onClick:this.leaveChat.bind(this)}),Object(o.jsxs)("p",{className:"h5 text-center text-light bg-dark",id:"chatnr",children:["Chatraum: ",localStorage.getItem("chatId")]}),Object(o.jsxs)("div",{children:[Object(o.jsx)(this.ConnectedCounter,{}),Object(o.jsx)("br",{}),Object(o.jsxs)("div",{className:"row",children:[Object(o.jsx)("div",{className:"col-lg-10 pdl",children:Object(o.jsx)("textarea",{id:"messageText",name:"messageText",maxLength:"400",onChange:this.messageChangeAction.bind(this)})}),Object(o.jsx)("div",{className:"col-lg-2 pdr",children:Object(o.jsx)("input",{type:"submit",id:"postMessage",name:"postMessage",value:"Absenden",className:"btn btn-info btn-outline-light",onClick:this.addAction.bind(this)})})]})]})]}):Object(o.jsxs)("div",{children:[Object(o.jsx)("input",{type:"submit",id:"leaveChat",name:"leaveChat",value:"Chat verlassen",className:"btn btn-danger btn-outline-light float-left",onClick:this.leaveChat.bind(this)}),Object(o.jsxs)("p",{className:"h5 text-center text-light bg-dark",id:"chatnr",children:["Chatraum: ",localStorage.getItem("chatId")]}),Object(o.jsxs)("div",{children:[Object(o.jsx)(this.ConnectedCounter,{}),Object(o.jsx)("br",{}),Object(o.jsxs)("div",{className:"row",children:[Object(o.jsx)("div",{className:"col-lg-10 pdl",children:Object(o.jsx)("textarea",{id:"messageText",name:"messageText",maxLength:"400",onChange:this.messageChangeAction.bind(this)})}),Object(o.jsx)("div",{className:"col-lg-2 pdr",children:Object(o.jsx)("input",{type:"submit",id:"postMessage",name:"postMessage",value:"Schreiben..",className:"btn btn-dark btn-outline-light",onClick:this.addAction.bind(this)})})]})]})]})}}]),a}(n.a.Component);document.getElementById("Chat")&&l.a.render(Object(o.jsx)(i.a,{store:g,children:Object(o.jsx)(S,{})}),document.getElementById("Chat")),d()}},[[59,1,2]]]);
//# sourceMappingURL=main.7e12f2c8.chunk.js.map