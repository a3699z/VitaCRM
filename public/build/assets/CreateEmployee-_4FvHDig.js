import{W as i,r as m,j as e,Y as c}from"./app-BACc9fFJ.js";import{A as p}from"./AdminLayout-BzweGtWt.js";import"./ApplicationLogo-S94SrLs6.js";import"./Dropdown-Bo8Rbs60.js";import"./transition-vVAUK3FW.js";import"./ResponsiveNavLink-Dl17lHuB.js";function j({auth:t,teams:o}){console.log(o);const{data:l,setData:s,post:r,processing:u,errors:x,reset:n}=i({name:"",email:"",password:"",team_key:""});m.useEffect(()=>()=>{n("password","password_confirmation")},[]);const d=a=>{console.log("hello"),console.log(l),a.preventDefault(),r(route("admin.employee.store"))};return e.jsxs(p,{user:t.user,header:e.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Create Employe"}),children:[e.jsx(c,{title:"Create Employee"}),e.jsx("div",{className:"py-12",children:e.jsxs("div",{className:"max-w-7xl mx-auto sm:px-6 lg:px-8",children:[e.jsx("div",{className:"bg-white overflow-hidden shadow-sm sm:rounded-lg",children:e.jsx("div",{className:"p-6 text-gray-900",children:"Create Employee"})}),e.jsxs("form",{className:"bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4",onSubmit:d,children:[e.jsxs("div",{className:"mb-4",children:[e.jsx("label",{className:"block text-gray-700 text-sm font-bold mb-2",htmlFor:"name",children:"Name"}),e.jsx("input",{className:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"name",type:"text",placeholder:"Name",onChange:a=>{s("name",a.target.value)}})]}),e.jsxs("div",{className:"mb-6",children:[e.jsx("label",{className:"block text-gray-700 text-sm font-bold mb-2",htmlFor:"email",children:"Email"}),e.jsx("input",{className:"shadow appearance-none border border-red rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline",id:"email",type:"email",placeholder:"Email",onChange:a=>{s("email",a.target.value)}})]}),e.jsxs("div",{className:"mb-4",children:[e.jsx("label",{className:"block text-gray-700 text-sm font-bold mb-2",htmlFor:"password",children:"Password"}),e.jsx("input",{className:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"password",type:"password",placeholder:"Password",onChange:a=>{s("password",a.target.value)}})]}),e.jsxs("div",{className:"mb-4",children:[e.jsx("label",{className:"block text-gray-700 text-sm font-bold mb-2",htmlFor:"team",children:"Team"}),e.jsxs("select",{className:"shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline",id:"team",onChange:a=>{s("team_key",a.target.value)},children:[e.jsx("option",{value:"",children:"Select Team"}),o.map(a=>e.jsx("option",{value:a.key,children:a.name},a.key))]})]}),e.jsx("div",{className:"flex items-center justify-between",children:e.jsx("button",{className:"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline",type:"submit",children:"Create"})})]})]})})]})}export{j as default};