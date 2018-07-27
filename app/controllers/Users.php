<?php

class Users extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = $this->model('User');
    }

    /**
     * Creates a new user account
     * @return void
     */
    public function createAccount()
    {
        // Set default values for template
        $this->varsToPass->params = [
            'first-name' => '',
            'last-name' => '',
            'email-address' => ''
        ];

        if (Request::isPost()) {
            // Sanitize form input
            $params = Validator::filterPostForm($_POST);

            // Send values back to the view
            $this->varsToPass->params = $params;

            // Check to make sure all fields are filled out
            if (empty($params['first-name'])) {
                $this->varsToPass->firstNameError = 'Please enter a first name.';
            }
    
            if (empty($params['last-name'])) {
                $this->varsToPass->lastNameError = 'Please enter a last name.';
            }
    
            if (empty($params['email-address'])) {
                $this->varsToPass->emailEmptyError = 'Please enter an email address.';
            }
    
            if (empty($params['password']) || empty($params['retype-password'])) {
                $this->varsToPass->passwordError = 'Please enter a password.';
            }

            // Make sure nothing is empty before continuing
            if (Validator::notEmpty($params)) {
                // Check to make sure email address is available
                if ($this->model->isEmailAvailable($params['email-address']) &&
                filter_var($params['email-address'], FILTER_VALIDATE_EMAIL)) {
                    // Sanitize email address
                    $params['email-address'] = filter_var($params['email-address'], FILTER_SANITIZE_EMAIL);

                    // Capitalize names
                    $params['first-name'] = ucwords($params['first-name']);
                    $params['last-name'] = ucwords($params['last-name']);

                    if ($params['password'] !== $params['retype-password']) {
                        $this->varsToPass->passwordMismatch = 'The passwords do not match.';
                        $this->varsToPass->params = $params;
                        $this->view('users/createaccount');

                        return;
                    }

                    // Hash password
                    $params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);
    
                    // Insert user
                    $this->model->register($params);
    
                    // Send them to the home page
                    $this->redirect();
                } else {
                    // If email validation fails, display error
                    $this->varsToPass->emailError = 'This email address is taken. Please try another.';
                    $this->varsToPass->params = $params;
                    $this->view('users/createaccount');
    
                    return;
                }
            }
        }

        $this->view('users/createaccount');
    }

    /**
     * Logs user in, sets Session information
     * @return void
     */
    public function login()
    {
        // Set default values for template
        $this->varsToPass->params = [
            'email-address' => '',
            'password' => ''
        ];

        if (Request::isPost()) {
            $params = Validator::filterPostForm($_POST);

            // Send values back to the view
            $this->varsToPass->params = $params;
            
            // Get user
            $user = $this->model->login($params['email-address'], $params['password']);

            // Make sure information is filled out
            if (empty($params['email-address'])) {
                $this->varsToPass->emailEmptyError = 'Please enter an email address.';
            }
    
            if (empty($params['password'])) {
                $this->varsToPass->passwordError = 'Please enter a password.';
            }
            
            // Make sure nothing is empty before continuing
            if (Validator::notEmpty($params)) {
                if ($user) {
                    // Log user in and redirect to home page
                    parent::beginSession($user);
                } else {
                    $this->redirect('users/login');
                }
            }
        }

        $this->view('users/login');
    }

    /**
     * Logs user out
     * @return void
     */
    public function logout()
    {
        session_unset();
        session_destroy();

        $this->redirect();
    }

    /**
     * User settings page
     * @return void
     */
    public function settings()
    {
        $this->view('users/settings');
    }
}