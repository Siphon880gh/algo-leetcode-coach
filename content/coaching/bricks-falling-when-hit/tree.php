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
            'message' => "Read the problem statement above.\nWhy process hits in reverse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Union-find can merge but not split; restoring a brick is a merge', 'next' => 's2'],
                ['label' => 'It is just a style choice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Forward removal would need splitting, which union-find cannot do.\nStep back to when you processed forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you know which bricks are stable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each component\'s size', 'next' => 'wrong_b'],
                ['label' => 'A virtual roof node joined to every top-row brick', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Size alone does not say whether a component touches the top.\nStep back to when you used size only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After restoring a brick, the roof component grew by g. Fallen count for that hit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, g − 1)', 'next' => 'success'],
                ['label' => 'g', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The restored brick itself was erased, not dropped.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((m · n + hits) α). grid [[1,0,0,0],[1,1,1,0]], hits [[1,0]] → [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
