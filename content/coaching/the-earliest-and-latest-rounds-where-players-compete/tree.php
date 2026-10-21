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
            'message' => "Read the problem statement above.\nState needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Players left and the two stars\' positions', 'next' => 's2'],
                ['label' => 'The full set of remaining players', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the stars' positions matter.\nStep back to when you kept the full set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stars meet when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j == i + 1', 'next' => 'wrong_b'],
                ['label' => 'i + j == n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matches pair the front with the back.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Repeated states?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Memoise', 'next' => 'success'],
                ['label' => 'Recompute', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The same states recur across outcomes.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [3,4], [1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
