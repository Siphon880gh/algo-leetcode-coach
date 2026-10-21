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
            'message' => "Problem: A train line has two routes between consecutive stops, regular and express, with arrays regular and express giving the cost of each segment on each route. You start on the regular route. Moving from the regular route onto the express route costs an extra expressCost each time, and moving back to regular costs nothing. Return, for every stop after the start, the minimum cost to reach it. For instance, regular = [2,7,3], express = [1,1,8], expressCost = 4 → [2,6,9]. (Restated from memory; limits and examples may differ slightly.)\nState per stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best cost arriving on regular and on express', 'next' => 's2'],
                ['label' => 'Add min(regular[i], express[i]) per segment', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That ignores the transfer cost; the constructed case → [1,2,5] instead of [2,6,9].\nStep back to when you took the cheaper segment.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Express back to regular costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'expressCost', 'next' => 'wrong_b'],
                ['label' => 'Nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The constructed case → [2,6,12] instead of [2,6,9].\nStep back to when you charged the return.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial express cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'expressCost', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You start on regular; the constructed case → [1,2,5] instead of [2,6,9].\nStep back to when you started express for free.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → [2,6,9], [4,8].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
