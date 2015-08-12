<?php
namespace PHPCrystal\PHPCrystal\Service\Metadriver;

use PHPCrystal\PHPCrystal\Annotation\Action as Action;
use PHPCrystal\PHPCrystal\Component\Exception\System\FrameworkRuntimeError;

class ExtendableAction extends AbstractExtendable
{
	/**
	 *
	 */
	public function __construct($baseClass, $extendedClass)
	{
		parent::__construct($baseClass, $extendedClass);
		$routeAnnot = $this->getRouteAnnotation();
		$routeAnnot->addPlaceholderAnnots($this->getRoutePlaceholderAnnots());
		$routeAnnot->setURIMatchRegExp($routeAnnot->convertMatchPatternToRegExp(
			$routeAnnot->getMatchPattern()));
	}

	/**
	 * @return \PHPCrystal\PHPCrystal\Annotation\Action\Route
	 */
	public function getRouteAnnotation()
	{
		foreach ($this->getAnnotations() as $annot) {
			if ($annot instanceof Action\Route) {
				return $annot;
			}
		}

		FrameworkRuntimeError::create('Action "%s" must have a routing rule', null,
			$this->getTargetClass())
			->_throw();
	}
	
	/**
	 * @return \PHPCrystal\PHPCrystal\Annotation\Action\RoutePlaceholder[]
	 */
	public function getRoutePlaceholderAnnots()
	{
		$result = [];

		foreach ($this->getAnnotations() as $annot) {
			if ($annot instanceof Action\RoutePlaceholder) {
				$result[] = $annot;
			}
		}

		return $result;
	}

	/**
	 * @return \PHPCrystal\PHPCrystal\Annotation\Action\ControllerMethod
	 */
	public function getControllerMethodAnnotation()
	{
		foreach ($this->getAnnotations() as $annot) {
			if ($annot instanceof Action\ControllerMethod) {
				return $annot;
			}
		}
	}

	public function getValidatorAnnot()
	{
		foreach ($this->getAnnotations() as $annot) {
			if ($annot instanceof Action\Validator) {
				return $annot;
			}
		}
	}

	public function getInputAnnot()
	{
		foreach ($this->getAnnotations() as $annot) {
			if ($annot instanceof Action\Input) {
				return $annot;
			}
		}
	}
}
