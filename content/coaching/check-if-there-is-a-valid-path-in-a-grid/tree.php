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
            'message' => "Read the problem statement above.\nMove when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both cells connect to each other', 'next' => 's2'],
                ['label' => 'The current cell opens that way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The neighbour must connect back.\nStep back to when you checked one side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Street 4 opens?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left and down', 'next' => 'wrong_b'],
                ['label' => 'Right and down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Left and down is street 3.\nStep back to when you mixed them up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Visited set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Required', 'next' => 'success'],
                ['label' => 'Not needed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Streets can loop.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). [[2,4,3],[6,5,2]] → true. [[1,2,1],[1,2,1]] → false. [[1,1,2]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
