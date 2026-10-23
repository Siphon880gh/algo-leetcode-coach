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
            'message' => "Read the problem statement above.\nMerge order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every split with a subset DP', 'next' => 's2'],
                ['label' => 'Always merge the two shortest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): lists = [[0, 2], [0, 0, 1], [2]] → 13 instead of 12.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Median of an even list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The average of the two middle ones', 'next' => 'wrong_b'],
                ['label' => 'The left middle element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 11.5 instead of 10.\nStep back to when you averaged.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(3^k + 2^k · S log S). Examples → 18, 10, 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
