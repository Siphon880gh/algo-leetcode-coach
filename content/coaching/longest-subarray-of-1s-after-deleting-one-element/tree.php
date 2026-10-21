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
            'message' => "Read the problem statement above.\nAll ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1', 'next' => 's2'],
                ['label' => 'n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You must delete one element.\nStep back to when you returned n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No zeros', 'next' => 'wrong_b'],
                ['label' => 'At most one zero', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The deleted element can be the zero.\nStep back to when you forbade zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shrink when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Zeros exceed 1', 'next' => 'success'],
                ['label' => 'At every zero', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One zero is allowed.\nStep back to when you shrank early.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,0,1] → 3. [0,1,1,1,0,1,1,0,1] → 5. [1,1,1] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
