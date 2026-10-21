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
            'message' => "Read the problem statement above.\nCollect values how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'In-order', 'next' => 's2'],
                ['label' => 'Level order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In-order gives sorted values.\nStep back to when you used level order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Root of each range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first element', 'next' => 'wrong_b'],
                ['label' => 'The middle element', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That builds a chain again.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several balanced answers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any is accepted', 'next' => 'success'],
                ['label' => 'Only one is correct', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement accepts any.\nStep back to when you required one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,null,2,null,3,null,4] → a balanced tree such as [2,1,3,null,null,null,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
