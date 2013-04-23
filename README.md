MisdMockRavenServiceBundle
===============

[![Build Status](https://travis-ci.org/misd-service-development/mock-raven-service-bundle.png?branch=master)](http://travis-ci.org/misd-service-development/mock-raven-service-bundle)

Provides a controller replicating the Raven service, allow applications to functionally test the logging in process.

Authors
-------

* Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>

Requirements
------------

* [Symfony 2](http://symfony.com/)
* [PHP OpenSSL library](http://www.php.net/manual/en/book.openssl.php)

Installation
------------

 1. Add the bundle to your dev dependencies:

        // composer.json

        {
           // ...
           "require-dev": {
               // ...
               "misd/raven-bundle": "~1.0@dev"
           }
        }

 2. Use Composer to download and install the bundle:

        $ php composer.phar update misd/mock-raven-service-bundle

 3. Register the bundle in your application's test environment:

        // app/AppKernel.php

        class AppKernel extends Kernel
        {
            // ...
            public function registerBundles()
            {
                // ...
                if ('test' === $this->getEnvironment()) {
                    $bundles[] = new Misd\MockRavenServiceBundle\MisdMockRavenServiceBundle();
                }
                // ...
            }
            // ...
        }

 4. Add the bundle's routes to your test routing config:

        // app/routing_test.yml

        MisdMockRavenServiceBundle:
            resource: .
            type: extra

 5. Make sure that the mock Raven service path is unsecured:

        // app/security.yml

        mock_raven_service:
            pattern: ^/auth/authenticate.html
            security: false

If you are using the [misd/raven-bundle](https://github.com/misd-service-development/raven-bundle) make sure that your test environment is using the Raven test service:

    // app/config_test.yml

    misd_raven:
        use_test_service: true

Usage
-----

The bundle, by default, will see a user logged in to Raven with the CRSid 'test0001'.

For example, in a test case extending `Symfony\Bundle\FrameworkBundle\Test\WebTestCase` running:

    $client = static::createClient();
    $client->followRedirects();
    $client->request('GET', '/secured-page');

will see a successful Raven login response returned. If you are using the [misd/raven-bundle](https://github.com/misd-service-development/raven-bundle) the Raven response will have been processed for you.

### Customising the Raven service response

Set the `next_wls_response` session attribute with an instance of `Misd\MockRavenServiceBundle\WlsResponse\WlsResponseInterface` before making a request allows you to control what response the mock Raven service returns. For example:

    use Misd\MockRavenServiceBundle\WlsResponse\AuthenticationCancelledWlsResponse;

    $client = static::createClient();
    $client->followRedirects();
    $client->getContainer()->get('session')->set('next_wls_response', new AuthenticationCancelledWlsResponse());
    $client->request('GET', '/secured_path');

Available implementations are:

`Misd\MockRavenServiceBundle\WlsResponse\AuthenticationCancelled`
:   A '410 The user cancelled the authentication request' response.

`Misd\MockRavenServiceBundle\WlsResponse\AuthenticationDeclined`
:   A '570 Authentication declined' response.

`Misd\MockRavenServiceBundle\WlsResponse\GeneralRequestParameterError`
:   A '530 General request parameter error' response.

`Misd\MockRavenServiceBundle\WlsResponse\InteractionWouldBeRequired`
:   A '540 Interaction would be required' response.

`Misd\MockRavenServiceBundle\WlsResponse\NoMutuallyAcceptableAuthenticationTypesAvailable`
:   A '510 No mutually acceptable authentication types available' response.

`Misd\MockRavenServiceBundle\WlsResponse\SuccessfulAuthentication`
:   A '200 Successful authentication' response.

`Misd\MockRavenServiceBundle\WlsResponse\UnsupportedProtocolVersion`
:   A '520 Unsupported protocol version' response.

`Misd\MockRavenServiceBundle\WlsResponse\WaaNotAuthorised`
:   A '560 WAA not authorised' response.

There are also implementations that indicate broken responses:

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\Expired`
:   A response with an expired issue date

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\Incomplete`
:   An incomplete response.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\Invalid`
:   An invalid response.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\UndefinedStatusCode`
:   A response with an invalid status code.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\WrongAuth`
:   A response with an invalid 'auth' parameter.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\WrongKid`
:   A response with an invalid 'kid' parameter.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\WrongSso`
:   A response with an invalid 'sso' parameter.

`Misd\MockRavenServiceBundle\WlsResponse\Invalid\WrongUrl`
:   A response with a different URL.
