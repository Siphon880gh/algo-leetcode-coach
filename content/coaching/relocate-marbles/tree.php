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
            'message' => "Read the problem statement above.\nInside one move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove moveFrom[i], then add moveTo[i]', 'next' => 's2'],
                ['label' => 'Add moveTo[i], then remove moveFrom[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A move onto the same spot empties it; nums = [1] with 1 → 1 gives [] instead of [1].\nStep back to when you added first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return the positions in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order they were occupied', 'next' => 'wrong_b'],
                ['label' => 'Sorted order', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output must be sorted; example 1 → [6, 8, 9, 5] instead of [5, 6, 8, 9].\nStep back to when you kept insertion order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log n). Examples → [5, 6, 8, 9], [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
