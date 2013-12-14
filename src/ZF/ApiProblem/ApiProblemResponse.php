<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ApiProblem;

use Zend\Http\Response;

/**
 * Represents an ApiProblem response payload
 */
class ApiProblemResponse extends Response
{
    protected $apiProblem;

    /**
     * @param ApiProblem $apiProblem
     */
    public function __construct(ApiProblem $apiProblem)
    {
        $this->apiProblem = $apiProblem;
        $this->setStatusCode($apiProblem->httpStatus);
        $this->setReasonPhrase($apiProblem->title);
    }

    /**
     * @return ApiProblem
     */
    public function getApiProblem()
    {
        return $this->apiProblem;
    }

    /**
     * Retrieve the content
     *
     * Serializes the composed ApiProblem instance to JSON.
     *
     * @return string
     */
    public function getContent()
    {
        return json_encode($this->apiProblem->toArray());
    }

    /**
     * Retrieve headers
     *
     * Proxies to parent class, but then checks if we have an content-type 
     * header; if not, sets it, with a value of "application/api-problem+json".
     *
     * @return \Zend\Http\Headers
     */
    public function getHeaders()
    {
        $headers = parent::getHeaders();
        if (!$headers->has('content-type')) {
            $headers->addHeaderLine('content-type', 'application/api-problem+json');
        }
        return $headers;
    }
}
