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
            'message' => "Problem: You get an integer n and an equilateral triangle of side n, cut into n² unit triangles arranged in n rows that grow longer toward the bottom. Two unit triangles are neighbours when they share a side. You colour some unit triangles red at the start; then, as long as some white triangle has at least two red neighbours, it turns red. Choose as few starting triangles as possible so that the whole triangle ends up red, and return them. The coordinate system and output format are in the official statement, and any optimal set is accepted. For instance, n = 1 needs its single triangle, and n = 2 needs 3 of its 4 triangles: the top one and the two outer triangles of the bottom row. (Restated from memory; limits and examples may differ slightly.)\nThe two bottom corner triangles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start them red', 'next' => 's2'],
                ['label' => 'Let spreading reach them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A corner has only one neighbour, so it never gets two red ones; n = 2 starting from the top, the middle and the right corner → the left corner stays white.\nStep back to when you skipped the corners.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many triangles does n = 3 need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'wrong_b'],
                ['label' => '5, the perimeter bound', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Trying every 4-triangle set in code, none colours the whole n = 3 triangle.\nStep back to when you went below the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Constructed checks → 1, 3, 5 triangles for n = 1, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
