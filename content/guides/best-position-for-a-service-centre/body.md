## Shrinking-step search

1. Start at the centroid with step 50 (coordinates are ≤ 100).
2. Try ±step in x and y; move if the total distance drops; else halve the step.
3. Stop when the step is below about 1e-7; return the total.

`[[0,1],[1,0],[1,2],[2,1]]` → 4.0. `[[1,1],[3,3]]` → 2.82843.

Do not use the centroid as the answer; it minimises squared distances, not distances. Weiszfeld iteration or ternary search on x then y also work.

Time: O(n · log(range/ε))  
Space: O(1)

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
