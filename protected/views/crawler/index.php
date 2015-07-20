<?php
foreach($html->find('p.date-time') as $element)
       echo $element->outertext. '<br>';

