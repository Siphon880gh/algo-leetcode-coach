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
            'message' => "Read the problem statement above.\nPartners for peak j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest values on each side', 'next' => 's2'],
                ['label' => 'Its two neighbours', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Partners need not be adjacent; example 2 → 19 instead of 13.\nStep back to when you used neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Peak test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller or equal', 'next' => 'wrong_b'],
                ['label' => 'Both partners strictly smaller', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 2, 2] → 6 instead of −1.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 13, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
