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
            'message' => "Read the problem statement above.\nPair which values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i and −i', 'next' => 's2'],
                ['label' => 'i and i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values must be unique.\nStep back to when you repeated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n odd?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add n', 'next' => 'wrong_b'],
                ['label' => 'Add 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adding n breaks the zero sum.\nStep back to when you added n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must match the sample output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any valid array', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any valid answer is accepted.\nStep back to when you copied the sample.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 5 → [1,-1,2,-2,0]. n = 1 → [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
