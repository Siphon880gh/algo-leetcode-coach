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
            'message' => "Read the problem statement above.\nMemoise by cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the best path depends on used cells', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A cell's best continuation changes with the path.\nStep back to when you memoised.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mark a cell visited how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A global visited set never cleared', 'next' => 'wrong_b'],
                ['label' => 'Set it to 0, restore after', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Other paths need the cell again.\nStep back to when you never cleared it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where to start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every cell with gold', 'next' => 'success'],
                ['label' => 'Only corners', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The best path can start anywhere.\nStep back to when you used corners.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · 3ᵏ). [[0,6,0],[5,8,7],[0,9,0]] → 24. Second example → 28.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
