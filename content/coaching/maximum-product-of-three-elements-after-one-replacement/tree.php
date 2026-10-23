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
            'message' => "Read the problem statement above.\nReplacement value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '±10^5, sign chosen to make the product positive', 'next' => 's2'],
                ['label' => 'Always +10^5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 3500000.\nStep back to when you fixed the sign.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which two to keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two largest values', 'next' => 'wrong_b'],
                ['label' => 'The two largest absolute values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 200000 instead of 1200000.\nStep back to when you compared signed values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3500000, 1200000, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
