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
            'message' => "Read the problem statement above.\nGravity direction before rotating?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Toward the right end of each row', 'next' => 's2'],
                ['label' => 'Toward the bottom row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. After a clockwise turn, a row's right end is the floor.\nStep back to when you pulled down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Obstacle met?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Reset the free slot to just left of it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stones cannot pass obstacles.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Rotated cell res[j][i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'box[m − 1 − i][j]', 'next' => 'success'],
                ['label' => 'box[i][j]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is a transpose, not a rotation.\nStep back to when you transposed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). All three examples match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
