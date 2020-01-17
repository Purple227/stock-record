
import LandingPage from './components/landing-page.vue';
import  NotFound from './components/not-found.vue';
import History from './components/history.vue';

const routes = 
[
{ 
    name:'home',
    path: '/',
    component: LandingPage
},

{ 
    name:'history',
    path: 'history',
    component: History
},

{ 
    name:'*',
    path: '/404',
    component: NotFound
},

];

export default routes;







































