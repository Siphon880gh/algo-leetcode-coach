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
            'message' => "Read the problem statement above.\nWhich gaps count for [0, x]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gaps up to x and the stretch from the last obstacle to x', 'next' => 's2'],
                ['label' => 'Only gaps between obstacles', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With no obstacle yet, [[2, 5, 3]] → false instead of true.\nStep back to when you dropped the stretch.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A gap fits when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gap > sz', 'next' => 'wrong_b'],
                ['label' => 'gap ≥ sz', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A block may touch both obstacles: example 1 → [false, true, false] instead of [false, true, true].\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q log q). Examples → [false, true, true], [true, true, false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
