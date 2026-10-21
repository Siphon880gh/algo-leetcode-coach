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
            'message' => "Problem: Given n playing cards, count the distinct houses of cards that use all n cards. A row of k triangles uses 3k − 1 cards (two leaning cards per triangle and a horizontal card between neighbours), each triangle above the bottom row must sit on a horizontal card of the row below, and two houses differ if some row has a different number of cards. For instance, 16 → 2; 2 → 1; 4 → 0. (Restated from memory; limits and examples may differ slightly.)\nCan two rows have the same size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each row is strictly smaller', 'next' => 's2'],
                ['label' => 'Yes, sizes may repeat', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A row of k triangles has only k − 1 horizontal cards to hold the next row; 16 → 6 instead of 2.\nStep back to when you allowed repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cards in a row of k triangles?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3k', 'next' => 'wrong_b'],
                ['label' => '3k − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Neighbouring triangles share one horizontal card, so there are k − 1, not k; 16 → 0 instead of 2.\nStep back to when you used 3k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sets of row sizes', 'next' => 'success'],
                ['label' => 'Orderings of the rows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sizes must decrease upward, so each set stacks one way only.\nStep back to when you counted orderings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Constructed cases → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
