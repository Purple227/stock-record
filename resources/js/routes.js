
import LandingPage from './components/landing-page.vue';
import  NotFound from './components/not-found.vue';

const routes = 
[
{ 
    name:'home',
    path: '/',
    component: LandingPage
},

{ 
    name:'*',
    path: '/404',
    component: NotFound
},

];

export default routes;







































