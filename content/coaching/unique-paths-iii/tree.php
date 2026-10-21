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
            'message' => "Read the problem statement above.\nUse the usual unique-paths DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every empty square must be visited once, so backtrack', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DP over cells cannot track which squares were visited.\nStep back to when you used DP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You reach the end square with squares left. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it', 'next' => 'wrong_b'],
                ['label' => 'Return 0 for this path', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The path must cover every non-obstacle square.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After exploring from a cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unmark it so other paths can use it', 'next' => 'success'],
                ['label' => 'Leave it marked', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Other paths must be able to pass through it.\nStep back to when you left it marked.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(3^cells). [[1,0,0,0],[0,0,0,0],[0,0,2,−1]] → 2. [[1,0,0,0],[0,0,0,0],[0,0,0,2]] → 4. [[0,1],[2,0]] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
