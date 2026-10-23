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
            'message' => "Read the problem statement above.\nCost to match two letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(d, 26 − d)', 'next' => 's2'],
                ['label' => '|a − b|', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 3 instead of 6.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends affordable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always pay to match them', 'next' => 'wrong_b'],
                ['label' => 'Also try skipping either end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. czcba, k = 2 → 3 instead of 4.\nStep back to when you always matched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · k). Examples → 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
