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
            'message' => "Problem: You are given the head of a linked list with an even number of nodes. The nodes form consecutive pairs: first and second, third and fourth, and so on. In each pair, the node with the higher value earns a point for its team: one team owns the first node of every pair, the other team the second. Return which team has more points, or that it is a tie, using the labels the statement gives. Limits are in the official statement. For instance, values 2, 5, 4, 7, 20, 5 → the team of second nodes wins, 2 points to 1. (Restated from memory; limits and examples may differ slightly.)\nMove by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two nodes', 'next' => 's2'],
                ['label' => 'One node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That also compares 5 with 4 across pairs in the example.\nStep back to when you moved one node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Decide by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first pair', 'next' => 'wrong_b'],
                ['label' => 'Totals over all pairs', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 4, 5, 2, 1 is a tie, but its first pair goes to the second team.\nStep back to when you used the first pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → second team, 2 to 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
