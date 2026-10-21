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
            'message' => "Read the problem statement above.\nSimulate the moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: sort and use the gaps', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Three positions decide everything.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Maximum moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'z − x', 'next' => 'wrong_b'],
                ['label' => 'z − x − 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The middle stone and both ends take slots.\nStep back to when you used z − x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Gaps are 1 and 5. Minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The far stone jumps next to the pair in one move.\nStep back to when you said 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). 1, 2, 5 → [1,2]. 4, 3, 2 → [0,0]. 3, 5, 1 → [1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
