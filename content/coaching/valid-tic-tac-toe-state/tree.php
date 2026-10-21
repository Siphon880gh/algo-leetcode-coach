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
            'message' => "Read the problem statement above.\nWhat count relation always holds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x == o or x == o + 1', 'next' => 's2'],
                ['label' => 'x == o', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. X moves first, so X may be one ahead.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "X has a line. What else must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'x == o + 1, since the game stops at X\'s winning move', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. If O moved after X won, the board is invalid.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "X completes two lines at once. Invalid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one move can complete two lines', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single X in the right spot can finish a row and a diagonal together.\nStep back to when you rejected double lines.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). [\"O  \",\"   \",\"   \"] → false. [\"XOX\",\" X \",\"   \"] → false. [\"XOX\",\"O O\",\"XOX\"] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
