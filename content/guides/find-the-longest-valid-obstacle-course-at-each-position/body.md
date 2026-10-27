## Tails with bisect_right

1. `tails = []`.
2. For each `x`: `i = bisect_right(tails, x)`; set `tails[i] = x` (or append); `ans.append(i + 1)`.

`[1,2,3,2]` → `[1,2,3,3]`. `[2,2,1]` → `[1,2,1]`. `[3,1,5,6,4,2]` → `[1,1,2,3,2,2]`.

`bisect_right` (not left) allows equal heights to extend a course. `tails[i]` is the smallest possible last height of a course of length `i + 1`, so the array stays sorted.

Time: O(n log n)  
Space: O(n)

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
