import { Button, Divider, Form, Input, Typography } from 'antd';
import React, { useEffect, useState } from 'react';
import AuthLayout from './AuthLayout';
import axios from 'axios';
import Routes from '../../../common/helpers/Routes';
import Utils from '../../../common/helpers/Utils';
import { Link, useHistory } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { setGlobalState } from '../../redux/ActionCreators';
import {AiOutlineUser} from 'react-icons/ai';
import {BsShieldLock} from 'react-icons/bs';

const Login = () => {
    const [loading, setLoading] = useState(false);
    const dispatch = useDispatch();
    let history = useHistory();
    const globalState = useSelector(state => state.globalState);
    const siteName = globalState.siteName;
    const apiToken = globalState.apiToken;

    useEffect(() => {
        document.title = `Login - ${siteName}`;
    }, [])

    useEffect(() => {
        if (apiToken) {
            let { from } = location.state || { from: { pathname: Routes.web.admin.dashboard } };
            history.push(from);
        }
    }, [apiToken]);

    const onSubmit = (values) => {
        setLoading(true);
        
        axios.post(Routes.api.admin.login, {
            email: values.email,
            password: values.password,
        })
        .then(response => {
            Utils.handleSuccessResponse(response, () => {
                const apiToken = response.data.payload.token.access_token;

                localStorage.setItem('apiToken', apiToken);

                dispatch(setGlobalState({
                    ...globalState,
                    apiToken: apiToken,
                    user: response.data.payload.user,
                }));
            });
        })
        .catch((error) => {
            Utils.handleException(error);
        }).finally(() => {
            setLoading(false);
        });
    };

    return (
        <React.Fragment>
            <AuthLayout title={'ADMIN LOGIN'}>
                <Form
                    name="login"
                    onFinish={onSubmit}
                >
                    <Form.Item
                        name="email"
                        messageVariables={{ label: 'Email' }}
                        rules={[
                            {
                                required: true,
                                message: 'Please enter your email'
                            },
                            {
                                type: 'email',
                                message: 'Invalid email address'
                            }
                        ]}
                    >
                        <Input prefix={<AiOutlineUser/>} placeholder="Email" />
                    </Form.Item>
                    <Form.Item
                        name="password"
                        messageVariables={{ label: 'Password' }}
                        rules={[
                            {
                                required: true,
                                message: 'Please enter your password'
                            }
                        ]}
                    >
                        <Input.Password
                            prefix={<BsShieldLock/>}
                            placeholder="Password"
                        />
                    </Form.Item>
                    <Form.Item>
                        <Button type="primary" htmlType="submit" block loading={loading}>
                            Log in
                        </Button>
                    </Form.Item>
                    <Divider style={{marginBottom: '5px'}}/>
                    <Form.Item className="text-center">
                        <Link to={Routes.web.admin.forgetPassword}>
                            <Typography.Text type="secondary">Forgot password?</Typography.Text>
                        </Link>
                    </Form.Item>
                </Form>
            </AuthLayout>
        </React.Fragment>
    )
}

export default Login;