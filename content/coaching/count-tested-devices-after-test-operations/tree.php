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
            'message' => "Read the problem statement above.\nDevice tested when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'battery − tested so far > 0', 'next' => 's2'],
                ['label' => 'battery > 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Earlier tests drain it; example 1 → 5 instead of 3.\nStep back to when you ignored the drain.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Comparison?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≥ 0', 'next' => 'wrong_b'],
                ['label' => '> 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An empty battery cannot be tested; example 2 → 3 instead of 2.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
