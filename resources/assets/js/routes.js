import Login from './components/Authentication/Login.vue';
import Register from './components/Authentication/Register.vue';
import RegisterAdmin from './components/Authentication/RegisterAdmin.vue';
import Home from './components/Home.vue';
import Servicing from './components/Billing/Servicing.vue';
import SparePart from './components/Billing/SparePart.vue';
import CounterSale from './components/Billing/CounterSale.vue';

export const routes = [
{path: '/',redirect: '/login'    },
{path: '/login',component: Login    },
{path: '/register',  component: Register    },
{path: '/registerAdmin',name: 'registerAdmin',component: RegisterAdmin,props: true    },
{path: '/home',  component: Home    },
{path: '/servicing', component: Servicing    },
{path: '/spare-part',component: SparePart},
{path: '/counter-sale',component: CounterSale},
{ name: 'createusers', path: '/createusers', component: require('./components/User/Create.vue') },
{ name: 'editusers', path: '/editusers', component: require('./components/User/Edit.vue') },
{ name: 'Attendance', path: '/Attendance', component: require('./components/User/Attendance.vue') },
{ name: 'Report', path: '/Report', component: require('./components/User/EmployeeReport.vue') },
{ name: 'Advance', path: '/Advance', component: require('./components/User/Advance.vue') },
{ name: 'Addtnpayment', path: '/Addtnpayment', component: require('./components/User/Addtnpayment.vue') },
{ name: 'calendar', path: '/calendar', component: require('./components/Calendar.vue') },
{ path: '/*', redirect: '/home'},
];
