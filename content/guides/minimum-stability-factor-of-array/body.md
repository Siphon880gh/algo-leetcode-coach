## Check L

1. If L = 0, every element ≥ 2 must change.
2. Otherwise keep st (first index after the last change). At i with i − st ≥ L: if gcd(nums[i − L … i]) ≥ 2, change i, count it, st = i + 1.
3. L is feasible if count ≤ maxC. Feasibility only gets easier as L grows, so binary search the smallest L.

A sparse table answers each window gcd in O(1) after O(n log n) setup.

Examples → 1, 1, 2. Checked against trying every set of changes on 500 random arrays.

Changing the leftmost element of the window: [2, 2, 8], maxC = 1 → 2 instead of 1.

Time: O(n log n · log max)  
Space: O(n log n)

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
