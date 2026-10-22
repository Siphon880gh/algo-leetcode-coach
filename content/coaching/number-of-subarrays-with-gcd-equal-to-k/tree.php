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
            'message' => "Read the problem statement above.\nStop extending when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k no longer divides g', 'next' => 's2'],
                ['label' => 'g differs from k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. g can still fall to k later, as in [9,3]; Example 1 → 2 instead of 4.\nStep back to when you stopped at g ≠ k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count a subarray when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k divides g', 'next' => 'wrong_b'],
                ['label' => 'g = k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts GCDs like 9 too; Example 1 → 6 instead of 4.\nStep back to when you counted multiples.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² log V). Examples → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
