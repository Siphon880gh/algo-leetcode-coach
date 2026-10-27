## Cut as soon as a part is complete

1. `total = sum(arr)`. If `total % 3 != 0`, return false.
2. `target = total // 3`, `run = 0`, `parts = 0`. For each `x`: `run += x`; if `run == target`, `parts += 1`, `run = 0`.
3. Return `parts ≥ 3`.

With `target = 0`, more than three zero-sum parts can appear; extra parts merge into the last one, which still sums to 0, so `≥ 3` is right.

Do not stop exactly at three cuts and ignore the rest; the remainder must still sum to 0, which `parts ≥ 3` already ensures. Do not allow an empty third part; the counting forces each part to contain at least one element.

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
