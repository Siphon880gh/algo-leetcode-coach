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
            'message' => "Read the problem statement above.\nJust the length difference?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: per-letter counts', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3, but the answer is 7.\nStep back to when you used lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters t has more of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those', 'next' => 'wrong_b'],
                ['label' => 'And also letters s has more of', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 (a, s), missing the 5 letters t needs.\nStep back to when you counted one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Append to which string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both, as needed', 'next' => 'success'],
                ['label' => 'Only the shorter one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 appends as to s and five letters to t.\nStep back to when you appended to one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| + |t|). Examples → 7, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
