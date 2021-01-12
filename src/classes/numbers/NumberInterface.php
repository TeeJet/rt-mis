<?php

namespace classes\numbers;

interface NumberInterface
{
    public function getValue();

    public function getTextValue(): string;

    public function getSize(): int;
}