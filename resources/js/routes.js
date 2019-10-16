import ExampleComponent from './components/ExampleComponent.vue';

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            name: 'home',
            component: ExampleComponent
        }
    ],
};
