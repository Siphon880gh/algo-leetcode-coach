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
            'message' => "Read the problem statement above.\nA row is covered when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All its 1s are in chosen columns', 'next' => 's2'],
                ['label' => 'At least one of its 1s is chosen', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 2; the row of zeros never counts.\nStep back to when you accepted any chosen 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A row of zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never covered', 'next' => 'wrong_b'],
                ['label' => 'Always covered', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2 instead of 3.\nStep back to when you skipped empty rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Choose columns how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every set of numSelect columns', 'next' => 'success'],
                ['label' => 'Take the columns with the most 1s', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[0,1,0,1],[1,0,1,1],[0,1,0,0],[1,1,1,0]] with numSelect = 2 → 1 instead of 2.\nStep back to when you picked greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(C(n, numSelect) · m). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
