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
            'message' => "Read the problem statement above.\nMerge the two largest leaves first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: remove the smallest first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Large values would be paid many times.\nStep back to when you merged the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Popped value mid. Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'mid · max(new top, incoming value)', 'next' => 'wrong_b'],
                ['label' => 'mid · min(new top, incoming value)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pair it with the smaller neighbour.\nStep back to when you used the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Input is done, stack holds several values. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop and multiply adjacent pairs', 'next' => 'success'],
                ['label' => 'Return the cost', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Those leaves are not merged yet.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [6,2,4] → 32. [4,11] → 44.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
