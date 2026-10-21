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
            'message' => "Read the problem statement above.\nNeed a stack of names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only depth matters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer is the number of steps back.\nStep back to when you stored names.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"../\" at the main folder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Go to −1', 'next' => 'wrong_b'],
                ['label' => 'Stay at 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. There is no parent of the main folder.\nStep back to when you went negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "\"./\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No change', 'next' => 'success'],
                ['label' => 'Depth + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It means the current folder.\nStep back to when you incremented.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
