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
            'message' => "Read the problem statement above.\nCombine conditions with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'AND', 'next' => 's2'],
                ['label' => 'OR', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Products must be both low fat and recyclable.\nStep back to when you used OR.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'TRUE', 'next' => 'wrong_b'],
                ['label' => 'The string \'Y\'', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The columns are Y/N enums, not booleans.\nStep back to when you compared to TRUE.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'success'],
                ['label' => 'Must sort', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement accepts any order.\nStep back to when you forced a sort.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows). Example → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
