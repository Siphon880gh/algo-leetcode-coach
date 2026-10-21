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
            'message' => "Read the problem statement above.\nDuplicates like 2/4?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip: gcd > 1', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2/4 equals 1/2.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Dedupe by float?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: gcd is exact', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Floats are fragile, and gcd already guarantees uniqueness.\nStep back to when you used floats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty list', 'next' => 'success'],
                ['label' => '["1/1"]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Values must be strictly between 0 and 1.\nStep back to when you added 1/1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n = 3 → [\"1/2\",\"1/3\",\"2/3\"]. n = 4 → adds \"1/4\",\"3/4\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
