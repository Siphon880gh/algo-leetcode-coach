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
            'message' => "Problem: An interactive problem: a robot sits in an unknown grid and can ask whether it can move in a direction, move in a direction, and check whether its current cell is the target. Return the fewest moves from the start to the target, or −1 if it cannot be reached. For instance, a grid with rows \"S.#\" and \"#.T\" (S start, T target, # blocked) → 3, and a single row \"S#T\" → −1. (Restated from memory; limits and examples may differ slightly.)\nBFS with the robot directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, the robot cannot jump between frontier cells', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Moving the robot between distant cells costs many moves.\nStep back to when you used BFS on the robot.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After each DFS branch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue from the new cell', 'next' => 'wrong_b'],
                ['label' => 'Move back in the opposite direction', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The robot's position must match the DFS stack.\nStep back to when you skipped moving back.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target never seen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return the explored size', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Unreachable targets mean no path.\nStep back to when you returned something else.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(cells). Constructed check → 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
