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
            'message' => "Read the problem statement above.\nUnreachable indices start at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−∞', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Paths could start anywhere; [4, 0, −2] with target 2 → 1 instead of −1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A jump i → j is allowed when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[j] − nums[i] ≤ target', 'next' => 'wrong_b'],
                ['label' => '|nums[j] − nums[i]| ≤ target', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Big drops slip through; example 1 → 4 instead of 3.\nStep back to when you dropped the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 5, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
