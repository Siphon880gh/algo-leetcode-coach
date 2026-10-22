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
            'message' => "Read the problem statement above.\nWhich splits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strips and the four T shapes', 'next' => 's2'],
                ['label' => 'Only three strips', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s grid [[0, 0, 0, 1], [1, 0, 0, 1], [0, 0, 0, 0]] → 4 instead of 3.\nStep back to when you used only strips.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Area of a part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole part', 'next' => 'wrong_b'],
                ['label' => 'Bounding box of its 1s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parts tile the grid: example 1 → 6 instead of 5.\nStep back to when you used whole parts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((m² + n² + m n) · m n). Examples → 5, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
