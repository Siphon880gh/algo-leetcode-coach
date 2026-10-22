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
            'message' => "Problem: Given an integer array, a subarray is semi-decreasing when its first element is strictly greater than its last. Return the length of the longest semi-decreasing subarray. What to return when none exists, and the limits, are in the official statement. For instance, [7, 6, 5, 4, 3, 2, 1, 6, 10, 11] → 8 and [5, 1, 5] → 2. (Restated from memory; limits and examples may differ slightly.)\nWhen do equal values join the seen set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After their whole group is scanned', 'next' => 's2'],
                ['label' => 'Immediately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first element must be strictly larger; [5, 1, 5] → 3 instead of 2.\nStep back to when you added each index at once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Track which seen index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 'wrong_b'],
                ['label' => 'The smallest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The start should be as far left as possible; [7, 6, 5, 4, 3, 2, 1, 6, 10, 11] → 0 instead of 8.\nStep back to when you kept the largest index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [7, 6, 5, 4, 3, 2, 1, 6, 10, 11] → 8, [5, 1, 5] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
