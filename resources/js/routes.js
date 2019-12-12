
import Home from './components/home.vue';
import  NotFound from './components/not-found.vue';

const routes = 
[
{ 
    name:'home',
    path: '/',
    component: Home
},

{ 
    name:'*',
    path: '/404',
    component: NotFound
},

];

export default routes;







































