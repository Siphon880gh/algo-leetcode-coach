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
            'message' => "Problem: You get nums (length up to 300, values from −10^9 to 10^9), a window length, and k. You may do at most k swaps, each exchanging any two elements. Return the largest possible sum of a subarray of exactly that length. Example: nums = [1, −1, 0, 2], length = 2, k = 1 gives 3 by swapping −1 and 2 to get [1, 2, 0, −1].\nWhich swaps change a fixed window's sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any swap', 'next' => 'wrong_a'],
                ['label' => 'Only trades between an inside and an outside element', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Swapping two inside elements, or two outside elements, leaves the window sum as it was.\nStep back to when you counted every swap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums = [4, 0, 2], length = 2, k = 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4, the best window as it is', 'next' => 'success'],
                ['label' => '6, take the two largest', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k = 0 allows no swaps. The best window is [4, 0] with sum 4.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Per window, greedy trades up to min(k, length, n − length). O(n² log n). Examples give 3, 11 and −3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
