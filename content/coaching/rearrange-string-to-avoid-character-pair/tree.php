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
            'message' => "Read the problem statement above.\nBuild how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every y, then the others, then every x', 'next' => 's2'],
                ['label' => 'Sort s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"aabc\", where 'a' comes before 'c'.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which letter goes first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x', 'next' => 'wrong_b'],
                ['label' => 'y', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → \"dcab\", where 'd' comes before 'b'.\nStep back to when you put x first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"cbaa\", \"cabd\", \"axe\" (any valid order works).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
