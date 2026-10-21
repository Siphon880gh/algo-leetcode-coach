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
            'message' => "Read the problem statement above.\nNeed BFS on the board?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: positions are divmod(letter, 5)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The grid is regular except for z.\nStep back to when you set up BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Move order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'D and R first, then U and L', 'next' => 'wrong_b'],
                ['label' => 'U and L first, then D and R', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Going down to row 5 before left leaves the board, and so does going right from z.\nStep back to when you moved D first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target letter equals the current one. Moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only !', 'next' => 'success'],
                ['label' => 'Step away and back', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero moves are needed.\nStep back to when you stepped away.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len · 9). \"leet\" → \"DDR!UURRR!!DDD!\". \"code\" → \"RR!DDRR!UUL!R!\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
