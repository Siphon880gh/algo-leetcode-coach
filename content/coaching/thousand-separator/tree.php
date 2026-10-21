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
            'message' => "Read the problem statement above.\nGroup from which end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right', 'next' => 's2'],
                ['label' => 'Left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1234 would become 123.4.\nStep back to when you grouped from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Separator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Comma', 'next' => 'wrong_b'],
                ['label' => 'Dot', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement uses a dot.\nStep back to when you used a comma.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"0"', 'next' => 'success'],
                ['label' => '""', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero has one digit.\nStep back to when you returned empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 987 → \"987\". 1234 → \"1.234\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
