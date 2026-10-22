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
            'message' => "Read the problem statement above.\nFilter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'weight > 100', 'next' => 's2'],
                ['label' => 'weight >= 100', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An animal weighing exactly 100 would be kept.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sort_values(weight)', 'next' => 'wrong_b'],
                ['label' => 'sort_values(weight, ascending=False)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ascending order gives Alex, Tommy, Jonathan, Tatiana.\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The example → Tatiana, Jonathan, Tommy, Alex.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
