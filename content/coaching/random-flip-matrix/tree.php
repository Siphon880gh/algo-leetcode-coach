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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Number cells 0..total − 1 and keep only a sparse map', 'next' => 's2'],
                ['label' => 'Store the whole matrix and a list of zero cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1e8 cells is far too much memory.\nStep back to when you stored the matrix.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Draw r in [0, total − 1].\nThen what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'If r was flipped before, draw again', 'next' => 'wrong_b'],
                ['label' => 'cell = map.get(r, r); map[r] = map.get(total − 1, total − 1); total −= 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Redrawing gets slower as cells fill and wastes random calls.\nStep back to when you redrew on hits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return [cell // n, cell % n]. One random call per flip, O(1) time. reset: clear the map, total = m × n.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Virtual swap-remove with a map; reset clears it', 'next' => 'success'],
                ['label' => 'Just mark r as used in a set', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Without moving the last live index into r, slot r stays dead and can be drawn again.\nStep back to when you only recorded r as used.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Fisher-Yates on a virtual array with a sparse map. O(1) per flip.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
