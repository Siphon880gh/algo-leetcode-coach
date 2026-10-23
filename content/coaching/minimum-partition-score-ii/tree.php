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
            'message' => "Problem: You get an array nums of positive integers and an integer k. Split nums into exactly k non-empty contiguous parts. A part whose elements add up to s is worth s · (s + 1) / 2, and the score is the total over all parts. Return the minimum score. This version allows a much longer array than Minimum Partition Score. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Penalty search with a hull', 'next' => 's2'],
                ['label' => 'Merge the cheapest neighbors', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [4, 8, 6, 8, 8, 5], k = 2 → 442 instead of 402.\nStep back to when you merged greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'g, the sum of squares', 'next' => 'wrong_b'],
                ['label' => '(g + total) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check: [3, 1, 4, 1, 5], k = 2 → 100 instead of 57.\nStep back to when you skipped the conversion.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log S). Constructed checks → 57, 145.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
