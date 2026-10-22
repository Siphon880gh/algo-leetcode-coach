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
            'message' => "Read the problem statement above.\nThe parity of no visited value starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−∞', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Position 0 cannot be skipped; nums = [2, 3], x = 5 → 3 instead of 2.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extending from the other parity costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You would take everything; example 1 → 23 instead of 13.\nStep back to when you dropped x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), with 64-bit scores. Examples → 13, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
