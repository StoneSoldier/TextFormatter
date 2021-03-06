<?php

/**
* @package   s9e\TextFormatter
* @copyright Copyright (c) 2010-2017 The s9e Authors
* @license   http://www.opensource.org/licenses/mit-license.php The MIT License
*/
namespace s9e\TextFormatter\Configurator\RulesGenerators;

use s9e\TextFormatter\Configurator\Helpers\TemplateInspector;
use s9e\TextFormatter\Configurator\RulesGenerators\Interfaces\BooleanRulesGenerator;
use s9e\TextFormatter\Configurator\RulesGenerators\Interfaces\TargetedRulesGenerator;

class EnforceContentModels implements BooleanRulesGenerator, TargetedRulesGenerator
{
	/**
	* @var TemplateInspector
	*/
	protected $br;

	/**
	* @var TemplateInspector
	*/
	protected $span;

	/**
	* Constructor
	*
	* Prepares the TemplateInspector for <br/> and <span>
	*/
	public function __construct()
	{
		$this->br   = new TemplateInspector('<br/>');
		$this->span = new TemplateInspector('<span><xsl:apply-templates/></span>');
	}

	/**
	* {@inheritdoc}
	*/
	public function generateBooleanRules(TemplateInspector $src)
	{
		$rules = [];
		if ($src->isTransparent())
		{
			$rules['isTransparent'] = true;
		}
		if (!$src->allowsChild($this->br))
		{
			$rules['preventLineBreaks'] = true;
			$rules['suspendAutoLineBreaks'] = true;
		}
		if (!$src->allowsDescendant($this->br))
		{
			$rules['disableAutoLineBreaks'] = true;
			$rules['preventLineBreaks'] = true;
		}

		return $rules;
	}

	/**
	* {@inheritdoc}
	*/
	public function generateTargetedRules(TemplateInspector $src, TemplateInspector $trg)
	{
		// Use span's content model if the source template is an iframe to allow fallback content
		if ($src->isIframe())
		{
			$src = $this->span;
		}

		$rules = [];
		if (!$src->allowsChild($trg))
		{
			$rules[] = 'denyChild';
		}
		if (!$src->allowsDescendant($trg))
		{
			$rules[] = 'denyDescendant';
		}

		return $rules;
	}
}