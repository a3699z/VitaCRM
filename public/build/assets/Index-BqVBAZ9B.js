import{j as e,Y as p,b as r}from"./app-BACc9fFJ.js";import{A as i}from"./AuthenticatedLayout-Covg4M6F.js";import"./ApplicationLogo-S94SrLs6.js";import"./Dropdown-Bo8Rbs60.js";import"./transition-vVAUK3FW.js";import"./ResponsiveNavLink-Dl17lHuB.js";function j({auth:t,reservations:l}){console.log(l);const d=s=>{r.post("/reservation/accept",{key:s}).then(c=>{console.log(c.data)})},a=s=>{r.post("/reservation/decline",{key:s}).then(c=>{console.log(c.data)})};return e.jsxs(i,{user:t.user,header:e.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Dashboard"}),children:[e.jsx(p,{title:"Dashboard"}),e.jsxs("div",{children:[e.jsx("thead",{children:e.jsxs("tr",{children:[t.user.user_type==="employee"?e.jsx("th",{className:"px-4 py-2",children:"Patient"}):e.jsx("th",{className:"px-4 py-2",children:"Doctor"}),e.jsx("th",{className:"px-4 py-2",children:"Date"}),e.jsx("th",{className:"px-4 py-2",children:"Time"}),t.user.user_type==="employee"?e.jsx("th",{className:"px-4 py-2",children:"Action"}):e.jsx("th",{className:"px-4 py-2",children:"Status"})]})}),e.jsx("tbody",{children:l.map(s=>e.jsxs("tr",{children:[t.user.user_type==="employee"?e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}):e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}),e.jsx("td",{className:"border px-4 py-2",children:s.date}),e.jsx("td",{className:"border px-4 py-2",children:s.time}),t.user.user_type==="employee"?e.jsxs("td",{className:"border px-4 py-2",children:[e.jsx("button",{onClick:c=>{d(s.key)},children:"Accept"}),e.jsx("button",{onClick:c=>{a(s.key)},children:"Decline"})]}):e.jsx("td",{className:"border px-4 py-2",children:s.status})]},s.key))})]})]})}export{j as default};