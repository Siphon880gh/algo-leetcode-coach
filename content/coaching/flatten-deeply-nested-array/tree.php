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
            'message' => "Read the problem statement above.\nExpand a subarray at depth d when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd < n', 'next' => 's2'],
                ['label' => 'd ≤ n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Depth 0 is not below n = 0; Example 1 → one level flattened instead of unchanged.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Depth passed to the recursive call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd', 'next' => 'wrong_b'],
                ['label' => 'd + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inner arrays sit one level deeper; Example 2 → fully flat instead of keeping [9,10,11].\nStep back to when you kept d.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total elements). Examples → unchanged, one level, fully flat.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
