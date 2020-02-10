
import LandingPage from './components/landing-page.vue';
import  NotFound from './components/not-found.vue';
import History from './components/history.vue';
import EditArrived from './components/modals/edit-arrived.vue';
import EditEvacuated from './components/modals/edit-evacuated.vue';
import Register from './components/modals/register.vue';
import Login from './components/modals/login.vue';
import UserProfile from './components/user-profile.vue';

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
	name: 'edit-arrived',
	path: '/history/edit-arrived/:id',
	component: EditArrived
},

{
    name: 'edit-evacuated',
    path: '/history/edit-evacuated/:id',
    component: EditEvacuated
},

{ 
    name:'*',
    path: '/404',
    component: NotFound
},

{ 
    name:'user-profile',
    path: 'user',
    component: UserProfile
},

];

export default routes;







































