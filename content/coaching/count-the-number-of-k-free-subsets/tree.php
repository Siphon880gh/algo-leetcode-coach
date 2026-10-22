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
            'message' => "Problem: You get an array of integers and an integer k. A subset is k-free when no two of its elements differ by exactly k. Count the k-free subsets. Whether values can repeat, whether the empty subset counts, and the limits are in the official statement; the examples here have distinct values and count the empty subset. For instance, [5,4,6] with k = 1 → 5, and [2,3,5,8] with k = 5 → 12. (Restated from memory; limits and examples may differ slightly.)\nGroup values by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x mod k', 'next' => 's2'],
                ['label' => 'x div k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Values k apart land in different groups; [2,3,5,8] with k = 5 → 16 instead of 12.\nStep back to when you used division.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value exactly k above the previous?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'take = skip = take + skip', 'next' => 'wrong_b'],
                ['label' => 'take, skip = skip, take + skip', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows both values; [5,4,6] with k = 1 → 8 instead of 5.\nStep back to when you ignored the chain.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → 5, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
