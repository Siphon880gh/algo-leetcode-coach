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
            'message' => "Problem: nums holds only the values 1, 2 and 3, and locked is a 0/1 array of the same length. Neighbors i and i + 1 may be swapped when nums[i] is exactly one more than nums[i + 1] and index i is unlocked; unlocking an index costs one operation. Return the fewest unlocks that let nums be sorted, or −1 if that is impossible. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nA 3 before a 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Count the spans anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 1] with [1, 1] → 0 instead of −1.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Unlock where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only out-of-order neighbors', 'next' => 'wrong_b'],
                ['label' => '[first 2, last 1) and [first 3, last 2)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 2, 1] with [1, 1, 0] → 1 instead of 2.\nStep back to when you used neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 1, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
