<?php
namespace Fbreuer\MetinCms\ViewHelpers;
/*
 * This file belongs to the package "TYPO3 Fluid".
 * See LICENSE.txt that was shipped with this package.
 */
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class TestViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * @var boolean
     */
    protected $escapeOutput = FALSE;
    /**
     * @return void
     */
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('map', 'array', 'Array that specifies which variables should be mapped to which alias', TRUE);
    }
    /**
     * Renders alias
     *
     * @return string Rendered string
     * @api
     */
    public function render() {
        $map = $this->arguments['map'];
        foreach ($map as $aliasName => $value) {
            $this->templateVariableContainer->add($aliasName, $value);
        }
        $output = $this->renderChildren();
        foreach ($map as $aliasName => $value) {
            $this->templateVariableContainer->remove($aliasName);
        }
        return $output;
    }
}