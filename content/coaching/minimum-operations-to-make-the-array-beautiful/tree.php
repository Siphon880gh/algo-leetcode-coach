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
            'message' => "Problem: You are given an array of positive integers. The array is beautiful when every element after the first is divisible by the element before it. In one operation you may add 1 to any element except the first. Return the fewest operations that make the array beautiful. This guide assumes the values are small, as in the official limits. (Restated from memory; limits and examples may differ slightly.)\nRound each element up to the next multiple?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep every reachable value with its cost', 'next' => 's2'],
                ['label' => 'Yes, greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 3, 4] → 2 instead of 1.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The first element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Raise it too', 'next' => 'wrong_b'],
                ['label' => 'Leave it as is', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Under this restatement only later elements can change. Raising it would turn [3, 4] (made up) into 1 operation instead of 2.\nStep back to when you changed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · B log B). Constructed checks → 1, 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
