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
            'message' => "Problem: You are given a grid of digits and a smaller pattern grid of digits and letters. Find a placement of the pattern inside the grid where each pattern digit equals the grid digit under it and each letter stands for one digit consistently. Return the top-left cell of the placement, choosing among several as the statement says, or a not-found value. Exact rules, tie-breaks and limits are in the official statement. For instance, grid [[1, 2, 2], [2, 2, 3], [2, 3, 3]] with pattern rows ab and bb → [0, 0]. (Restated from memory; limits and examples may differ slightly.)\nMaps per placement?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letter → digit and digit → letter', 'next' => 's2'],
                ['label' => 'Letter → digit only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the assumed rule, two letters could share a digit: pattern ab would match the grid row 1 1.\nStep back to when you kept one map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reset the maps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once for the whole grid', 'next' => 'wrong_b'],
                ['label' => 'For every placement', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A failed placement leaves its bindings behind: grid rows 1 2 and 3 5 with pattern a5 → not found instead of [1, 0].\nStep back to when you shared the maps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Brute force over placements. The restated example → [0, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
