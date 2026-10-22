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
            'message' => "Read the problem statement above.\nKeep which block?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The most frequent', 'next' => 's2'],
                ['label' => 'The first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abcdcd with k = 2 → 2 instead of 1.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct blocks − 1', 'next' => 'wrong_b'],
                ['label' => 'Blocks − largest count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each differing copy needs its own operation: example 2 → 2 instead of 3.\nStep back to when you counted distinct blocks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
