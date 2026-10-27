## Earliest-ending subarray

1. `seen = {0}`, `s = 0`.
2. For each `x`: `s += x`; if `s − target` in `seen`: `count += 1`, `seen = {0}`, `s = 0`; else add `s`.

`[1,1,1,1,1]`, 2 → 2. `[-1,3,5,1,4,2,-9]`, 6 → 2.

Do not use a sliding window; values can be negative. Resetting is safe because the earliest-ending choice leaves the most room.

Time: O(n)  
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
