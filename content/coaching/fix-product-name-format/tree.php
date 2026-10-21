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
            'message' => "Problem: A sales table has inconsistently typed product names and sale dates. Report per normalised name and month how many sales occurred, with formats and ordering as the statement specifies. For instance, \"  LCPhone\" and \"lcphone \" are the same product. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nGroup on the raw name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: normalise first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Case and spaces would split one product.\nStep back to when you grouped raw names.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "TRIM alone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'TRIM only', 'next' => 'wrong_b'],
                ['label' => 'TRIM and LOWER', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Mixed case still splits groups.\nStep back to when you skipped LOWER.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Date grouping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Year-month format', 'next' => 'success'],
                ['label' => 'Full date', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The report is per month.\nStep back to when you grouped by day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One grouped query on cleaned expressions.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
