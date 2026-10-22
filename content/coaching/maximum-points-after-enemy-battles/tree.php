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
            'message' => "Read the problem statement above.\nAbsorb which enemies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All except the weakest', 'next' => 's2'],
                ['label' => 'All of them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You need the weakest to score: example 1 → 4 instead of 3.\nStep back to when you absorbed the weakest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Energy type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '32-bit', 'next' => 'wrong_b'],
                ['label' => '64-bit', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sum reaches about 10^14.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
