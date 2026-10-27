## Only safe triplets

1. `g = [0, 0, 0]`.
2. For each triplet with `a ≤ x`, `b ≤ y`, `c ≤ z`: `g = elementwise max(g, triplet)`.
3. Return `g == target`.

Example 1 → true. Example 2 → false (`[3,4,5]` overshoots on y). Example 3 → true.

Merging every safe triplet can only help: none can push past the target. Equivalently, check that each coordinate is hit exactly by some safe triplet.

Time: O(n)  
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
