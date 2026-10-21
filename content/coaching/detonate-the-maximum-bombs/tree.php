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
            'message' => "Read the problem statement above.\nIs the relation symmetric?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: i reaches j does not mean j reaches i', 'next' => 's2'],
                ['label' => 'Yes, use union-find', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [[0,0,5],[4,0,1]] → 2 from the first bomb but 1 from the second.\nStep back to when you treated it as symmetric.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same in 32-bit', 'next' => 'wrong_b'],
                ['label' => 'dx² + dy² ≤ r² in 64-bit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Coordinates up to 10^5 make the squares overflow 32 bits.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start from which bomb?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every bomb, keep the best', 'next' => 'success'],
                ['label' => 'The one with the largest radius', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[0,0,1],[1,0,1],[2,0,1],[10,10,3]] → 3 from the middle small bomb, but the large one reaches only itself.\nStep back to when you picked the largest radius.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Examples → 2, 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
