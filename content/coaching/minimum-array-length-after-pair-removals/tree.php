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
            'message' => "Read the problem statement above.\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Depends on the most frequent value', 'next' => 's2'],
                ['label' => 'Always n mod 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Equal values cannot pair; example 3 → 0 instead of 2.\nStep back to when you ignored counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "2f > n leaves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f', 'next' => 'wrong_b'],
                ['label' => '2f − n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Other values remove some copies; example 4 → 3 instead of 1.\nStep back to when you returned f.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 0, 0, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
