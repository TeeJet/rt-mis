<?php


namespace classes\calculator;


interface CommandInterface
{
    public function execute(): string;
}