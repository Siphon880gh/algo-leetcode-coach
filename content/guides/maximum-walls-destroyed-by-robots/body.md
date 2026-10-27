## Two states

1. Sort robots (with their distances) and walls; count(lo, hi) = walls in [lo, hi] by binary search.
2. Left range of robot i: [max(p − d, previous robot + 1), p]. Right range: [p, min(p + d, next robot − 1)].
3. fL = max(prev fL, prev fR − overlap) + count(left range); fR = max(prev fL, prev fR) + count(right range), where the overlap is the walls shared by the previous robot’s right range and this left range.
4. Answer max(fL, fR) at the last robot.

Examples → 1, 3, 0. Checked against trying every direction choice on 3,000 random cases.

Letting bullets pass through robots: example 3 → 1 instead of 0.

Time: O((r + w) log(r + w))  
Space: O(r + w)

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
