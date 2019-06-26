import React, { PropTypes } from 'react'
import { Link } from 'react-router'

const displayName = 'Register From'

const propTypes = {
    email: PropTypes.string.isRequired,
    passwrod: PropTypes.string.isRequired,
    onChange: PropTypes.func.isRequired,
    onSubmit: PropTypes.func.isRequired,
}

const Form = ({ email, password, onChange, onSubmit }) => {
    return (<form className="form-horizontal" role="form" onSubmit={onSubmit}>
        <div className="form-group">
            <label htmlFor="email" className="col-md-4 control-label">E-Mail Address</label>

            <div className="col-md-6">
                <input id="email"
                       type="email"
                       className="form-control"
                       name="email"
                       value={email}
                       onChange={e => onChange({ name: e.target.name, value: e.target.value })}
                       required={true}/>

            </div>
        </div>

        <div className="form-group">
            <label htmlFor="password" className="col-md-4 control-label">Password</label>

            <div className="col-md-6">
                <input id="password"
                       type="password"
                       className="form-control"
                       name="password"
                       value={password}
                       onChange={e => onChange({ name: e.target.name, value: e.target.value })}
                       required/>

            </div>
        </div>

        <div className="form-group">
            <div className="col-md-6 col-md-offset-4">
                <button type="submit" className="btn btn-primary">
                  Login
                </button>
                <a className="btn btn-link" href="/password/reset">
                    Forgot Your Password?
                </a>
                <Link to="/register" className="btn btn-link" >Sign up</Link>
            </div>
        </div>
    </form>)
}

Form.displayName = displayName

export default Form
