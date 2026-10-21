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
            'message' => "Problem: An even number of people sit around a circle. Count the ways they can all shake hands in pairs with no two handshakes crossing, modulo 10⁹ + 7. For instance, 4 people give 2 ways and 6 people give 5. (Restated from memory; limits and examples may differ slightly.)\nWho can person 0 shake with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Someone leaving even groups on both sides', 'next' => 's2'],
                ['label' => 'Anyone', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An odd group leaves someone with no partner.\nStep back to when you allowed anyone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the two sides how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add them', 'next' => 'wrong_b'],
                ['label' => 'Multiply dp[left] · dp[right]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sides choose independently.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case dp[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An empty side has one way: nothing.\nStep back to when you set 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). 4 → 2. 6 → 5. 8 → 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
