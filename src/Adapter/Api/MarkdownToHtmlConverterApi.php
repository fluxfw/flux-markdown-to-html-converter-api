<?php

namespace FluxMarkdownToHtmlConverterApi\Adapter\Api;

use FluxMarkdownToHtmlConverterApi\Adapter\Html\HtmlDto;
use FluxMarkdownToHtmlConverterApi\Adapter\Markdown\MarkdownDto;
use FluxMarkdownToHtmlConverterApi\Service\Converter\Port\ConverterService;

class MarkdownToHtmlConverterApi
{

    private function __construct(
        private readonly MarkdownToHtmlConverterApiConfigDto $markdown_to_html_converter_api_config
    ) {

    }


    public static function new(
        ?MarkdownToHtmlConverterApiConfigDto $markdown_to_html_converter_api_config = null
    ) : static {
        return new static(
            $markdown_to_html_converter_api_config ?? MarkdownToHtmlConverterApiConfigDto::newFromEnv()
        );
    }


    public function convert(MarkdownDto $markdown) : HtmlDto
    {
        return $this->getConverterService()
            ->convert(
                $markdown
            );
    }


    /**
     * @param MarkdownDto[] $markdowns
     *
     * @return HtmlDto[]
     */
    public function convertMultiple(array $markdowns) : array
    {
        return $this->getConverterService()
            ->convertMultiple(
                $markdowns
            );
    }


    private function getConverterService() : ConverterService
    {
        return ConverterService::new(
            $this->markdown_to_html_converter_api_config->color_config
        );
    }
}
