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
            'message' => "Read the problem statement above.\nWhere to filter the year?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE, before grouping', 'next' => 's2'],
                ['label' => 'After MAX over all years', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. MAX would pick a 2021 login.\nStep back to when you filtered late.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Year bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '<= 2020-12-31', 'next' => 'wrong_b'],
                ['label' => '>= 2020-01-01 and < 2021-01-01', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Times later on Dec 31 would be excluded.\nStep back to when you used <= 2020-12-31.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Users with no 2020 login?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Omitted', 'next' => 'success'],
                ['label' => 'Shown with NULL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement excludes them.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → users 6, 8, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
