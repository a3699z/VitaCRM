import{j as s,Y as a}from"./app-C3_TzhM4.js";import{A as i}from"./AuthenticatedLayout-BJKzMlCu.js";import o from"./DeleteUserForm-CjcV_El0.js";import t from"./UpdatePasswordForm-BWt7EE0J.js";import l from"./UpdateProfileInformationForm-CAf8lONy.js";import d from"./UpdateAvailableDatesForm-BVAsa_L2.js";import"./ApplicationLogo-Bt2iv0Iz.js";import"./ResponsiveNavLink-DRuOkeus.js";import"./transition-BZJsOhpt.js";import"./InputError-QplGPOt-.js";import"./InputLabel-B6zahXXt.js";import"./TextInput-ft9DeG-J.js";import"./PrimaryButton-Ck8UYHJn.js";function y({auth:e,mustVerifyEmail:m,status:r}){return s.jsxs(i,{user:e.user,header:s.jsx("h2",{className:"font-semibold text-xl text-gray-800 leading-tight",children:"Profile"}),children:[s.jsx(a,{title:"Profile"}),s.jsx("div",{className:"py-12",children:s.jsxs("div",{className:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6",children:[s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(l,{mustVerifyEmail:m,status:r,className:"max-w-xl"})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(t,{className:"max-w-xl"})}),e.user.user_type==="employee"&&s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(d,{className:"max-w-xl"})}),s.jsx("div",{className:"p-4 sm:p-8 bg-white shadow sm:rounded-lg",children:s.jsx(o,{className:"max-w-xl"})})]})})]})}export{y as default};