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
            'message' => "Problem: Given a connected graph of named cities and a target name sequence, return a path of the same length (consecutive cities adjacent) minimising positions where the city name differs from the target. For instance, if A–B–C exists for target [\"A\",\"B\",\"C\"], the distance is 0. (Restated from memory; limits and examples may differ slightly.)\nEnumerate all paths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP per layer', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Paths grow exponentially.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any city', 'next' => 'wrong_b'],
                ['label' => 'Neighbours of v', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Consecutive cities must be adjacent.\nStep back to when you allowed jumps.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The path via parent pointers', 'next' => 'success'],
                ['label' => 'Only the distance', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement asks for the path.\nStep back to when you returned the cost.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L · E) time.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
