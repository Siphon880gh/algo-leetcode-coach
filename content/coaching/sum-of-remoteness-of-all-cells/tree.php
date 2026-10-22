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
            'message' => "Problem: Given a square grid in which some cells are blocked and the rest hold positive values, the remoteness of an open cell is the sum of the values in open cells it cannot reach by moving up, down, left or right through open cells. Return the sum of the remoteness of all open cells. How blocked cells are marked and the limits are in the official statement. For instance, with B blocked, [[1, B], [B, 2]] → 3 and [[1, 2], [B, 3]] → 0. (Restated from memory; limits and examples may differ slightly.)\nSearch from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each component once', 'next' => 's2'],
                ['label' => 'Every open cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(cells²).\nStep back to when you searched from every cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A component adds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'S − c', 'next' => 'wrong_b'],
                ['label' => 'z · (S − c)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every cell in it counts; in code [[2, B, 3], [B, B, B], [4, 5, B]] → 28 instead of 33.\nStep back to when you dropped the size.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). The checks → 3, 0, 33.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
