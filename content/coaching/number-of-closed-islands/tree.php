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
            'message' => "Read the problem statement above.\nWhich value is land?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In this problem 0 is land and 1 is water.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Islands touching the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count them', 'next' => 'wrong_b'],
                ['label' => 'Not closed: remove them first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They are not surrounded by water.\nStep back to when you counted them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After clearing the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each remaining land component', 'next' => 'success'],
                ['label' => 'Count land cells', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer counts islands, not cells.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows · cols). Examples → 2, 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
