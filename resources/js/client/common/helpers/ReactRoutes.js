
import loadable from '@loadable/component';
import Routes from './Routes';
import { useSelector } from 'react-redux';
import { Redirect } from 'react-router';
import React from 'react';

const Login = loadable(() => import('../../admin/components/auth/Login'));
const Logout = loadable(() => import('../../admin/components/auth/Logout'));
const ForgetPassword = loadable(() => import('../../admin/components/auth/ForgetPassword'));
const ResetPassword = loadable(() => import('../../admin/components/auth/ResetPassword'));
const Dashboard = loadable(() => import('../../admin/components/dashboard/Dashboard'));
const Settings = loadable(() => import('../../admin/components/settings/Settings'));
const PortfolioConfig = loadable(() => import('../../admin/components/portfolioConfig/PortfolioConfig'));
const About = loadable(() => import('../../admin/components/about/About'));
const EducationList = loadable(() => import('../../admin/components/education/EducationList'));

const RedirectLogin = () => {
    const apiToken = useSelector(state => state.globalState.apiToken);
    
    return (
        <React.Fragment>
            <Redirect
                to={apiToken ? Routes.web.admin.dashboard : Routes.web.admin.login}
            />
        </React.Fragment>
    )
}

const admin = [
    {
        title: 'Login',
        path: Routes.web.admin.login,
        exact: true,
        component: Login,
        private: false
    },
    {
        title: 'Logout',
        path: Routes.web.admin.logout,
        exact: true,
        component: Logout,
        private: true
    },
    {
        title: 'Forget Password',
        path: Routes.web.admin.forgetPassword,
        exact: true,
        component: ForgetPassword,
        private: false
    },
    {
        title: 'Reset Password',
        path: Routes.web.admin.resetPassword,
        exact: true,
        component: ResetPassword,
        private: false
    },
    {
        title: 'Admin',
        path: Routes.web.admin.admin,
        exact: true,
        component: RedirectLogin,
        private: false
    },
    {
        title: 'Dashboard',
        path: Routes.web.admin.dashboard,
        exact: true,
        component: Dashboard,
        private: true
    },
    {
        title: 'Settings',
        path: Routes.web.admin.settings,
        exact: true,
        component: Settings,
        private: true
    },
    {
        title: 'PortfolioConfig',
        path: Routes.web.admin.portfolioConfig,
        exact: true,
        component: PortfolioConfig,
        private: true
    },
    {
        title: 'PortfolioAbout',
        path: Routes.web.admin.portfolioAbout,
        exact: true,
        component: About,
        private: true
    },
    {
        title: 'portfolioEducation',
        path: Routes.web.admin.portfolioEducation,
        exact: true,
        component: EducationList,
        private: true
    },
]



const ReactRoutes = {
    admin
};

export default ReactRoutes;