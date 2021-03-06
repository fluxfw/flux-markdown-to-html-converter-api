<?php

namespace FluxMarkdownToHtmlConverterApi\Service\Converter\Command;

use FluxMarkdownToHtmlConverterApi\Adapter\Color\ColorConfigDto;
use FluxMarkdownToHtmlConverterApi\Adapter\Html\HtmlDto;
use FluxMarkdownToHtmlConverterApi\Adapter\Markdown\MarkdownDto;
use FluxMarkdownToHtmlConverterApi\Service\Converter\Converter\CustomConverter;

class ConvertCommand
{

    private function __construct(
        private readonly ColorConfigDto $color_config
    ) {

    }


    public static function new(
        ColorConfigDto $color_config
    ) : static {
        return new static(
            $color_config
        );
    }


    public function convert(MarkdownDto $markdown) : HtmlDto
    {
        return HtmlDto::new(
            CustomConverter::new(
                $this->color_config
            )
                ->convert($markdown->markdown)->getContent()
        );
    }


    /**
     * @param MarkdownDto[] $markdowns
     *
     * @return HtmlDto[]
     */
    public function convertMultiple(array $markdowns) : array
    {
        $htmls = [];

        foreach ($markdowns as $id => $markdown) {
            $htmls[$id] = $this->convert(
                $markdown
            );
        }

        return $htmls;
    }
}
