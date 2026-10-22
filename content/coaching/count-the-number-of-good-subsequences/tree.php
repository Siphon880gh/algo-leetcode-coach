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
            'message' => "Problem: Given a string, count its non-empty subsequences in which every character that appears occurs the same number of times. Subsequences are counted by the positions chosen, so equal strings taken from different positions count separately. Return the count modulo a large prime, as the official statement gives. For instance, aabb → 11 (all 15 non-empty subsequences except the two aab and the two abb), and abc → 7. (Restated from memory; limits and examples may differ slightly.)\nFor one frequency f, the product of (1 + C(c, f))?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minus 1', 'next' => 's2'],
                ['label' => 'Use it as is', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It includes choosing no letter at all; aabb → 13 instead of 11.\nStep back to when you kept the empty choice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try f up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest count', 'next' => 'wrong_b'],
                ['label' => 'The largest count', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rare letters can simply stay out; aab → 5 instead of 6.\nStep back to when you stopped at the smallest count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Constructed checks → 11, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
