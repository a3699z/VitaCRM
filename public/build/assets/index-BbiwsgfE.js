import{W as t,j as e,a as o}from"./app-X7rQuqzQ.js";import{p as d}from"./profile-C-N-CwQ1.js";import{c as n}from"./calendarIcon-B6WNtZN4.js";import{r as p}from"./rightArrowIcon-gkYROAhw.js";import{N as m}from"./index-0w41dl_r.js";import"./Dropdown-BQqw1rnm.js";import"./transition-CaExHlyc.js";const h="_container_rrbp5_1",x="_title_rrbp5_8",j="_visitContainer_rrbp5_17",g="_row_rrbp5_26",u="_profilePhoto_rrbp5_33",N="_doctorInfo_rrbp5_41",_="_info_rrbp5_45",b="_doctorName_rrbp5_51",f="_profession_rrbp5_58",v="_groupContainer_rrbp5_67",C="_group_rrbp5_67",w="_groupTitle_rrbp5_77",D="_groupDesc_rrbp5_84",k="_iconContainer_rrbp5_93",y="_link_rrbp5_102",I="_linkIcon_rrbp5_113",T="_btnGroup_rrbp5_119",S="_btn_rrbp5_119",s={container:h,title:x,visitContainer:j,row:g,profilePhoto:u,doctorInfo:N,info:_,doctorName:b,profession:f,groupContainer:v,group:C,groupTitle:w,groupDesc:D,iconContainer:k,link:y,linkIcon:I,btnGroup:T,btn:S},K=({auth:a,reservation:r})=>{const{data:G,setData:P,post:c,processing:E,errors:F,reset:V}=t({key:r.key}),l=i=>{c(route("reservation.cancel"))};return e.jsxs(e.Fragment,{children:[e.jsx(m,{user:a.user}),e.jsx("div",{className:"min-h-screen bg-gray-100",children:e.jsxs("div",{className:s.container,children:[e.jsx("h4",{className:s.title,children:"Termindetails"}),e.jsxs("div",{className:s.visitContainer,children:[e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.doctorInfo,children:[e.jsx("img",{src:r.employee.profile_image?"/images/"+r.employee.profile_image:d,alt:"",className:s.profilePhoto}),e.jsxs("div",{className:s.info,children:[e.jsxs("h5",{className:s.doctorName,children:["Spezialist,",r.employee.name]}),e.jsx("h6",{className:s.profession,children:"Krankenpfleger"})]})]})}),e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsx("div",{className:s.group,children:e.jsxs("h5",{className:s.groupTitle,children:[new Date(r.date).toLocaleDateString("de-DE",{month:"long",day:"2-digit"}),"-",new Date(r.date).getFullYear()," ",r.hour,", ",new Date(r.date).toLocaleDateString("de-DE",{weekday:"long"})]})})]})}),e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsxs("div",{className:s.group,children:[e.jsx("h5",{className:s.groupTitle,children:"Videosprechstunde Termin"}),e.jsx("p",{className:s.groupDesc,children:"60 min"})]})]})}),e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsxs("div",{className:s.group,children:[e.jsx("h5",{className:s.groupTitle,children:"Behandelte Gruppe"}),e.jsx("p",{className:s.groupDesc,children:"NEIN"})]})]})}),e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsx("div",{className:s.group,children:e.jsx("h5",{className:s.groupTitle,children:"Wie bereitet man sich auf ein Online-Interview vor?"})}),e.jsx(o,{className:s.link,children:e.jsx("img",{src:p,className:s.linkIcon,alt:""})})]})}),r.status==="accepted"&&r.call?e.jsxs("div",{className:s.row,children:[e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsx("div",{className:s.group,children:e.jsx("h5",{className:s.groupTitle,children:"Starten Sie die Videosprechstunde"})})]}),e.jsx("div",{className:s.btnGroup,children:e.jsx(o,{href:route("call",r.call.key),className:s.btn,children:"Starten"})})]}):e.jsx(e.Fragment,{}),e.jsx("div",{className:s.row,children:e.jsxs("div",{className:s.groupContainer,children:[e.jsx("div",{className:s.iconContainer,children:e.jsx("img",{src:n,alt:""})}),e.jsx("div",{className:s.group,children:e.jsx("h5",{className:s.groupTitle,children:"Do you need to cancel the Appointment?"})}),e.jsx("form",{className:`${s.btnGroup} flex items-center justify-between gap-6`,onSubmit:i=>{i.preventDefault(),l(r.key)},children:e.jsx("button",{className:s.btn,children:"Stornieren"})})]})})]})]})})]})};export{K as default};