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
            'message' => "Problem: In a grid with your start cell, food cells, free cells and obstacles, return the fewest 4-directional steps to reach any food cell, or −1. For instance, a single row [start, free, food] → 2, and [start, obstacle, food] → −1. (Restated from memory; limits and examples may differ slightly.)\nSearch method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS', 'next' => 's2'],
                ['label' => 'DFS with a best-so-far', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. DFS explores paths exponentially and does not give shortest steps directly.\nStep back to when you chose DFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which food cell to target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Run BFS from each food cell', 'next' => 'wrong_b'],
                ['label' => 'Any: stop at the first one reached', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One BFS from the start finds the nearest food.\nStep back to when you ran one per food.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark visited when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On enqueue', 'next' => 'success'],
                ['label' => 'On dequeue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Marking late lets cells be queued many times.\nStep back to when you marked on dequeue.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(rows · cols). Constructed check → 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
