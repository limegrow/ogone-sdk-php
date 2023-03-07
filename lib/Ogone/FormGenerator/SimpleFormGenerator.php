<?php

/*
 * This file is part of the Marlon Ogone package.
 *
 * (c) Marlon BVBA <info@marlon.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ogone\FormGenerator;

use Ogone\Ecommerce\EcommercePaymentRequest;

class SimpleFormGenerator implements FormGenerator
{
    /**
     * @deprecated
     * @var string|null
     */
    private ?string $formName = null;

    /**
     * @deprecated
     * @var string|null
     */
    private ?string $showSubmitButton = null;

    /**
     * @param EcommercePaymentRequest $ecommercePaymentRequest
     * @param string $formName
     * @param bool $showSubmitButton
     * @param string $textSubmitButton The text displayed on the submit button of the form. Defaults to "Submit"
     * @return string HTML
     */
    public function render(EcommercePaymentRequest $ecommercePaymentRequest, string $formName = 'ogone', bool $showSubmitButton = true, string $textSubmitButton = 'Submit'): string
    {
        $formName = null !== $this->formName??$formName;
        $showSubmitButton = null !== $this->showSubmitButton??$showSubmitButton;

        ob_start();
        include __DIR__.'/template/simpleForm.php';
        return ob_get_clean();
    }

    /**
     *@deprecated Will be removed in next major released, directly integrated in render method.
     */
    public function showSubmitButton(bool $bool = true)
    {
        $this->showSubmitButton = $bool;
    }

    /**
     * @deprecated Will be removed in next major released, directly integrated in render method.
     * @param $formName
     */
    public function setFormName($formName)
    {
        $this->formName = $formName;
    }
}
