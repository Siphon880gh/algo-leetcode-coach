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
            'message' => "Read the problem statement above.\nWhere does the pointer start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At a', 'next' => 's2'],
                ['label' => 'At the first letter of word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It starts at a; “bza” pays 1 to reach b.\nStep back to when you started on the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Move cost between letters d apart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd', 'next' => 'wrong_b'],
                ['label' => 'min(d, 26 − d)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The wheel is circular; z to a is 1 step, not 25.\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Typing cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 second per character', 'next' => 'success'],
                ['label' => 'Already included in the move', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Typing is a separate second; “abc” is 2 moves + 3 types = 5.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 7, 34.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
