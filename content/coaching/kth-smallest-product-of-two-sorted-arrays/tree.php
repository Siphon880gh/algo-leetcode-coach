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
            'message' => "Read the problem statement above.\nApproach for k up to 2.5 · 10^9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search on the product value', 'next' => 's2'],
                ['label' => 'Pop k products from a heap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. k can be billions, so popping one at a time is far too slow.\nStep back to when you used a heap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Counting b with a · b ≤ x when a < 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b ≤ floor(x / a)', 'next' => 'wrong_b'],
                ['label' => 'b ≥ ceil(x / a)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Dividing by a negative flips the inequality.\nStep back to when you kept ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "a = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of nums2 if x ≥ 0, else none', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero products count; Example 2 → 0 relies on them.\nStep back to when you skipped zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 8, 0, −6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
