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
            'message' => "Read the problem statement above.\nInitial f?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−∞', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Stages can be skipped: example 2 → 10 instead of −1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update j in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 up to 3', 'next' => 'wrong_b'],
                ['label' => '3 down to 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One b value fills several stages: example 1 → 64 instead of 26.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 26, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
