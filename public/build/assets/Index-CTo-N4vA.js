import{j as e,Y as n,b as r}from"./app-DHnVHQL0.js";import{A as i}from"./AuthenticatedLayout-DJZ2QH3q.js";import"./ApplicationLogo-6YPv8pc4.js";import"./ResponsiveNavLink-lTcFx5po.js";import"./transition-B2Jx8vGI.js";function j({auth:c,reservations:l}){console.log(l);const d=s=>{r.post("/reservation/accept",{key:s}).then(t=>{console.log(t.data)})},a=s=>{r.post("/reservation/decline",{key:s}).then(t=>{console.log(t.data)})};return e.jsxs(i,{user:c.user,header:e.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Dashboard"}),children:[e.jsx(n,{title:"Dashboard"}),e.jsxs("div",{children:[e.jsx("thead",{children:e.jsxs("tr",{children:[c.user.user_type==="employee"?e.jsx("th",{className:"px-4 py-2",children:"Patient"}):e.jsx("th",{className:"px-4 py-2",children:"Doctor"}),e.jsx("th",{className:"px-4 py-2",children:"Date"}),e.jsx("th",{className:"px-4 py-2",children:"Time"}),e.jsx("th",{className:"px-4 py-2",children:"Actions"})]})}),e.jsx("tbody",{children:l.map(s=>e.jsxs("tr",{children:[c.user.user_type==="employee"?e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}):e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}),e.jsx("td",{className:"border px-4 py-2",children:s.date}),e.jsx("td",{className:"border px-4 py-2",children:s.time}),e.jsxs("td",{className:"border px-4 py-2",children:[e.jsx("button",{onClick:t=>{d(s.key)},children:"Accept"}),e.jsx("button",{onClick:t=>{a(s.key)},children:"Decline"})]})]},s.key))})]})]})}export{j as default};
