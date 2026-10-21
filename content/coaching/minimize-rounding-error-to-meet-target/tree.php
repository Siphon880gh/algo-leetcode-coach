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
            'message' => "Problem: prices are strings with three decimals and target is an integer. Round each price down or up so the rounded prices sum to target, minimizing Σ |rounded − price|. Return that error with three decimals, or \"-1\" if target is unreachable. [\"0.700\",\"2.800\",\"4.900\"], target = 8 → \"1.000\". [\"1.500\",\"2.500\",\"3.500\"], target = 10 → \"-1\". (Restated from memory; limits and examples may differ slightly.)\nHow many round-ups are needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k = target − sum of floors', 'next' => 's2'],
                ['label' => 'Try every combination', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each round-up adds exactly 1, so k is fixed.\nStep back to when you tried combinations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When is it impossible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only when k < 0', 'next' => 'wrong_b'],
                ['label' => 'k < 0 or k > the number of non-integer prices', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Integer prices cannot round up.\nStep back to when you only checked k < 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which prices round up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k with the largest fractional parts', 'next' => 'success'],
                ['label' => 'The k smallest prices', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A round-up costs 1 − f, cheapest for large f.\nStep back to when you took the smallest prices.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [\"0.700\",\"2.800\",\"4.900\"], 8 → \"1.000\". [\"1.500\",\"2.500\",\"3.500\"], 10 → \"-1\". [\"1.500\",\"2.500\",\"3.500\"], 9 → \"1.500\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
