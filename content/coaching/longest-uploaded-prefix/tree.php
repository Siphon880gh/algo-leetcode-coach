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
            'message' => "Read the problem statement above.\nlongest() returns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How far the pointer gets over consecutive uploads from 1', 'next' => 's2'],
                ['label' => 'The number of uploaded videos', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After upload(3), the answer is 0, not 1.\nStep back to when you counted uploads.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does each call start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From video 1', 'next' => 'wrong_b'],
                ['label' => 'Where the pointer stopped last time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With 2 · 10^5 calls on n = 10^5 that is up to about 2 · 10^10 steps.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Array size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n + 2', 'next' => 'success'],
                ['label' => 'n + 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Once all n are uploaded, the loop reads index n + 1, past the end.\nStep back to when you dropped the spare slot.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) amortised per call. Example → [null, null, 0, null, 1, null, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
