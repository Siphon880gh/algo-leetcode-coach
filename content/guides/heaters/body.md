## Nearest heater per house

A house is warm exactly when its nearest heater is within `r`. So the answer is the largest "distance to nearest heater" over all houses.

Sort `heaters`. For each house, binary search for the first heater at or after it. The nearest heater is either that one or the one just before it. Take the smaller distance, and keep the maximum over all houses.

Two pointers also work: sort both lists, and for each house in order, move the heater pointer forward while the next heater is at least as close.

Another valid approach is binary search on `r` with a greedy coverage check (the doocs solution), at O((m + n) log range).

Find K Closest Elements (658) also searches for neighbors in a sorted array.

Do not use only the heater to the right — the left neighbor may be closer. Do not forget houses outside the heater range on either end.

Time: O((m + n) log n)  
Space: O(1) besides sorting

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
