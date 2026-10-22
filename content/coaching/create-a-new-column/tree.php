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
            'message' => "Read the problem statement above.\nAssign salary · 2 to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A new bonus column', 'next' => 's2'],
                ['label' => 'The salary column', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That overwrites salary and adds no bonus column.\nStep back to when you assigned to salary.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the bonus column', 'next' => 'wrong_b'],
                ['label' => 'The whole DataFrame', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The output keeps name and salary too.\nStep back to when you returned one column.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → bonus 9096, 56300, 2206, 13186, 149152, 48866.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
