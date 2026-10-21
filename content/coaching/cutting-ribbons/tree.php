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
            'message' => "Problem: Given ribbon lengths and an integer k, cut the ribbons into pieces so that at least k pieces share the same positive integer length x (leftover pieces may be discarded, as the statement allows). Return the largest such x, or 0 if no positive length works. For instance, [9,7,5] with k = 3 → 5, [7,5,9] with k = 4 → 4, and [5,7,9] with k = 22 → 0. (Restated from memory; limits and examples may differ slightly.)\nSearch range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[0, max(ribbons)]', 'next' => 's2'],
                ['label' => '[1, min(ribbons)]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Short ribbons can be discarded, so x may exceed the minimum.\nStep back to when you capped at the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Middle choice when lo = mid on success?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lower mid', 'next' => 'wrong_b'],
                ['label' => 'Upper mid: (lo + hi + 1) // 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With lo = mid, a lower mid can loop forever.\nStep back to when you used the lower mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No length works?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return −1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement expects 0.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Constructed check → 5, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
