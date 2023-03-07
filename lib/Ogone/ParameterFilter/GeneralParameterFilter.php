<?php

/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\ParameterFilter;

class GeneralParameterFilter implements ParameterFilter
{
    public function filter(array $parameters): array
    {
        $parameters = array_change_key_case($parameters, CASE_UPPER);
        array_walk($parameters, 'trim');
        return array_filter($parameters, fn($value) => (bool) strlen((string) $value));
    }
}
