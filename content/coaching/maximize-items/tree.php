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
            'message' => "Problem: A table lists inventory items, each with an item type and an area. A warehouse has a fixed total area, given in the statement. It is filled first with as many complete copies as fit of the whole set of items of the priority type, and then the space left over with as many complete copies of the whole set of the other type. Report how many items of each type end up stored. The exact type names and the warehouse area are in the official statement. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nArea for the second type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'What the first set leaves', 'next' => 's2'],
                ['label' => 'The full capacity', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The check → 18 other items instead of 0.\nStep back to when you used the full capacity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Copies that fit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ROUND(area / set area)', 'next' => 'wrong_b'],
                ['label' => 'floor(area / set area)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1,000 / 400 rounds to 3, which does not fit; floor gives 2.\nStep back to when you rounded.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → 8 priority items, 0 other.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
