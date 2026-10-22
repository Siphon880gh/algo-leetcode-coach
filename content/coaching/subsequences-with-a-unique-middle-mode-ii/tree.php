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
            'message' => "Problem: Same counting as part I: count the length-5 subsequences of nums whose middle element is the only most frequent value, modulo 10^9 + 7. This version allows a much longer array. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOther values per middle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the running sums', 'next' => 's2'],
                ['label' => 'Loop over them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is part I’s O(n · D), which the guide assumes is too slow here.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle value’s own term?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it in', 'next' => 'wrong_b'],
                ['label' => 'Remove it from the sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 0, 3, 1, 0, 1, 0] → 1 instead of 6.\nStep back to when you left it in.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 6, 4, 0, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
