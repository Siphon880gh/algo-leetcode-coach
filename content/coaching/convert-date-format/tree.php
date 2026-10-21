<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: A table holds dates. Return each date as text in the format the statement specifies: full weekday name, full month name, day of month without a leading zero, and four-digit year, as in \"Tuesday, April 12, 2022\". For instance, 2021-08-09 → \"Monday, August 9, 2021\". (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWeekday specifier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '%W', 'next' => 's2'],
                ['label' => '%a', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. %a is the abbreviation.\nStep back to when you used %a.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Day specifier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '%d', 'next' => 'wrong_b'],
                ['label' => '%e', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. %d pads with a zero, giving 09.\nStep back to when you used %d.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Year specifier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '%Y', 'next' => 'success'],
                ['label' => '%y', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. %y gives two digits.\nStep back to when you used %y.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Constructed check → \"Tuesday, April 12, 2022\", \"Monday, August 9, 2021\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
