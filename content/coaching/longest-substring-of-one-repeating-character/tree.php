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
            'message' => "Read the problem statement above.\nAfter each update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Point update on a segment tree', 'next' => 's2'],
                ['label' => 'Rescan the whole string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 10^5 queries over 10^5 characters is about 10^10 steps.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join left suffix with right prefix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'Only when s[mid − 1] = s[mid]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ab would report a run of 2.\nStep back to when you always joined.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prefix of a merged node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L.pre + R.pre only if L is one full run and the boundary matches', 'next' => 'success'],
                ['label' => 'Always L.pre', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. aab merged from aa and b is fine, but aa + ab would report prefix 2 instead of 3.\nStep back to when you ignored the full-run case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + k) log n). Examples → [3,3,4], [2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
