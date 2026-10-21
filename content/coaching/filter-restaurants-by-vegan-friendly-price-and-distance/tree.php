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
            'message' => "Read the problem statement above.\nveganFriendly = 0 means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No vegan filter', 'next' => 's2'],
                ['label' => 'Only non-vegan places', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 0 means anything goes.\nStep back to when you required vegan = 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rating tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lower id first', 'next' => 'wrong_b'],
                ['label' => 'Higher id first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement breaks ties by id descending.\nStep back to when you sorted ids ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Price and distance tests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≤ the caps', 'next' => 'success'],
                ['label' => '< the caps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal values pass.\nStep back to when you used strict inequality.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Vegan, 50, 10 → [3,1,5]. No filter, 30, 3 → [4,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
