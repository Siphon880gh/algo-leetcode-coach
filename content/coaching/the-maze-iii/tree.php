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
            'message' => "Problem: m × n maze, the ball rolls until a wall, and falls into the hole if it passes over it. Return the instructions for the shortest distance, then lexicographically smallest, or \"impossible\". Sample → \"lul\". (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra with a priority queue', 'next' => 's2'],
                ['label' => 'BFS by number of rolls', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rolls have different lengths. Plain BFS counts rolls, not cells.\nStep back to when you used BFS by number of moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distance only', 'next' => 'wrong_b'],
                ['label' => '(distance, path string)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"lul\" and \"ul\" both have distance 6 in the sample. Distance alone cannot pick \"lul\".\nStep back to when you keyed on distance only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pop the smallest; if it is the hole, return its path. Push a stop when (d', p') beats the best known there.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra on (dist, path); stop the roll at the hole', 'next' => 'success'],
                ['label' => 'Always roll to the wall, then check the hole', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A roll continues past the hole only if you forget to check it. The ball falls in as soon as it reaches it.\nStep back to when you rolled to the wall regardless.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Dijkstra with a two-part key and a hole check during rolls. → \"lul\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
