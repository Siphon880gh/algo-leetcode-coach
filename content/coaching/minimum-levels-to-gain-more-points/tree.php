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
            'message' => "Read the problem statement above.\nFailed level scores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 's2'],
                ['label' => '0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 1.\nStep back to when you scored failures 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last level Alice may stop at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1', 'next' => 'wrong_b'],
                ['label' => 'n − 2 (Bob plays one)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1] → 2 instead of −1.\nStep back to when Alice played everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
