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
            'message' => "Read the problem statement above.\nIs the starting cell charged?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 's2'],
                ['label' => 'Yes, its row and column', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 2 → 0 with start equal to home.\nStep back to when you charged the start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Moving into row r costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rowCosts of the row you leave', 'next' => 'wrong_b'],
                ['label' => 'rowCosts[r], the row you enter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 would give 20 instead of 18.\nStep back to when you charged the row you left.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Could a detour be cheaper?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every row and column between must be entered anyway', 'next' => 'success'],
                ['label' => 'Yes, run a shortest-path search', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Costs are non-negative and a detour enters extra rows or columns on top.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). Examples → 18, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
