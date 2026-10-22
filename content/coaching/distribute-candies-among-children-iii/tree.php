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
            'message' => "Problem: Count the ways to give n candies to 3 children so that no child gets more than limit candies. This is the same task as Distribute Candies Among Children II with larger limits; the limits are in the official statement. For instance, n = 5, limit = 2 → 3 and n = 3, limit = 3 → 10. (Restated from memory; limits and examples may differ slightly.)\nStart from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All splits, minus those where some child exceeds limit', 'next' => 's2'],
                ['label' => 'All splits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The cap is ignored; the first example → 21 instead of 3.\nStep back to when you ignored the cap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sign of the term for i over-limit children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always minus', 'next' => 'wrong_b'],
                ['label' => '(−1)^i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs are subtracted twice; n = 4, limit = 1 → −6 instead of 0.\nStep back to when you always subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). The examples → 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
