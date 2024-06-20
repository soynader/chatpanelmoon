<?php

declare(strict_types=1);

namespace MoonShine\Fields;

class Code extends Textarea
{
    protected string $view = 'moonshine::fields.code';

    public string $language = 'php';

    public bool $lineNumbers = false;

    public function language(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function lineNumbers(): static
    {
        $this->lineNumbers = true;

        return $this;
    }

    protected function resolvePreview(): string
    {
        return (string) str(parent::resolvePreview())
            ->before('<pre>')
            ->after('</pre>')
            ->stripTags();
    }
}
