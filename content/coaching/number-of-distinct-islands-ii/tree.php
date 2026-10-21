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
            'message' => "Problem: Problem: Given a binary grid, count distinct island shapes, where two islands are the same if one maps onto the other by translation, rotation (90°, 180°, 270°), or reflection. (Restated from memory; limits and examples may differ slightly.)\nHow many transforms must you consider?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8: (±r, ±c) and (±c, ±r)', 'next' => 's2'],
                ['label' => '4 rotations', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Reflections are allowed too, which doubles the set.\nStep back to when you used rotations only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you normalize one transformed shape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shift so the original start cell is (0, 0)', 'next' => 'wrong_b'],
                ['label' => 'Sort the cells, then shift so the first cell is (0, 0)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After a rotation, the original start is no longer a consistent anchor.\nStep back to when you used the original start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which of the 8 normalized forms is the key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest, compared as tuples', 'next' => 'success'],
                ['label' => 'The first one generated', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two equivalent islands generate the same 8 forms in different orders; only a canonical choice matches them.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One canonical key per island in a set: O(m · n · log(m · n)). [[1,1,0,0,0],[1,0,0,0,0],[0,0,0,0,1],[0,0,0,1,1]] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
