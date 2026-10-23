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
            'message' => "Read the problem statement above.\nWhere can the replacement go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any i with pre[i] < suf[i + 1]', 'next' => 's2'],
                ['label' => 'Where the greedy match first fails', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): s = \"bb\", t = \"cb\" → false instead of true.\nStep back to when you replaced the first failing character.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare pre[i] with suf[i + 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Less than or equal', 'next' => 'wrong_b'],
                ['label' => 'Strictly less', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): s = \"ab\", t = \"b\" → true instead of false.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
