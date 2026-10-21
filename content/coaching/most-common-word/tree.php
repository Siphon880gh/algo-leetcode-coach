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
            'message' => "Read the problem statement above.\nSplit on spaces only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: punctuation sticks to words', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"ball,\" and \"ball\" would differ.\nStep back to when you split on spaces only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Delete punctuation, or replace it with a space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete it', 'next' => 'wrong_b'],
                ['label' => 'Replace it with a space', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"a,b\" must be two words, not \"ab\".\nStep back to when you deleted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is \"Bob\" the same word as \"bob\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: compare in lowercase', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem is case-insensitive.\nStep back to when you kept case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"Bob hit a ball, the hit BALL flew far after it was hit.\", banned [\"hit\"] → \"ball\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
