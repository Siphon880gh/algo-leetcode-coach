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
            'message' => "Read the problem statement above.\nΣ nums < 2k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Use the formula anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Both sides can be small at once, so the formula subtracts too much; [1,1], k = 2 → 10^9 + 5 instead of 0.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtract the small subsets how many times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once', 'next' => 'wrong_b'],
                ['label' => 'Twice', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The groups are ordered, so a small subset can be either group; Example 1 → 11 instead of 6.\nStep back to when you subtracted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Examples → 6, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
