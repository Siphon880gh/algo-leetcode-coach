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
            'message' => "Problem: Each hero has a power; each monster has a power and a number of coins. A hero defeats every monster weaker than them and collects all those coins. Return, for each hero, the total coins they can collect. How equal power is treated and the limits are in the official statement. For instance, heroes [1, 4, 2] against monsters [1, 1, 5, 2, 3] with coins [2, 3, 4, 5, 6] → [5, 16, 10] if a tie counts as a win. (Restated from memory; limits and examples may differ slightly.)\nFind the monsters a hero beats with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_right', 'next' => 's2'],
                ['label' => 'bisect_left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ties are dropped; in code the example → [0, 16, 5] instead of [5, 16, 10].\nStep back to when you used bisect_left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then total the coins with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A loop per hero', 'next' => 'wrong_b'],
                ['label' => 'Prefix sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n · m) in the worst case.\nStep back to when you looped per hero.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). The example → [5, 16, 10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
