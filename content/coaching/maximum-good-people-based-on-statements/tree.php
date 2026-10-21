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
            'message' => "Read the problem statement above.\nHow to search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every mask of who is good (n ≤ 15)', 'next' => 's2'],
                ['label' => 'Greedily trust whoever makes the most statements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A greedy choice can trust a liar and rule out a larger consistent group.\nStep back to when you trusted greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Whose statements must match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everyone', 'next' => 'wrong_b'],
                ['label' => 'Only people in the mask', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bad people may lie; checking them makes Example 1 → 0, not 2.\nStep back to when you checked everyone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which mask to return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest popcount among consistent masks', 'next' => 'success'],
                ['label' => 'The first consistent mask found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The empty mask is always consistent, so the first one gives 0.\nStep back to when you stopped at the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n²). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
