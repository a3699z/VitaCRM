import{j as e,Y as p,a as i,b as r}from"./app-BzwFqjNo.js";import{A as n}from"./AuthenticatedLayout-BFb0T0AC.js";import"./ApplicationLogo-DYD_jz67.js";import"./Dropdown-DINxuS6i.js";import"./transition-CJNBAo9Z.js";import"./ResponsiveNavLink-xzJ1aPFT.js";function u({auth:t,reservations:c}){console.log(c);const a=s=>{r.post("/reservation/accept",{key:s}).then(l=>{console.log(l.data)})},d=s=>{r.post("/reservation/decline",{key:s}).then(l=>{console.log(l.data)})};return e.jsxs(n,{user:t.user,header:e.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Dashboard"}),children:[e.jsx(p,{title:"Dashboard"}),e.jsxs("div",{children:[e.jsx("thead",{children:e.jsxs("tr",{children:[t.user.user_type==="employee"?e.jsx("th",{className:"px-4 py-2",children:"Patient"}):e.jsx("th",{className:"px-4 py-2",children:"Doctor"}),e.jsx("th",{className:"px-4 py-2",children:"Date"}),e.jsx("th",{className:"px-4 py-2",children:"Time"}),t.user.user_type==="employee"?e.jsx("th",{className:"px-4 py-2",children:"Action"}):e.jsx("th",{className:"px-4 py-2",children:"Status"}),e.jsx("th",{className:"px-4 py-2",children:"Start Session"})]})}),e.jsx("tbody",{children:c.map(s=>e.jsxs("tr",{children:[t.user.user_type==="employee"?e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}):e.jsx("td",{className:"border px-4 py-2",children:s.reservation_with.name}),e.jsx("td",{className:"border px-4 py-2",children:s.date}),e.jsx("td",{className:"border px-4 py-2",children:s.time}),t.user.user_type==="employee"?e.jsxs("td",{className:"border px-4 py-2",children:[e.jsx("button",{onClick:l=>{a(s.key)},children:"Accept"}),e.jsx("button",{onClick:l=>{d(s.key)},children:"Decline"})]}):e.jsx("td",{className:"border px-4 py-2",children:s.status}),e.jsx("td",{className:"border px-4 py-2",children:e.jsx(i,{href:`/session/${s.key}`,className:"text-blue-500",children:"Start Session"})})]},s.key))})]})]})}export{u as default};
