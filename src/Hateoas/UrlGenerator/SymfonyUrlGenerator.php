<?php

namespace Hateoas\UrlGenerator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as SymfonyUrlGeneratorInterface;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class SymfonyUrlGenerator implements UrlGeneratorInterface
{
    /**
     * @var SymfonyUrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var Request
     */
    private $request;


    public function __construct(SymfonyUrlGeneratorInterface $urlGenerator, Request $request = null)
    {
        $this->urlGenerator = $urlGenerator;
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, array $parameters, $absolute = false)
    {
        if($this->request instanceof Request) {
            $parameters['version'] = $this->request->get('version');
            $parameters['_format'] = $this->request->getRequestFormat();
        }

        return $this->urlGenerator->generate($name, $parameters, $absolute);
    }
}
