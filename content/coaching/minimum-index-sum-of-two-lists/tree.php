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
            'message' => "Read the problem statement above.\nCompare every pair of strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: map each list1 string to its index', 'next' => 's2'],
                ['label' => 'Yes: two nested loops', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Nested loops compare up to 10⁶ string pairs; a map makes each lookup O(1).\nStep back to when you nested the loops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A common string has index sum t. What do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep only the first common string you find', 'next' => 'wrong_b'],
                ['label' => 't < best: reset the answer to [s]; t == best: append s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every string that ties the smallest sum belongs in the answer.\nStep back to when you kept one string.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can you stop early?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: once j > best, every later sum is bigger', 'next' => 'success'],
                ['label' => 'Yes: stop at the first common string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A later string in list2 can have a much smaller index in list1, and so a smaller sum.\nStep back to when you stopped at the first match.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Index map, running best with ties: O(m + n) lookups. [\"Shogun\",\"Tapioca Express\",\"Burger King\",\"KFC\"] vs [\"KFC\",\"Shogun\",\"Burger King\"] → [\"Shogun\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
