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
            'message' => "Read the problem statement above.\nHow do you get paths with only child pointers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Root-to-node paths for start and dest', 'next' => 's2'],
                ['label' => 'Search outward from start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without parent pointers you cannot move up from start.\nStep back to when you searched from start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The shared prefix of both paths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it', 'next' => 'wrong_b'],
                ['label' => 'Drop it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the tree of Example 1, going from 6 (RL) to 4 (RR) gives UR, not UURR.\nStep back to when you kept the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Remaining start path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One U per letter', 'next' => 'success'],
                ['label' => 'Its letters reversed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every step back toward the common ancestor is a move to the parent.\nStep back to when you reversed the letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → UURL, L.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
