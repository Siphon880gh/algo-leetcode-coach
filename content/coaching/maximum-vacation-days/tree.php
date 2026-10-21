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
            'message' => "Problem: n cities and k weeks (up to 100 each). flights[i][j] = 1 means you can fly from i to j; days[i][w] is the vacation you can take in city i during week w. You start in city 0, and each Monday you may fly once or stay. Return the most vacation days. flights = [[0,1,1],[1,0,1],[1,1,0]], days = [[1,3,1],[6,0,3],[3,3,3]] → 12. (Restated from memory; limits and examples may differ slightly.)\nGreedy: each week go to the reachable city with the most days?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP over weeks and cities', 'next' => 's2'],
                ['label' => 'Yes: best reachable city every week', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A poor week can lead to a city that opens big weeks later, and greedy cannot see that.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f[w][j] = best total ending week w in city j. Where can week w start from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only cities i with flights[i][j] = 1', 'next' => 'wrong_b'],
                ['label' => 'City j itself (stay) or any i with flights[i][j] = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Staying is always allowed, even though flights[j][j] is 0.\nStep back to when you dropped staying.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the starting state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'f[0][0] = 0 and every other city −∞', 'next' => 'success'],
                ['label' => 'f[0][j] = 0 for every city', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You start in city 0; any other city has to be reached by a flight.\nStep back to when you started everywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. DP by week with stay-or-fly moves: O(k · n²) time, O(n) space with a rolling row. → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
