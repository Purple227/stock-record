
import LandingPage from './components/landing-page.vue';
import  NotFound from './components/not-found.vue';
import History from './components/history.vue';
//import EditArrived from './components/modals/edit-arrived.vue';
import EditEvacuated from './components/modals/edit-evacuated.vue';
import UserProfile from './components/user-profile.vue';
import UserUpdate from './components/modals/update-profile.vue';
import About from './components/about.vue';


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
    name:'about',
    path: 'about',
    component: About
},

/*{
	name: 'edit-arrived',
	path: '/history/edit-arrived/:id',
	component: EditArrived
},*/

{
    name: 'edit-evacuated',
    path: '/history/edit-evacuated/:id',
    component: EditEvacuated
},

{ 
    name:'user-profile',
    path: 'user-profile',
    component: UserProfile
},

{ 
    name:'user-update',
    path: 'user-update',
    component: UserUpdate
},

{ 
    name:'*',
    path: '404',
    component: NotFound
},

];

export default routes;







































