<?php

namespace Betta\Filament\FqnSettings\Enums;

enum SchemaAs: string
{
    case Section = 'section';
    case Tabs = 'tabs';
    case Group = 'group';
    case Fieldset = 'fieldset';
    case Array = 'array';
}
