import{j as s,Y as a}from"./app-BACc9fFJ.js";import{A as o}from"./AuthenticatedLayout-Covg4M6F.js";import i from"./DeleteUserForm-D-bLlRum.js";import l from"./UpdatePasswordForm-CkVeQqxa.js";import t from"./UpdateProfileInformationForm-BnMcy7KS.js";import d from"./UpdateAvailableDatesForm-DozH9e1i.js";import x from"./ContactsInsuranceForm-DURYTP44.js";import p from"./ProfessionalDateForm-BWjrlffw.js";import n from"./OtherPatientInfo-DbGAJL8r.js";import"./ApplicationLogo-S94SrLs6.js";import"./Dropdown-Bo8Rbs60.js";import"./transition-vVAUK3FW.js";import"./ResponsiveNavLink-Dl17lHuB.js";import"./InputError-Bjq8RDYc.js";import"./InputLabel-h9B-wlVY.js";import"./TextInput-CRybGfKq.js";import"./PrimaryButton-CI2eF_qd.js";function E({auth:e,mustVerifyEmail:m,status:r}){return console.log(e.user),s.jsxs(o,{user:e.user,header:s.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Profile"}),children:[s.jsx(a,{title:"Profile"}),s.jsx("div",{className:"py-12",children:s.jsxs("div",{className:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6",children:[s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(t,{mustVerifyEmail:m,status:r,className:"max-w-xl"})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(l,{className:"max-w-xl"})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(x,{className:"max-w-xl"})}),e.user.user_type==="employee"&&s.jsxs("div",{children:[s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(d,{className:"max-w-xl"})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(p,{className:"max-w-xl"})})]}),e.user.user_type==="patient"&&s.jsx("div",{children:s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(n,{className:"max-w-xl"})})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(i,{className:"max-w-xl"})})]})})]})}export{E as default};