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
            'message' => "Read the problem statement above.\nWhat is a search state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The pair (position, speed)', 'next' => 's2'],
                ['label' => 'Position alone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The same position with a different speed behaves differently.\nStep back to when you used position alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does R do to the speed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sets it to 0', 'next' => 'wrong_b'],
                ['label' => 'Sets it to −1 if it was positive, else to 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reversing gives speed 1 in the other direction.\nStep back to when you set it to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why prune positions far past the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overshooting beyond about 2 · target never helps, and speeds grow exponentially', 'next' => 'success'],
                ['label' => 'No pruning is needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without bounds the BFS explodes.\nStep back to when you skipped pruning.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS, or a DP in O(t log t). target 3 → 2 (\"AA\"). target 6 → 5 (\"AAARA\").\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
