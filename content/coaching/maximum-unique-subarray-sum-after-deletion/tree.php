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
            'message' => "Read the problem statement above.\nNothing positive?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the largest element', 'next' => 's2'],
                ['label' => 'Return 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [−3, −1] → 0 instead of −1; the array cannot be empty.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All distinct values', 'next' => 'wrong_b'],
                ['label' => 'Distinct positives', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 0 instead of 3.\nStep back to when you kept negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 15, 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
