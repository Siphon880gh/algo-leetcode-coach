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
            'message' => "Read the problem statement above.\nSimulate k single shifts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compute the target index', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. k can be large; each cell moves once.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reduce k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k mod n', 'next' => 'wrong_b'],
                ['label' => 'k mod (m · n)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A full cycle covers every cell, not one row.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does flat index j land?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(j / n, j mod n)', 'next' => 'success'],
                ['label' => '(j mod m, j / m)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Rows have n cells each.\nStep back to when you mixed up the dimensions.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). First example, k = 1 → [[9,1,2],[3,4,5],[6,7,8]]. k = 9 on the same grid → unchanged.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
