<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('../../../../public/sso/lib/_autoload.php');

class SSO
{
    private $as;

    public function require_auth()
    {
        $this->as = new SimpleSAML_Auth_Simple('default-sp');
        $this->as->requireAuth();

        $this->as->login(array(
            'saml:idp' => 'https://idp.example.org/',
        ));
    }
}
